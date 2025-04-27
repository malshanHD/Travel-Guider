<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function save(Request $request){
        $feedback = new Feedback();
        $feedback->name = $request->name;
        $feedback->email = $request->email;
        $feedback->subject = $request->subject;
        $feedback->message = $request->message;
        $feedback->save();
        return redirect()->back()->with('success', 'Your message has been sent. Thank you!');
    }

    public function read(){
        Feedback::query()->update(['Is_Read' => true]);
        return redirect()->back();
    }
}
