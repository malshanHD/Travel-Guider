<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    //
    public function markread($id){
        Notification::where('user_id', $id)->update(['IsActive' => true]);
        return redirect()->back();
    }
}
