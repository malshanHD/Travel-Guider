<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Http\Request;
use Intervention\Image\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function ProfileLoad()
    {
        $userId = Auth::id();
        $customer = Customer::where('user_id', $userId)->first();
        return view('Profile', compact('customer'));
    }

    public function update(Request $request)
    {
        $userId = Auth::id();
        $customer = Customer::where('user_id', $userId)->first();

        if ($customer) {
            $validatedData = $request->validate([
                'firstname' => 'required|string|max:255',
                'lastname' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'contact' => 'required|max:20',
                'City' => 'required|string|max:255',
                'state' => 'required|string|max:255',
                'Zipcode' => 'required|max:10',
                'country' => 'required|string|max:255',
            ]);

            // Update the customer data
            $customer->update([
                'first_name' => $validatedData['firstname'],
                'last_name' => $validatedData['lastname'],
                'email' => $validatedData['email'],
                'phone_number' => $validatedData['contact'],
                'city' => $validatedData['City'],
                'state' => $validatedData['state'],
                'zip_code' => $validatedData['Zipcode'],
                'country' => $validatedData['country'],
            ]);

            return redirect()->route('profile.load')->with('success', 'Profile updated successfully.');
        } else {
            return redirect()->route('profile.noCustomer');
        }
    }

    public function showChangePasswordForm()
    {
        $userData = Auth::user();
        if ($userData->user_Level == 1 || $userData->user_Level == 3){
            return view('auth.passwords.ResetPasswordAdmin');
        }
        else if ($userData->user_Level == 2){
            return view('auth.passwords.ResetPassword');
        }
        else{
            return view('welcome');
        }
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|different:current_password',
            'new_password_confirmation' => 'required|same:new_password',
        ]);

        $userId = Auth::id();
        $user = User::where('id', $userId)->first();

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with('error', 'Current password does not match');
        }

        // Update user password
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->back()->with('success', 'Password changed successfully');
    }

    public function updateProfilePicture(Request $request)
    {
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif', // Validate file type and size
        ]);

        $userId = Auth::id();
        $user = User::where('id', $userId)->first();

        // Delete old profile picture if exists
        if ($user->profile_picture) {
            Storage::delete($user->profile_picture);
        }

        // Store new profile picture
        $profilePicturePath = $request->file('profile_picture')->store('profile_pictures', 'public');
        $user->profile_pic = $profilePicturePath;
        $user->save();

        return back()->with('success', 'Profile picture uploaded successfully.');
    }
}
