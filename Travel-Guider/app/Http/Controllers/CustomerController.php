<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    //
    public function View(){
        $customers = Customer::all();
        return view('Admin.Customers', compact('customers'));
    }
}
