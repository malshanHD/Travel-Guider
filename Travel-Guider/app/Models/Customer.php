<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'first_name', 'last_name', 'email', 'city', 'state', 'zip_code', 'country', 'gender', 'dob', 'phone_number'];
}
