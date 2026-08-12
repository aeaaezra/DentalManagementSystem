    <?php

    use Illuminate\Support\Facades\Route;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Http\Request;

    use App\Http\Controllers\MessageController;
    use App\Http\Controllers\Auth\AuthenticatedSessionController;
    use App\Http\Controllers\PatientController;
    use App\Http\Controllers\ProfileController;
    use App\Http\Controllers\NotificationController;
    use App\Http\Controllers\AppointmentBookingController;
    use App\Http\Controllers\ProductsController;
    use App\Http\Controllers\POSController;
    use App\Http\Controllers\Api\PrefetchController;
    use App\Http\Controllers\PaymentController;
    use App\Http\Controllers\SettingsController;
    use App\Http\Controllers\OdontogramController;
     use App\Http\Controllers\TwoFactorController;

use App\Models\Doctor;
use App\Models\Appointments;
use App\Models\Notification;


    /*
    |--------------------------------------------------------------------------
    | ADMIN ROUTES
    |--------------------------------------------------------------------------
    */
    Route::get('/admin-login', function () {
        return view('admin.login');
    })->name('admin.login');

    Route::post('/admin-login', [AuthenticatedSessionController::class, 'store'])
        ->name('admin.login.store');
    /*
    |--------------------------------------------------------------------------
    | PUBLIC ROUTES
    |--------------------------------------------------------------------------
    */

    Route::get('/', fn() => view('welcome'))->name('home');



    Route::get('shine-and-smile/appointments/welcome', fn() => view('appointments.appointment-welcome'))->name('appointments.landing');

    /*
    |--------------------------------------------------------------------------
    | AUTHENTICATED ROUTES
    |--------------------------------------------------------------------------
    */

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {

        $role = strtolower(trim(auth()->user()->role ?? ''));

        return match ($role) {
            'admin' => redirect('/admin'),
            'dentist' => redirect()->route('dentist.dashboard'),
            'staff' => redirect()->route('staff.dashboard'),
            'manager' => redirect()->route('manager.dashboard'),
            'cashier' => redirect()->route('pos.homepage'),
            'customer' => redirect()->route('pos.homepage'),
            'patient' => redirect()->route('appointments.homepage'),

            default => abort(403, 'Unknown role: ' . $role),
        };

    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

        /*
        |----------------------------------------------------------------------
        | ADMIN ROUTES
        |----------------------------------------------------------------------
        */

        Route::middleware([ 'auth', 'role:admin']) ->prefix('admin')->name('admin.')->group(function () {

            Route::get('/appointments-calendar', fn() => view('appointments.calendar'))->name('calendar');
            // Add more admin routes here...
        });

        /*
        |----------------------------------------------------------------------
        | DENTIST ROUTES
        |----------------------------------------------------------------------
        */
        Route::middleware(['auth', 'role:dentist,admin'])->prefix('dentist')->name('dentist.')->group(function () {
            Route::get('/dashboard', fn() => view('dentist.dashboard'))->name('dashboard');
            // Add more dentist routes here...
        });

        /*
        |----------------------------------------------------------------------
        | STAFF ROUTES
        |----------------------------------------------------------------------
        */
        Route::middleware(['auth', 'role:staff,admin'])->prefix('staff')->name('staff.')->group(function () {
            Route::get('/dashboard', fn() => view('staff.dashboard'))->name('dashboard');
            // Add more staff routes here...
        });

        /*
        |----------------------------------------------------------------------
        | MANAGER ROUTES
        |----------------------------------------------------------------------
        */
        Route::middleware([ 'auth', 'role:manager,admin'])->prefix('manager')->name('manager.')->group(function () {
            Route::get('/dashboard', fn() => view('manager.dashboard'))->name('dashboard');
        });

        /*

        /*
    |--------------------------------------------------------------------------
    | NOTIFICATION ROUTES
    |--------------------------------------------------------------------------
    */



    Route::middleware(['auth'])->group(function () {

        Route::get(
            'shine-and-smileappointments/message',
            [MessageController::class, 'message']
        )->name('appointments.message');

        Route::get(
            '/messages/{userId}',
            [MessageController::class, 'index']
        )->name('messages.chat');

        Route::post(
            '/messages/send',
            [MessageController::class, 'store']
        )->name('messages.store');

        Route::post(
            '/messages/{message}/react',
            [MessageController::class, 'react']
        )->name('messages.react');

        Route::post(
            '/messages/{message}/pin',
            [MessageController::class, 'pin']
        )->name('messages.pin');

        Route::delete(
            '/messages/{message}/unsend',
            [MessageController::class, 'unsend']
        )->name('messages.unsend');

    });

    /*
    |--------------------------------------------------------------------------
    | PATIENT ROUTES
    |--------------------------------------------------------------------------
    */

    Route::middleware(['auth', 'role:patient'])->group(function () {

Route::get( 'shine-and-smile/appointments/history/print', [AppointmentBookingController::class, 'printHistory']
)->name('appointments.history.print');

    Route::post('shine-and-smile/odontogram/save', [OdontogramController::class, 'store'])
    ->name('odontogram.store');

Route::post('shine-and-smile/settings/password', [SettingsController::class, 'updatePassword'])
    ->name('settings.password.update');

      Route::get('shine-and-smile/appointments/settings', [SettingsController::class, 'index'])
        ->name('appointments.settings');

    Route::put('shine-and-smile/appointments/settings/profile', [ProfileController::class, 'update'])
        ->name('appointments.settings.profile');

        Route::get(
            'shine-and-smile/appointments/aftercare',
            [AppointmentBookingController::class, 'aftercare']
        )->name('appointments.aftercare');

    Route::get('shine-and-smile/appointments/history', [AppointmentBookingController::class, 'history'])
    ->name('appointments.history');

    Route::get('shine-and-smile/appointments/homepage', [AppointmentBookingController::class, 'homepage'])
        ->name('appointments.homepage');

    Route::post('shine-and-smile/appointments/{appointment}/cancel', [AppointmentBookingController::class, 'cancel'])
        ->name('appointments.cancel');

    Route::get('shine-and-smile/appointments-booking', [AppointmentBookingController::class, 'create'])
        ->name('appointments.create');

    Route::post('shine-and-smile/appointments-booking', [AppointmentBookingController::class, 'store'])
        ->name('appointments.store');



});

    Route::get('shine-and-smile/appointments/dentists', function () {

        $doctors = Doctor::all();

        $notifications = Notification::where(
            'user_id',
            Auth::id()
        )->latest()->get();

        $notificationCount = Notification::where(
            'user_id',
            Auth::id()
        )
        ->where('is_read', false)
        ->count();

        return view(
            'appointments.appointment-dentists',
            compact(
                'doctors',
                'notifications',
                'notificationCount'
            )
        );

    })->name('appointments.dentists');

    Route::post(
        '/messages/{message}/react',
        [MessageController::class, 'react']
    )->name('messages.react');


        Route::get(
            '/appointments/message',
            [MessageController::class, 'message']
        )->name('appointments.message');

        Route::get(
            '/messages/{userId}',
            [MessageController::class, 'index']
        )->name('messages.chat');

        Route::post(
            '/messages/send',
            [MessageController::class, 'store'
        ])->name('messages.store');

    //Pin
    Route::post(
        '/messages/{message}/pin',
        [MessageController::class, 'pin']
    )->name('messages.pin');


    //Delete
    Route::delete(
        '/messages/{message}/unsend',
        [MessageController::class, 'unsend']
    )->name('messages.unsend');



Route::get('/available-slots', [AppointmentBookingController::class, 'availableSlots']);


        /*
        |----------------------------------------------------------------------
        | SHARED ROUTES (Multiple roles)
        |----------------------------------------------------------------------
        */
        Route::middleware(['auth', 'role:admin,staff'])->group(function () {
            Route::get('/patients/create', [PatientController::class, 'create'])->name('patients.create');
            Route::post('/patients/store', [PatientController::class, 'store'])->name('patients.store');

            Route::get('/appointments-by-date', function (Request $request) {
            return Appointments::whereDate('appointment_date', $request->date)->get();


            });
        });



/*
|--------------------------------------------------------------------------
| POS AUTH PAGES (PUBLIC)
|--------------------------------------------------------------------------
*/


/*
|--------------------------------------------------------------------------
| POS SYSTEM (PROTECTED)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:cashier,customer,admin'])
    ->prefix('pos')
    ->name('pos.')
    ->group(function () {

        Route::get('/homepage', [POSController::class, 'homepage'])
            ->name('homepage');

    });
    /*
    |--------------------------------------------------------------------------
    | PREFETCH ROUTE
    |--------------------------------------------------------------------------
    */

    Route::middleware('auth')->group(function () {

        Route::get('/prefetch', [PrefetchController::class, 'index']);

    });
    /*
    |--------------------------------------------------------------------------
    | Two Factor Authentication ROUTES
    |--------------------------------------------------------------------------
    */

Route::get('/2fa/login', [TwoFactorController::class, 'showLogin'])
    ->name('2fa.login');

Route::post('/2fa/login', [TwoFactorController::class, 'verifyLogin'])
    ->name('2fa.login.verify');

Route::middleware('auth')->group(function () {

    Route::get('/settings/2fa', [TwoFactorController::class, 'enable'])
        ->name('settings.2fa');

    Route::post('/settings/2fa/verify', [TwoFactorController::class, 'verify'])
        ->name('settings.2fa.verify');

});

 /*
    |--------------------------------------------------------------------------
    | notification ROUTES
    |--------------------------------------------------------------------------
    */Route::middleware('auth')->group(function () {

    // Mark all notifications as read
    Route::post('/notifications/read-all', function () {

        $updated = Notification::where('user_id', Auth::id())
            ->where('is_read', false)
            ->update([
                'is_read' => true,
            ]);

        return response()->json([
            'success' => true,
            'updated' => $updated,
        ]);

    })->name('notifications.readAll');


    // Delete notification
    Route::delete(
        '/notifications/{notification}',
        [NotificationController::class, 'destroy']
    )->name('notifications.destroy');

});

    require __DIR__.'/auth.php';
