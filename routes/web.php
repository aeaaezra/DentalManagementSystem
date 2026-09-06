<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Http\Controllers\Auth\AuthenticatedSessionController;

use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MessageController;
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

use App\Http\Controllers\ReceptionistAppointmentController;
use App\Http\Controllers\ReceptionistPatientController;
use App\Http\Controllers\ReceptionistNotificationController;
use App\Http\Controllers\ReceptionistSettingsController;

use App\Http\Controllers\DentistAppointmentController;
use App\Http\Controllers\DentistDashboardController;
use App\Http\Controllers\DentistPatientRecordController;
use App\Http\Controllers\DentistOdontogramController;
use App\Http\Controllers\DentistTreatmentController;
use App\Http\Controllers\DentistSettingsController;

use App\Http\Controllers\CustomerOrderController;
use App\Http\Controllers\CustomerController;

use App\Models\Doctor;
use App\Models\Appointments;
use App\Models\Notification;

use App\Http\Controllers\IssueReportController;
use App\Http\Controllers\IssueReportManagementController;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

//ADMIN ISSUE REPORT ROUTES

/*
|--------------------------------------------------------------------------
| APPOINTMENT WELCOME
|--------------------------------------------------------------------------
*/

Route::get(
    '/shine-and-smile/appointments/welcome',
    function () {
        return view('appointments.appointment-welcome');
    }
)->name('appointments.landing');


