<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TripController extends Controller
{
    //
    public function mytrips(){
        $userData = Auth::user();
        $trips = Trip::where('user_id', $userData->id)->get();
        return view('mytrips', compact('trips'));
    }
}
