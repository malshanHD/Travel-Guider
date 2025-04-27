<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\SendUserPassword;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    //
    public function index()
    {
        $users = User::whereIn('user_Level', [3])->get();
        return view('Admin.AdminRegistration', compact('users'));
    }

    public function Save(Request $request)
    {
        $password = Str::random(10);

        $User = new User();
        $User->name = $request->name;
        $User->email = $request->email;
        $User->email_verified_at = Carbon::now();
        $User->password = bcrypt($password);
        $User->user_Level = 3;
        $User->save();

        Mail::to($User->email)->send(new SendUserPassword($password));

        return redirect()->route('admin.newadmin')->with('success', 'New admin added successfully.!');
    }

    public function Banned($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->Is_Active = 0;
            $user->save();

            return redirect()->route('admin.newadmin')->with('success', 'User deactivated successfully.');
        }

        return redirect()->route('admin.newadmin')->with('success', 'User not found. Please try again.');
    }

    public function Active($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->Is_Active = 1;
            $user->save();

            return redirect()->route('admin.newadmin')->with('success', 'User Activated successfully.');
        }

        return redirect()->route('admin.newadmin')->with('success', 'User not found. Please try again.');
    }
}
