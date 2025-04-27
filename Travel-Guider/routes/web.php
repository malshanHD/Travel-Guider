<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FeedbackController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\NotificationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/locations', [LocationController::class, 'index'])->name('index');

Route::get('/locationData', [LocationController::class, 'sortLocationsByDistance'])->name('sortLocationsByDistance');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes(['verify' => true]);

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/add-location', function () {
        return view('Admin.AddLocation');
    });

    Route::get('/Admin-Management', [AdminController::class, 'Index'])->name('admin.newadmin');

    Route::get('/admin-banned/{id}', [AdminController::class, 'Banned'])->name('admin.Banned');

    Route::get('/admin-active/{id}', [AdminController::class, 'Active'])->name('admin.Active');

    Route::get('/view-customers', [CustomerController::class, 'View'])->name('customer.view');

    Route::post('/saveadmin', [AdminController::class, 'Save']);

    Route::post('/save-location', [LocationController::class, 'saveLocation'])->name('saveLocation');

    // routes/web.php
    Route::delete('/locations/{id}', [LocationController::class, 'destroy']);
});

Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'ProfileLoad'])->name('profile.load');
    Route::get('/trip-navigator', [LocationController::class, 'UserLocations'])->name('UserLocations');

    Route::post('/save-user-locations', [LocationController::class, 'saveUserLocations'])->name('saveUserLocations');
    Route::get('/handle-trip/{tripId}', [LocationController::class, 'handleTrip'])->name('handleTrip');

    Route::post('/profile-update', [ProfileController::class, 'update']);

    Route::get('/notification-read/{id}', [NotificationController::class, 'markread'])->name('markread');

    Route::get('/my-trips', [TripController::class, 'mytrips'])->name('mytrips');

    Route::get('/download-invoice/{id}', [PaymentController::class, 'downloadinvoice'])->name('downloadinvoice');
    
});




Route::get('/change-password',  [ProfileController::class, 'showChangePasswordForm'])->name('password.change');
Route::post('/change-password', [ProfileController::class, 'changePassword'])->name('password.update');
Route::post('/profile', [ProfileController::class, 'updateProfilePicture'])->name('profile.picture');

Route::post('/feedback', [FeedbackController::class, 'save']);
Route::get('/mark-as-read', [FeedbackController::class, 'read']);


Route::get('/payhere/pay', [PaymentController::class, 'pay']);
Route::get('payhere/callback/{id}', [PaymentController::class, 'callback']);
Route::get('/payhere/callback', [PaymentController::class, 'callback']);

// Route::get('/payhere/callback', [PaymentController::class, 'callback']);


Route::get('/payment/success', function () {
    return 'Payment Success';
});

Route::get('/payment/cancel', function () {
    return 'Payment Cancelled';
});