/*
|--------------------------------------------------------------------------
| ADMIN LOGIN
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    Route::get('/admin-login', function () {
        return view('admin.login');
    })->name('admin.login');

    Route::post(
        '/admin-login',
        [AuthenticatedSessionController::class, 'store']
    )->name('admin.login.store');

});


/*
|--------------------------------------------------------------------------
| APPOINTMENT LOGIN
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    Route::get(
        '/shine-and-smile/appointments/login',
        function () {
            return view('auth.appointment-login');
        }
    )->name('appointments.login');

    Route::post(
        '/shine-and-smile/appointments/login',
        [AuthenticatedSessionController::class, 'store']
    )->name('appointments.login.store');

});


/*
|--------------------------------------------------------------------------
| CUSTOMER LOGIN
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    Route::get(
        '/customer/login',
        function () {
            return view('auth.customer-login');
        }
    )->name('customer.login');

    Route::post(
        '/customer/login',
        [AuthenticatedSessionController::class, 'store']
    )->name('customer.login.store');

});


/*
|--------------------------------------------------------------------------
| DENTIST LOGIN
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    Route::get(
        '/dentist/login',
        function () {
            return view('auth.dentist-login');
        }
    )->name('dentist.login');

    Route::post(
        '/dentist/login',
        [AuthenticatedSessionController::class, 'store']
    )->name('dentist.login.store');

});


/*
|--------------------------------------------------------------------------
| RECEPTIONIST LOGIN
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    Route::get(
        '/receptionist/login',
        function () {
            return view('auth.receptionist-login');
        }
    )->name('receptionist.login');

    Route::post(
        '/receptionist/login',
        [AuthenticatedSessionController::class, 'store']
    )->name('receptionist.login.store');

});


/*
|--------------------------------------------------------------------------
| POS / CASHIER LOGIN
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    Route::get(
        '/pos/login',
        function () {
            return view('auth.pos-login');
        }
    )->name('pos.login');

    Route::post(
        '/pos/login',
        [AuthenticatedSessionController::class, 'store']
    )->name('pos.login.post');

});


/*
|--------------------------------------------------------------------------
| DASHBOARD REDIRECT
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {

        $user = auth()->user();

        if ($user->hasRole('admin')) {
            return redirect('/admin');
        }

        if ($user->hasRole('dentist')) {
            return redirect()->route('dentist.dashboard');
        }

        if ($user->hasRole('receptionist')) {
            return redirect()->route('receptionist.dashboard');
        }

        if ($user->hasRole('cashier')) {
            return redirect()->route('pos.homepage');
        }

        if ($user->hasRole('patient')) {
            return redirect()->route('appointments.homepage');
        }

        if ($user->hasRole('customer')) {
            return redirect()->route('customer.shop');
        }

        if ($user->hasRole('staff')) {
            return redirect()->route('staff.dashboard');
        }

        if ($user->hasRole('manager')) {
            return redirect()->route('manager.dashboard');
        }

        abort(403, 'No valid system role is assigned to this account.');

    })->name('dashboard');


    Route::get(
        '/profile',
        [ProfileController::class, 'edit']
    )->name('profile.edit');


    Route::patch(
        '/profile',
        [ProfileController::class, 'update']
    )->name('profile.update');


    Route::delete(
        '/profile',
        [ProfileController::class, 'destroy']
    )->name('profile.destroy');

});


/*
|--------------------------------------------------------------------------
| ADMIN MODULE
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'role:admin',
])
->prefix('admin')
->name('admin.')
->group(function () {

    Route::get(
        '/appointments-calendar',
        function () {
            return view('appointments.calendar');
        }
    )->name('calendar');

});


/*
|--------------------------------------------------------------------------
| APPOINTMENT MODULE
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'role:patient',
])->group(function () {

Route::get(
    '/shine-and-smile/appointments/settings',
    [
        SettingsController::class,
        'index'
    ]
)->name('appointments.settings');

Route::post(
    '/shine-and-smile/appointments/issue-report',
    [
        IssueReportController::class,
        'store'
    ]
)->name('appointments.issue.store');

    Route::get(
        '/shine-and-smile/appointments/homepage',
        [
            AppointmentBookingController::class,
            'homepage'
        ]
    )->name('appointments.homepage');

    Route::get(
        '/shine-and-smile/appointments/history',
        [
            AppointmentBookingController::class,
            'history'
        ]
    )->name('appointments.history');

    Route::get(
        '/shine-and-smile/appointments/history/print',
        [
            AppointmentBookingController::class,
            'printHistory'
        ]
    )->name('appointments.history.print');

    Route::get(
        '/shine-and-smile/appointments-booking',
        [
            AppointmentBookingController::class,
            'create'
        ]
    )->name('appointments.create');

    Route::post(
        '/shine-and-smile/appointments-booking',
        [
            AppointmentBookingController::class,
            'store'
        ]
    )->name('appointments.store');

    Route::post(
    '/shine-and-smile/odontogram/save',
    [
        OdontogramController::class,
        'store'
    ]
)->name('odontogram.store');

    Route::get(
        '/appointments/{appointment}/thank-you',
        [
            AppointmentBookingController::class,
            'thankYou'
        ]
    )->name('appointments.thankyou');

    Route::post(
        '/shine-and-smile/appointments/{appointment}/cancel',
        [
            AppointmentBookingController::class,
            'cancel'
        ]
    )->name('appointments.cancel');

    Route::get(
        '/shine-and-smile/appointments/aftercare',
        [
            AppointmentBookingController::class,
            'aftercare'
        ]
    )->name('appointments.aftercare');

    Route::get(
        '/shine-and-smile/appointments/settings',
        [
            SettingsController::class,
            'index'
        ]
    )->name('appointments.settings');

    Route::put(
        '/shine-and-smile/appointments/settings/profile',
        [
            ProfileController::class,
            'update'
        ]
    )->name('appointments.settings.profile');

    Route::post(
        '/shine-and-smile/settings/password',
        [
            SettingsController::class,
            'updatePassword'
        ]
    )->name('settings.password.update');

    Route::put(
        '/appointments/settings/notifications',
        [
            AppointmentBookingController::class,
            'updateNotificationSettings'
        ]
    )->name('appointments.settings.notifications');

    Route::get(
        '/shine-and-smile/appointments/dentists',
        function () {

            $doctors = Doctor::all();

            $notifications = Notification::where(
                'user_id',
                Auth::id()
            )
            ->latest()
            ->get();

            $notificationCount = Notification::where(
                'user_id',
                Auth::id()
            )
            ->where(
                'is_read',
                false
            )
            ->count();

            return view(
                'appointments.appointment-dentists',
                compact(
                    'doctors',
                    'notifications',
                    'notificationCount'
                )
            );

        }
    )->name('appointments.dentists');

    Route::post(
        '/shine-and-smile/odontogram/save',
        [
            OdontogramController::class,
            'store'
        ]
    )->name('odontogram.store');

    Route::get(
        '/available-slots',
        [
            AppointmentBookingController::class,
            'availableSlots'
        ]
    )->name('appointments.available-slots');


    Route::post(
    '/notifications/{notification}/mark-read',
    [NotificationController::class, 'markAsRead']
)->name('notifications.mark-read');

Route::post(
    '/notifications/mark-all-read',
    [NotificationController::class, 'markAllAsRead']
)->name('notifications.mark-all-read');


});


/*
|--------------------------------------------------------------------------
| DENTIST MODULE
|--------------------------------------------------------------------------
*/
  Route::get('/dentist/welcome', function () {
        return view('dentist.landingpage');
    })->name('dentist.landingpage');

