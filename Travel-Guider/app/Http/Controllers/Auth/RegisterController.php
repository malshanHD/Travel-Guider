<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Customer;
use App\Models\Notification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'user_Level' => $data['user_level'],
        ]);
        $userId = $user->id;

        $customer = Customer::create([
            'user_id' => $userId,
            'first_name' => $data['name'],
            'last_name' => $data['lastName'],
            'email' => $data['email'],
            'city' => $data['city'],
            'state' => $data['state'],
            'zip_code' => $data['zip'],
            'country' => $data['countries'],
            'gender' => $data['gender'],
            'dob' => $data['dob'],
            'phone_number' => $data['telephone'],
        ]);

        $notiDetail = "New customer registered. Customer ID: {$customer->id}";
        $notification = new Notification();
        $notification->detail = $notiDetail;
        $notification->user_id = $userId;
        $notification->is_For_Admin = true;
        $notification->save();

        return $user;
    }
}
