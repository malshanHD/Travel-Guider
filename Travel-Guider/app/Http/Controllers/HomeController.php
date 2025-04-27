<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Trip;
use App\Models\Customer;
use App\Models\UserLocation;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userData = Auth::user();
        $currentYear = Carbon::now()->year;
        if ($userData->user_Level == 1 || $userData->user_Level == 3) {
            $currentMonth = Carbon::now()->month;
            $previousMonth = Carbon::now()->subMonth()->month;

            // Fetch user registration data
            $users = User::selectRaw('COUNT(id) as count, MONTH(created_at) as month')
                ->whereYear('created_at', $currentYear)
                ->groupBy('month')
                ->pluck('count', 'month');

            $registrationData = $this->prepareMonthlyData($users);

            // Fetch trip data
            $trips = Trip::selectRaw('COUNT(id) as count, MONTH(created_at) as month')
                ->whereYear('created_at', $currentYear)
                ->groupBy('month')
                ->pluck('count', 'month');

            $tripData = $this->prepareMonthlyData($trips);

            // Fetch popular location data
            $popularLocations = UserLocation::selectRaw('locations.name, COUNT(user_locations.id) as count')
                ->join('locations', 'user_locations.location_id', '=', 'locations.id')
                ->groupBy('locations.name')
                ->pluck('count', 'locations.name');

            $customers = Customer::selectRaw('COUNT(id) as count, MONTH(created_at) as month')
                ->whereYear('created_at', $currentYear)
                ->groupBy('month')
                ->pluck('count', 'month');


            $activeCustomerCount = Customer::where('active_status', true)->count();
            $revenue = $activeCustomerCount*1499;

            $formattedPrice = number_format($revenue, 2, '.', ',');

            // Fetch total count of customers
            $totalCustomers = Customer::count();

            // Fetch total count of planned trips
            $totalPlannedTrips = Trip::count();

            // Fetch current and previous month registrations
            $currentMonthRegistrations = $customers[$currentMonth] ?? 0;
            $previousMonthRegistrations = $customers[$previousMonth] ?? 0;

            // Fetch current and previous month trips
            $currentMonthTrips = $trips[$currentMonth] ?? 0;
            $previousMonthTrips = $trips[$previousMonth] ?? 0;

            // Calculate percentage change for registrations
            $registrationPercentageChange = $this->calculatePercentageChange($currentMonthRegistrations, $previousMonthRegistrations);

            // Calculate percentage change for trips
            $tripPercentageChange = $this->calculatePercentageChange($currentMonthTrips, $previousMonthTrips);
            // dd($tripPercentageChange);
            return view('admin.dashboard', compact(
                'registrationData',
                'tripData',
                'popularLocations',
                'totalCustomers',
                'totalPlannedTrips',
                'registrationPercentageChange',
                'tripPercentageChange',
                'formattedPrice'
            ));
        } else {
            $trips = Trip::where('user_id', $userData->id)->count();
            $customer = Customer::where('user_id', $userData->id)->first();

            $popularLocations = UserLocation::selectRaw('locations.name, COUNT(user_locations.id) as count')
                ->join('locations', 'user_locations.location_id', '=', 'locations.id')
                ->groupBy('locations.name')
                ->pluck('count', 'locations.name');

            $locations = $popularLocations->keys()->toArray();
            $counts = $popularLocations->values()->toArray();

            return view('home', compact('customer', 'trips', 'locations', 'counts'));
        }
    }

    private function prepareMonthlyData($data)
    {
        $monthlyData = array_fill(1, 12, 0);
        foreach ($data as $month => $count) {
            $monthlyData[$month] = $count;
        }
        return $monthlyData;
    }

    private function calculatePercentageChange($current, $previous)
    {
        if ($previous == 0) {
            return $current > 0 ? 100 : 0;
        }
        return (($current - $previous) / $previous) * 100;
    }
}
