<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\PatientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\PosController;
use App\Models\Appointments;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/admin/appointments-calendar', function () {
        return view('appointments.calendar');
    })->name('appointments.calendar');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/patients/create', [PatientController::class, 'create'])->name('patients.create');
    Route::post('/patients/store', [PatientController::class, 'store'])->name('patients.store');

    Route::get('/appointments-by-date', function (Request $request) {
        return Appointments::whereDate('appointment_date', $request->date)->get();
    });

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

/*
|--------------------------------------------------------------------------
| APPOINTMENT SYSTEM (CLEAN - SINGLE CONTROLLER ONLY)
|--------------------------------------------------------------------------
*/


Route::get('/appointments/welcome', function () {
    return view('appointments.appointment-welcome');
})->name('appointments.landing');

Route::get('/auth', function () {
    return view('appointments.loginform');
});

Route::get('/register', function () {
    return view('appointments.registerform');
});

Route::get('/appointments-booking', [AppointmentController::class, 'create'])
    ->name('appointments.create');

Route::post('/appointments-booking', [AppointmentController::class, 'store'])
    ->name('appointments.store');


    /*
    |--------------------------------------------------------------------------
    | POS ROUTES
    |--------------------------------------------------------------------------
    */

    Route::get('/pos', [PosController::class, 'pos.index'])->name('pos.index');
    Route::post('/pos/checkout', [PosController::class, 'checkout']);
});



/*
|--------------------------------------------------------------------------
| ORDERING MODULE ROUTES
|--------------------------------------------------------------------------
*/



/*
|--------------------------------------------------------------------------
| E-CONSULTANT MODULE ROUTES
|--------------------------------------------------------------------------
*/





/*
|--------------------------------------------------------------------------
| AUTH FILE
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';
