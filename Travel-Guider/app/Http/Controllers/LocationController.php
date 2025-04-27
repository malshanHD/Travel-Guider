<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Models\Location;
use App\Models\Notification;
use App\Models\UserLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class LocationController extends Controller
{
    //
    public function saveLocation(Request $request)
    {

        $request->validate([
            'location_name' => 'required|string',
            'location_icon' => 'required|image|mimes:png|max:2048',
            '360_view_picture' => 'required|image',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $iconPath = $request->file('location_icon')->store('public/location_icons');
        $picturePath = $request->file('360_view_picture')->store('public/360_view_pictures');

        $iconPath = str_replace('public/', '', $iconPath);
        $picturePath = str_replace('public/', '', $picturePath);

        $location = new Location([
            'name' => $request->location_name,
            'icon' => $iconPath,
            'picture' => $picturePath,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'view_url' => $request->view_url,
        ]);
        $location->save();
        return back()->with('success', 'Location saved successfully.');
    }


    public function index()
    {
        $locations = Location::all();
        $userData = Auth::user();
        if ($userData->user_Level == 1 || $userData->user_Level == 3) {
            return view('Admin.Locations', compact('locations'));
        } else if ($userData->user_Level == 2) {
            return view('User.Locations', compact('locations'));
        } else {
            return view('welcome');
        }
    }

    public function UserLocations()
    {
        $locations = Location::all();
        return view('GenerateTour', compact('locations'));
    }


    public function sortLocationsByDistance()
    {
        $currentLatitude = 9.661498;
        $currentLongitude = 80.025543;
        $locations = DB::table('locations')
            ->select(
                'locations.*',
                DB::raw("6371 * acos(cos(radians(" . $currentLatitude . ")) 
        * cos(radians(locations.latitude)) 
        * cos(radians(locations.longitude) - radians(" . $currentLongitude . ")) 
        + sin(radians(" . $currentLatitude . ")) 
        * sin(radians(locations.latitude))) AS distance"),
                'locations.waiting_time'
            )
            ->orderBy('distance', 'asc')
            ->get();

        $totalWaitingTimeInMinutes = 0;

        foreach ($locations as $location) {
            $timeParts = explode(':', $location->waiting_time);
            $hoursToMinutes = $timeParts[0] * 60; // Convert hours to minutes
            $minutes = $timeParts[1];
            $secondsToMinutes = $timeParts[2] / 60; // Convert seconds to minutes
            $totalWaitingTimeInMinutes += $hoursToMinutes + $minutes + $secondsToMinutes; // Sum up the total in minutes
        }

        $totalWaitingTimeInMinutes = round($totalWaitingTimeInMinutes);
        // dd($totalWaitingTimeInMinutes);

        return view('myroute', compact('locations', 'totalWaitingTimeInMinutes'));
    }

    public function saveUserLocations(Request $request)
    {
        Log::info('saveUserLocations controller method was called.');

        $selectedLocationIds = $request->input('selectedLocations');

        if (!is_array($selectedLocationIds)) {
            Log::warning('Invalid data: selectedLocations is not an array.');
            return response()->json(['success' => false, 'message' => 'Invalid data.'], 400);
        }

        try {

            $trip = new Trip();
            $trip->trip_name = $request->name;
            $trip->travelling_date = $request->date;
            $trip->user_id = auth()->id();
            $trip->save();

            $tripId = $trip->id;

            foreach ($selectedLocationIds as $locationId) {
                Log::info('Processing location ID: ' . $locationId);
                UserLocation::create([
                    'location_id' => $locationId,
                    'trip_id' => $tripId,
                    'user_id' => auth()->id(),
                ]);
            }

            $notiDetail = "Your trip to {$request->name} has been created successfully.";
            $notification = new Notification();
            $notification->detail = $notiDetail;
            $notification->user_id = auth()->id();
            $notification->save();

            return response()->json(['success' => true, 'tripId' => $tripId]);
        } catch (\Exception $e) {
            Log::error('Error saving user locations: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function handleTrip(Request $request, $tripId)
    {
        $currentLatitude = $request->query('latitude');
        $currentLongitude = $request->query('longitude');

        $locations = DB::table('locations')
            ->join('user_locations', 'locations.id', '=', 'user_locations.location_id')
            ->select(
                'locations.*',
                DB::raw("6371 * acos(cos(radians(" . $currentLatitude . ")) 
                * cos(radians(locations.latitude)) 
                * cos(radians(locations.longitude) - radians(" . $currentLongitude . ")) 
                + sin(radians(" . $currentLatitude . ")) 
                * sin(radians(locations.latitude))) AS distance"),
                'locations.waiting_time'
            )
            ->where('user_locations.trip_id', $tripId)
            ->orderBy('distance', 'asc')
            ->get();

        $totalWaitingTimeInMinutes = 0;
        foreach ($locations as $location) {
            $timeParts = explode(':', $location->waiting_time);
            $hoursToMinutes = $timeParts[0] * 60;
            $minutes = $timeParts[1];
            $secondsToMinutes = $timeParts[2] / 60;
            $totalWaitingTimeInMinutes += $hoursToMinutes + $minutes + $secondsToMinutes;
        }
        $totalWaitingTimeInMinutes = round($totalWaitingTimeInMinutes);

        return view('trip-route', compact('locations', 'tripId', 'totalWaitingTimeInMinutes', 'currentLatitude', 'currentLongitude'));
    }


    public function handleTrips(Request $request, $tripId)
    {

        $currentLatitude = $request->query('latitude');
        $currentLongitude = $request->query('longitude');

        // $currentLatitude = 40.7128; 
        // $currentLongitude = -74.0060; 

        $locations = $this->getLocationsForTrip($tripId, $currentLatitude, $currentLongitude);

        $totalWaitingTimeInMinutes = 0;

        foreach ($locations as $location) {
            $timeParts = explode(':', $location->waiting_time);
            $hoursToMinutes = $timeParts[0] * 60;
            $minutes = $timeParts[1];
            $secondsToMinutes = $timeParts[2] / 60;
            $totalWaitingTimeInMinutes += $hoursToMinutes + $minutes + $secondsToMinutes;
        }

        $totalWaitingTimeInMinutes = round($totalWaitingTimeInMinutes);

        // return view('trip-route', compact('locations', 'tripId', 'totalWaitingTimeInMinutes'));
        return view('trip-route', compact('locations', 'tripId', 'totalWaitingTimeInMinutes', 'currentLatitude', 'currentLongitude'));
        // return view('trip-route', ['trip' => $trip]);
    }

    public function getLocationsForTrip($tripId, $currentLatitude, $currentLongitude)
    {
        $locations = DB::table('locations')
            ->join('user_locations', 'locations.id', '=', 'user_locations.location_id')
            ->select(
                'locations.*',
                DB::raw("6371 * acos(cos(radians(" . $currentLatitude . ")) 
        * cos(radians(locations.latitude)) 
        * cos(radians(locations.longitude) - radians(" . $currentLongitude . ")) 
        + sin(radians(" . $currentLatitude . ")) 
        * sin(radians(locations.latitude))) AS distance"),
                'locations.waiting_time'
            )
            ->where('user_locations.trip_id', $tripId)
            ->orderBy('distance', 'asc')
            ->get();

        // dd($locations);

        return $locations;
    }

    public function destroy($id)
    {
        $location = Location::find($id);
        if ($location) {
            $location->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }
}