Route::middleware([
    'auth',
    'role:dentist',
])
->prefix('dentist')
->name('dentist.')
->group(function () {

    Route::get(
        '/dashboard',
        [
            DentistDashboardController::class,
            'index'
        ]
    )->name('dashboard');

    Route::get(
        '/appointments',
        [
            DentistAppointmentController::class,
            'index'
        ]
    )->name('appointments');

    Route::get(
        '/appointments/{id}',
        [
            DentistAppointmentController::class,
            'show'
        ]
    )->name('appointments.show');

    Route::post(
        '/appointments/{id}/confirm',
        [
            DentistAppointmentController::class,
            'confirm'
        ]
    )->name('appointments.confirm');

    Route::post(
        '/appointments/{id}/decline',
        [
            DentistAppointmentController::class,
            'decline'
        ]
    )->name('appointments.decline');

    Route::post(
        '/appointments/{id}/complete',
        [
            DentistAppointmentController::class,
            'complete'
        ]
    )->name('appointments.complete');

    Route::get(
        '/patient-records',
        [
            DentistPatientRecordController::class,
            'index'
        ]
    )->name('patient-records');

    Route::get(
        '/patient-records/{patient}',
        [
            DentistPatientRecordController::class,
            'show'
        ]
    )->name('patient-records.show');

Route::get(
    '/odontogram',
    [
        DentistOdontogramController::class,
        'index'
    ]
)->name('odontogram');

Route::get(
    '/odontogram/patient/{id}',
    [
        DentistOdontogramController::class,
        'patient'
    ]
)->name('odontogram.patient');

Route::post(
    '/odontogram/save',
    [
        DentistOdontogramController::class,
        'save'
    ]
)->name('odontogram.save');

Route::post(
    '/odontogram/clear',
    [
        DentistOdontogramController::class,
        'clear'
    ]
)->name('odontogram.clear');

    Route::get(
        '/treatments',
        [
            DentistTreatmentController::class,
            'index'
        ]
    )->name('treatments');

    Route::post(
        '/treatments',
        [
            DentistTreatmentController::class,
            'store'
        ]
    )->name('treatments.store');

    Route::get(
        '/treatments/{treatment}',
        [
            DentistTreatmentController::class,
            'show'
        ]
    )->name('treatments.show');

    Route::put(
        '/treatments/{treatment}',
        [
            DentistTreatmentController::class,
            'update'
        ]
    )->name('treatments.update');

    Route::delete(
        '/treatments/{treatment}',
        [
            DentistTreatmentController::class,
            'destroy'
        ]
    )->name('treatments.destroy');

    Route::patch(
        '/treatments/{treatment}/toggle-status',
        [
            DentistTreatmentController::class,
            'toggleStatus'
        ]
    )->name('treatments.toggle-status');

    Route::get(
        '/settings',
        [
            DentistSettingsController::class,
            'index'
        ]
    )->name('settings');

    Route::post(
        '/settings/profile',
        [
            DentistSettingsController::class,
            'updateProfile'
        ]
    )->name('settings.profile.update');

    Route::post(
        '/settings/password',
        [
            DentistSettingsController::class,
            'updatePassword'
        ]
    )->name('settings.password.update');

    Route::post(
        '/settings/preferences',
        [
            DentistSettingsController::class,
            'updatePreferences'
        ]
    )->name('settings.preferences.update');

    Route::post(
        '/settings/appearance',
        [
            DentistSettingsController::class,
            'updateAppearance'
        ]
    )->name('settings.appearance.update');

    Route::get(
        '/settings/2fa/setup',
        [
            TwoFactorController::class,
            'enable'
        ]
    )->name('settings.2fa.setup');

    Route::post(
        '/settings/2fa/verify',
        [
            TwoFactorController::class,
            'verifySetup'
        ]
    )->name('settings.2fa.verify');

    Route::post(
        '/settings/2fa/disable',
        [
            TwoFactorController::class,
            'disable'
        ]
    )->name('settings.2fa.disable');

});


