<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Auth;

Auth::routes();
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


 /**
  * Create car
  */

// Group routes that require authentication
Route::middleware('auth')->group(function () {
    // Route to show the car creation form
});

/* Route::get('/car/create', [CarController::class, 'create'])->name('car.create');

// Route to handle form submission and store the car data
Route::post('/car/store', [CarController::class, 'store'])->name('car.store'); */

Route::post('/schedule/save', [ScheduleController::class, 'save'])->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/car/create', [CarController::class, 'create'])->name('car.create');
    Route::post('/car/store', [CarController::class, 'store'])->name('car.store');
    Route::get('/car/edit/{id}', [CarController::class, 'edit'])->name('car.edit');
    Route::put('/car/{id}', [CarController::class, 'update'])->name('car.update');
    Route::get('/car/delete/{id}', [CarController::class, 'destroy'])->name('car.delete');
    /**
     * Sell
     */
    Route::post('/car/sell/{id}', [CarController::class, 'sell'])->name('car.sell');

    /**
     * Statistics
     */
    Route::middleware('auth')->get('/statistics/sold', [StatisticsController::class, 'sold'])->name('statistics.sold');

    /**
     * Create schedule
     */
    Route::get('/schedule/create', [ScheduleController::class, 'create']);

    /**
     * Booking list
     */
    Route::get('/bookings/list', [BookingController::class, 'listBookings'])->name('administration.bookings');

    /**
     * Bookings by date
     */
    Route::get('/api/bookings/by-date', [BookingController::class, 'getBookingsByDate']);

    /**
     * Get Booked Dates
     */
    Route::get('/api/bookings/dates', [BookingController::class, 'getBookedDates']);


    /**
     * Bookings HOME (CHOOSE ACTIONS)
     */
    Route::get('/bookings/home', [BookingController::class, 'home'])->name('administration.bookings');

    /**
     * List the user contacts
     */
    Route::get('/admin/contacts', [ContactController::class, 'listContactMessages'])->name('contacts.list');

    Route::get('/profile', function () {
        return view('profile.index');
    });
});

/**
 * User create
 */
Route::get('/auth', [AuthController::class, 'index'])->name('auth.index');
Route::post('/auth', [AuthController::class, 'create'])->name('auth.create');

/**
 * Login
 */
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');


Route::get('/', [CarController::class, 'home'])->name('home');







Route::get('/about', function () {
    return view('about.index');
});


Route::get('/catalog', [CarController::class, 'index'])->name('car.index');

/**
 * Filter the cars
 */
Route::get('/api/cars/filter', [CarController::class, 'filter'])->name('car.filter');

/**
 * Distinct options
 */
Route::get('/api/cars/options', [CarController::class, 'getOptions'])->name('car.options');

/**
 * Car Show
 */
Route::get('/car/{id}', [CarController::class, 'show'])->name('car.show');


/**
 * Booking Available Slots
 */
Route::get('/api/available-slots', [BookingController::class, 'getAvailableSlots']);

/**
 * Create the booking
 */
Route::post('/booking/store', [BookingController::class, 'store'])->name('booking.store');




/* Route::get('/car', function () {
    return view('car.show');
}); */
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');

Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/attributions', function () {
    return view('legal.attributions');
});


/**
 * Admin features
 */