/*
|--------------------------------------------------------------------------
| RECEPTIONIST MODULE
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'role:receptionist',
])
->prefix('receptionist')
->name('receptionist.')
->group(function () {

    Route::get(
        '/dashboard',
        [
            ReceptionistAppointmentController::class,
            'dashboard'
        ]
    )->name('dashboard');

    Route::post(
        '/appointments/{appointment}/check-in',
        [
            ReceptionistAppointmentController::class,
            'checkIn'
        ]
    )->name('appointments.check-in');

    Route::post(
        '/appointments/{appointment}/start-treatment',
        [
            ReceptionistAppointmentController::class,
            'startTreatment'
        ]
    )->name('appointments.start-treatment');

    Route::post(
        '/appointments/{appointment}/check-out',
        [
            ReceptionistAppointmentController::class,
            'checkOut'
        ]
    )->name('appointments.check-out');

    Route::get(
        '/patients',
        [
            ReceptionistPatientController::class,
            'index'
        ]
    )->name('patients.index');

    Route::get(
        '/patients/{patient}',
        [
            ReceptionistPatientController::class,
            'show'
        ]
    )->name('patients.show');

    Route::post(
        '/patients',
        [
            ReceptionistPatientController::class,
            'store'
        ]
    )->name('patients.store');

    Route::put(
        '/patients/{patient}',
        [
            ReceptionistPatientController::class,
            'update'
        ]
    )->name('patients.update');


    /*
    |--------------------------------------------------------------------------
    | RECEPTIONIST NOTIFICATIONS
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/notifications',
        [
            ReceptionistNotificationController::class,
            'index'
        ]
    )->name('notifications.index');

    Route::patch(
        '/notifications/read-all',
        [
            ReceptionistNotificationController::class,
            'markAllAsRead'
        ]
    )->name('notifications.read-all');

    Route::patch(
        '/notifications/{notification}/read',
        [
            ReceptionistNotificationController::class,
            'markAsRead'
        ]
    )->name('notifications.read');

    Route::delete(
        '/notifications/{notification}',
        [
            ReceptionistNotificationController::class,
            'destroy'
        ]
    )->name('notifications.destroy');


    /*
    |--------------------------------------------------------------------------
    | RECEPTIONIST SETTINGS
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/settings',
        [
            ReceptionistSettingsController::class,
            'index'
        ]
    )->name('settings');

    Route::put(
        '/settings',
        [
            ReceptionistSettingsController::class,
            'update'
        ]
    )->name('settings.update');

    Route::put(
        '/settings/password',
        [
            ReceptionistSettingsController::class,
            'updatePassword'
        ]
    )->name('settings.password');

    Route::post(
        '/settings/2fa/enable',
        [
            ReceptionistSettingsController::class,
            'enableTwoFactor'
        ]
    )->name('settings.2fa.enable');

    Route::get(
        '/settings/2fa/setup',
        [
            ReceptionistSettingsController::class,
            'showTwoFactorSetup'
        ]
    )->name('settings.2fa.setup');

    Route::post(
        '/settings/2fa/verify',
        [
            ReceptionistSettingsController::class,
            'verifyTwoFactor'
        ]
    )->name('settings.2fa.verify');

    Route::delete(
        '/settings/2fa/disable',
        [
            ReceptionistSettingsController::class,
            'disableTwoFactor'
        ]
    )->name('settings.2fa.disable');

});


/*
|--------------------------------------------------------------------------
| POS / CASHIER MODULE
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'role:cashier,customer,admin',
])
->prefix('pos')
->name('pos.')
->group(function () {

    Route::get(
        '/homepage',
        [
            POSController::class,
            'homepage'
        ]
    )->name('homepage');

    Route::post(
        '/checkout',
        [
            POSController::class,
            'checkout'
        ]
    )->name('checkout');

    Route::view(
        '/profile',
        'pos.profile'
    )->name('profile');

    Route::view(
        '/settings',
        'pos.settings'
    )->name('settings');

});


/*
|--------------------------------------------------------------------------
| CUSTOMER MODULE
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {

    Route::get('/customer/login', function () {
        return view('auth.customer-login');
    })->name('customer.login');

    Route::post('/customer/login', [
        AuthenticatedSessionController::class,
        'store'
    ])->name('customer.login.store');
});

Route::middleware([
    'auth',
    'role:customer',
])
->prefix('customer')
->name('customer.')
->group(function () {

    Route::get('/shop', [
        CustomerOrderController::class,
        'products'
    ])->name('shop');

    Route::get('/products', [
        CustomerOrderController::class,
        'products'
    ])->name('products');

    Route::get('/cart', [
        CustomerOrderController::class,
        'cart'
    ])->name('cart');

    Route::get('/orders', [
        CustomerOrderController::class,
        'orders'
    ])->name('orders');

    Route::get('/checkout', [
        CustomerOrderController::class,
        'checkout'
    ])->name('checkout');

    Route::get('/settings', [
        CustomerOrderController::class,
        'settings'
    ])->name('settings');

    Route::get('/profile', [
        CustomerOrderController::class,
        'profile'
    ])->name('profile');
});

/*
|--------------------------------------------------------------------------
| STAFF MODULE
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'role:staff,admin',
])
->prefix('staff')
->name('staff.')
->group(function () {

    Route::get(
        '/dashboard',
        function () {
            return view('staff.dashboard');
        }
    )->name('dashboard');

});


/*
|--------------------------------------------------------------------------
| MANAGER MODULE
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'role:manager,admin',
])
->prefix('manager')
->name('manager.')
->group(function () {

    Route::get(
        '/dashboard',
        function () {
            return view('manager.dashboard');
        }
    )->name('dashboard');

});


/*
|--------------------------------------------------------------------------
| CONTACT MODULE
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get(
        '/contact',
        [ContactController::class, 'index']
    )->name('contact');

    Route::post(
        '/contact',
        [ContactController::class, 'store']
    )->name('contact.store');

});


/*
|--------------------------------------------------------------------------
| FAQ
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get(
        '/faq',
        function () {
            return view('appointments.faq');
        }
    )->name('faq');

});


/*
|--------------------------------------------------------------------------
| FEEDBACK
|--------------------------------------------------------------------------
*/

Route::post(
    '/appointments/{appointment}/feedback',
    [FeedbackController::class, 'store']
)
->middleware('auth')
->name('appointments.feedback.store');


/*
|--------------------------------------------------------------------------
| SHARED ADMIN + STAFF ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'role:admin,staff',
])
->group(function () {

    Route::get(
        '/patients/create',
        [
            PatientController::class,
            'create'
        ]
    )->name('patients.create');

    Route::post(
        '/patients/store',
        [
            PatientController::class,
            'store'
        ]
    )->name('patients.store');

    Route::get(
        '/appointments-by-date',
        function (Request $request) {

            return Appointments::whereDate(
                'appointment_date',
                $request->date
            )->get();

        }
    );

});


/*
|--------------------------------------------------------------------------
| PREFETCH
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get(
        '/prefetch',
        [
            PrefetchController::class,
            'index'
        ]
    );

});


/*
|--------------------------------------------------------------------------
| TWO FACTOR AUTHENTICATION
|--------------------------------------------------------------------------
*/

Route::get(
    '/2fa/login',
    [
        TwoFactorController::class,
        'showLogin'
    ]
)->name('2fa.login');


Route::post(
    '/2fa/login',
    [
        TwoFactorController::class,
        'verifyLogin'
    ]
)->name('2fa.login.verify');


Route::middleware('auth')->group(function () {

    Route::get(
        '/settings/2fa',
        [
            TwoFactorController::class,
            'showSetup'
        ]
    )->name('settings.2fa');

    Route::post(
        '/2fa/enable',
        [
            TwoFactorController::class,
            'enable'
        ]
    )->name('2fa.enable');

    Route::post(
        '/2fa/verify',
        [
            TwoFactorController::class,
            'verifySetup'
        ]
    )->name('2fa.verify');

    Route::post(
        '/2fa/disable',
        [
            TwoFactorController::class,
            'disable'
        ]
    )->name('2fa.disable');

});

//GENERAL NOTIFICATION ROUTES FOR ALL USERS

Route::middleware('auth')->group(function () {
Route::post('/notifications/read-all', function () {

    $updated = Notification::where(
        'notifiable_type',
        get_class(Auth::user())
    )
        ->where(
            'notifiable_id',
            Auth::id()
        )
        ->whereNull('read_at')
        ->update([
            'read_at' => now(),
        ]);

    return response()->json([
        'success' => true,
        'updated' => $updated,
    ]);

})->name('notifications.readAll');

Route::delete('/notifications', function () {
    $deleted = Notification::where(
        'notifiable_type',
        get_class(Auth::user())
    )
        ->where(
            'notifiable_id',
            Auth::id()
        )
        ->delete();

    return response()->json([
        'success' => true,
        'deleted' => $deleted,
    ]);
})->name('notifications.clearAll');


    Route::delete(
        '/notifications/{notification}',
        [
            NotificationController::class,
            'destroy'
        ]
    )->name('notifications.destroy');

});
/*
|--------------------------------------------------------------------------
| LARAVEL BREEZE AUTH ROUTES
|--------------------------------------------------------------------------
*/

Route::post(
    '/contact/send',
    [ContactController::class, 'send']
)
    ->middleware('throttle:5,1')
    ->name('contact.send');

require __DIR__ . '/auth.php';
