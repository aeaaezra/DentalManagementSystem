<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Settings | Shine & Smile</title>

    <link
        rel="stylesheet"
        href="{{ asset('css/receptionist/receptionist-settings.css') }}"
    >
</head>

<body class="receptionist-body">


<header class="topbar">


    <div>

        <h2>
            Receptionist Dashboard
        </h2>

        <p>
            Manage today's patient appointments
        </p>

    </div>




    <div class="topbar-right">

        <span class="current-date">

            {{ now()->format('F d, Y') }}

        </span>


        <a
            href="{{ route('receptionist.notifications.index') }}"
            class="notification-button"
            aria-label="Notifications"
        >

            <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
            >

                <path
                    d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9"
                />

                <path
                    d="M10 21h4"
                />

            </svg>


            {{-- UNREAD NOTIFICATION COUNT --}}

            @php

                $unreadNotificationCount = auth()
                    ->user()
                    ->unreadNotifications()
                    ->count();

            @endphp


            @if($unreadNotificationCount > 0)

                <span class="notification-dot"></span>

                <span class="notification-count">
                    {{ $unreadNotificationCount }}
                </span>

            @endif

        </a>



        <div class="top-avatar">

            @if(auth()->user()->profile_picture)

                <img
                    src="{{ asset('storage/' . auth()->user()->profile_picture) }}"
                    alt="{{ auth()->user()->name }}"
                    class="top-avatar-image"
                >

            @else

                <span class="top-avatar-letter">

                    {{ strtoupper(
                        substr(
                            auth()->user()->name ?? 'R',
                            0,
                            1
                        )
                    ) }}

                </span>

            @endif

        </div>


        {{-- =================================================
             LOGOUT FORM
        ================================================== --}}

<form
    id="logoutForm"
    action="{{ route('logout') }}"
    method="POST"
>
    @csrf

    <button
        type="button"
        class="header-logout-button open-settings-confirm"
        data-form="logoutForm"
        data-title="Confirm Logout"
        data-message="Are you sure you want to log out of your account?"
        data-confirm="Yes, Logout"
    >
        <svg
            xmlns="http://www.w3.org/2000/svg"
            width="17"
            height="17"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
        >
            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
            <polyline points="16 17 21 12 16 7" />
            <line x1="21" y1="12" x2="9" y2="12" />
        </svg>

        Logout
    </button>
</form>

    </div>

</header>
<div class="receptionist-layout">

    {{-- =====================================================
         SIDEBAR
    ====================================================== --}}

    <aside class="receptionist-sidebar">

    {{-- =====================================================
         SIDEBAR BRAND
    ====================================================== --}}

    <div class="sidebar-brand">

        <div class="sidebar-logo">

            <svg
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.8"
                stroke-linecap="round"
                stroke-linejoin="round"
                aria-hidden="true"
            >

                <path
                    d="M7 3C5.2 3 4 4.5 4 6.5C4 9.5 5.2 11.5 6 14.5C6.6 16.8 6.8 21 9 21C10.8 21 11 17 12 17C13 17 13.2 21 15 21C17.2 21 17.4 16.8 18 14.5C18.8 11.5 20 9.5 20 6.5C20 4.5 18.8 3 17 3C15.3 3 14.1 4.2 12 4.2C9.9 4.2 8.7 3 7 3Z"
                />

            </svg>

        </div>


        <div class="sidebar-brand-text">

            <strong>
                Shine &amp; Smile
            </strong>

            <span>
                Receptionist
            </span>

        </div>

    </div>


    {{-- =====================================================
         SIDEBAR NAVIGATION
    ====================================================== --}}

    <nav class="sidebar-navigation">


        {{-- DASHBOARD --}}

        <a
            href="{{ route('receptionist.dashboard') }}"
            class="sidebar-link {{ request()->routeIs('receptionist.dashboard') ? 'active' : '' }}"
        >

            <svg
                xmlns="http://www.w3.org/2000/svg"
                width="20"
                height="20"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.8"
                stroke-linecap="round"
                stroke-linejoin="round"
                aria-hidden="true"
            >

                <path d="M3 10.5L12 3l9 7.5" />

                <path d="M5 9.5V21h14V9.5" />

                <path d="M9 21v-6h6v6" />

            </svg>

            <span>
                Dashboard
            </span>

        </a>


        {{-- APPOINTMENTS --}}

        <a
            href="{{ route('receptionist.dashboard') }}#appointments"
            class="sidebar-link {{ request()->routeIs('receptionist.dashboard') && request()->get('section') === 'appointments' ? 'active' : '' }}"
        >

            <svg
                xmlns="http://www.w3.org/2000/svg"
                width="20"
                height="20"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.8"
                stroke-linecap="round"
                stroke-linejoin="round"
                aria-hidden="true"
            >

                <rect
                    x="3"
                    y="5"
                    width="18"
                    height="16"
                    rx="2"
                />

                <path d="M16 3v4" />

                <path d="M8 3v4" />

                <path d="M3 10h18" />

            </svg>

            <span>
                Appointments
            </span>

        </a>


        {{-- PATIENTS --}}

        <a
            href="{{ route('receptionist.patients.index') }}"
            class="sidebar-link {{ request()->routeIs('receptionist.patients.*') ? 'active' : '' }}"
        >

            <svg
                xmlns="http://www.w3.org/2000/svg"
                width="20"
                height="20"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.8"
                stroke-linecap="round"
                stroke-linejoin="round"
                aria-hidden="true"
            >

                <path
                    d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"
                />

                <circle
                    cx="9"
                    cy="7"
                    r="4"
                />

                <path
                    d="M22 21v-2a4 4 0 0 0-3-3.87"
                />

                <path
                    d="M16 3.13a4 4 0 0 1 0 7.75"
                />

            </svg>

            <span>
                Patients
            </span>

        </a>


        {{-- NOTIFICATIONS --}}

        <a
            href="{{ route('receptionist.notifications.index') }}"
            class="sidebar-link {{ request()->routeIs('receptionist.notifications.*') ? 'active' : '' }}"
        >

            <svg
                xmlns="http://www.w3.org/2000/svg"
                width="20"
                height="20"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.8"
                stroke-linecap="round"
                stroke-linejoin="round"
                aria-hidden="true"
            >

                <path
                    d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9"
                />

                <path d="M10 21h4" />

            </svg>

            <span>
                Notifications
            </span>


            @if(isset($unreadCount) && $unreadCount > 0)

                <span class="sidebar-notification-count">
                    {{ $unreadCount }}
                </span>

            @endif

        </a>


        {{-- SETTINGS --}}

        <a
            href="{{ route('receptionist.settings') }}"
            class="sidebar-link {{ request()->routeIs('receptionist.settings*') ? 'active' : '' }}"
        >

            <svg
                xmlns="http://www.w3.org/2000/svg"
                width="20"
                height="20"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.8"
                stroke-linecap="round"
                stroke-linejoin="round"
                aria-hidden="true"
            >

                <path
                    d="M12 15.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Z"
                />

                <path
                    d="M19.4 15a1.7 1.7 0 0 0 .34 1.88l.06.06-1.41 1.41-.06-.06a1.7 1.7 0 0 0-1.88-.34 1.7 1.7 0 0 0-1.03 1.56V20h-2v-.49a1.7 1.7 0 0 0-1.03-1.56 1.7 1.7 0 0 0-1.88.34l-.06.06-1.41-1.41.06-.06A1.7 1.7 0 0 0 9.4 15a1.7 1.7 0 0 0-1.56-1.03H7.35v-2h.49A1.7 1.7 0 0 0 9.4 10.94a1.7 1.7 0 0 0-.34-1.88L9 9l1.41-1.41.06.06a1.7 1.7 0 0 0 1.88.34A1.7 1.7 0 0 0 13.38 6.43V6h2v.43a1.7 1.7 0 0 0 1.03 1.56 1.7 1.7 0 0 0 1.88-.34l.06-.06L19.76 9l-.06.06a1.7 1.7 0 0 0-.34 1.88A1.7 1.7 0 0 0 20.92 12h.43v2h-.43A1.7 1.7 0 0 0 19.4 15Z"
                />

            </svg>

            <span>
                Settings
            </span>

        </a>

    </nav>


    {{-- =====================================================
         SIDEBAR USER PROFILE
    ====================================================== --}}

    <div class="sidebar-user">


        {{-- PROFILE AVATAR --}}

        <div class="sidebar-user-avatar">

            @if(
                auth()->check() &&
                !empty(auth()->user()->profile_picture)
            )

                <img
                    src="{{ asset('storage/' . auth()->user()->profile_picture) }}"
                    alt="{{ auth()->user()->name ?? 'Receptionist' }}"
                    class="sidebar-user-image"
                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                >

                {{-- FALLBACK IF IMAGE DOES NOT LOAD --}}

                <span
                    class="sidebar-user-letter"
                    style="display: none;"
                >
                    {{ strtoupper(
                        substr(
                            auth()->user()->name ?? 'R',
                            0,
                            1
                        )
                    ) }}
                </span>

            @else

                {{-- FALLBACK LETTER --}}

                <span class="sidebar-user-letter">

                    {{ strtoupper(
                        substr(
                            auth()->user()->name ?? 'R',
                            0,
                            1
                        )
                    ) }}

                </span>

            @endif

        </div>


        {{-- USER DETAILS --}}

        <div class="sidebar-user-info">

            <strong>
                {{ auth()->user()->name ?? 'Receptionist' }}
            </strong>

            <span>
                Receptionist
            </span>

        </div>


    </div>


</aside>


    {{-- =====================================================
         MAIN CONTENT
    ====================================================== --}}

    <main class="receptionist-main">

        <div class="settings-page">

            <div class="settings-header">

                <div>
                    <div class="breadcrumb">
                        Receptionist / Settings
                    </div>

                    <h1>Settings</h1>

                    <p>
                        Manage your account and receptionist preferences.
                    </p>
                </div>

            </div>


            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('password_success'))
                <div class="alert alert-success">
                    {{ session('password_success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-error">
                    <strong>Please check the following:</strong>

                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


{{-- =================================================
     PROFILE INFORMATION
================================================= --}}

<section class="settings-card">

    {{-- HEADER --}}
    <div class="card-heading">

        <div class="card-icon">

            <svg
                xmlns="http://www.w3.org/2000/svg"
                width="21"
                height="21"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.8"
                stroke-linecap="round"
                stroke-linejoin="round"
            >
                <path d="M20 21a8 8 0 0 0-16 0"></path>
                <circle cx="12" cy="7" r="4"></circle>
            </svg>

        </div>

        <div>

            <h2>
                Profile Information
            </h2>

            <p>
                Manage your receptionist profile information.
            </p>

        </div>

    </div>


    {{-- =================================================
         FORM
    ================================================== --}}

    <form
    id="profileForm"
    action="{{ route('receptionist.settings.update') }}"
    method="POST"
    enctype="multipart/form-data"
    class="settings-form"
>

        @csrf

        @method('PUT')


        {{-- =================================================
             PROFILE IMAGE
        ================================================== --}}

        <div class="profile-image-section">

            <div class="profile-image-wrapper">

                @if($user->profile_picture)

                    <img
                        src="{{ asset('storage/' . $user->profile_picture) }}"
                        alt="{{ $user->name }}"
                        class="profile-image"
                    >

                @else

                    <div class="profile-image-placeholder">

                        {{ strtoupper(substr($user->name, 0, 1)) }}

                    </div>

                @endif

            </div>


            <div class="profile-image-info">

                <label
                    for="profile_picture"
                    class="profile-image-label"
                >
                    Profile Image
                </label>


                <p class="profile-image-description">
                    Upload a profile picture for your receptionist account.
                </p>


                <input
                    id="profile_picture"
                    name="profile_picture"
                    type="file"
                    accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                    class="profile-image-input"
                >


                <p class="profile-image-hint">
                    JPG, PNG or WEBP. Maximum 2MB.
                </p>


                @error('profile_picture')

                    <p class="form-error">
                        {{ $message }}
                    </p>

                @enderror

            </div>

        </div>


        {{-- =================================================
             FULL NAME / EMAIL
        ================================================== --}}

        <div class="form-grid">

            <div class="form-group">

                <label for="name">
                    Full Name
                </label>

                <input
                    id="name"
                    type="text"
                    value="{{ $user->name }}"
                    disabled
                    class="disabled-input"
                >

                <small class="input-help">
                    Your name cannot be changed from this page.
                </small>

            </div>


            <div class="form-group">

                <label for="email">
                    Email Address
                </label>

                <input
                    id="email"
                    type="email"
                    value="{{ $user->email }}"
                    disabled
                    class="disabled-input"
                >

                <small class="input-help">
                    Your email cannot be changed from this page.
                </small>

            </div>

        </div>


        {{-- =================================================
             ACCOUNT ROLE
        ================================================== --}}

        <div class="account-role">

            <span class="role-label">
                Account Role
            </span>

            <span class="role-badge">
                {{ ucfirst($user->role) }}
            </span>

        </div>


        {{-- =================================================
             SAVE BUTTON
        ================================================== --}}

        <div class="form-actions">

            <button
                    type="button"
                    class="primary-button open-settings-confirm"
                    data-form="profileForm"
                    data-title="Save profile changes?"
                    data-message="Are you sure you want to save your profile changes?"
                    data-confirm="Yes, save profile"
                >

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="17"
                    height="17"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >
                    <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                    <polyline points="17 21 17 13 7 13 7 21"></polyline>
                    <polyline points="7 3 7 8 15 8"></polyline>
                </svg>

                Save Profile

            </button>

        </div>

    </form>

</section>

{{-- =================================================
     PASSWORD
================================================= --}}

<section class="settings-card">

    {{-- CARD HEADER --}}
    <div class="card-heading">

        <div class="card-icon">

            <svg
                xmlns="http://www.w3.org/2000/svg"
                width="21"
                height="21"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.8"
                stroke-linecap="round"
                stroke-linejoin="round"
            >
                <rect
                    x="3"
                    y="11"
                    width="18"
                    height="10"
                    rx="2"
                ></rect>

                <path
                    d="M7 11V7a5 5 0 0 1 10 0v4"
                ></path>

            </svg>

        </div>


        <div>

            <h2>
                Change Password
            </h2>

            <p>
                Use a strong password to protect your account.
            </p>

        </div>

    </div>


    {{-- PASSWORD FORM --}}
    <form
        action="{{ route('receptionist.settings.password') }}"
        method="POST"
        class="settings-form"
        id="passwordForm"
    >

        @csrf

        @method('PUT')


        {{-- =================================================
             CURRENT PASSWORD
        ================================================== --}}

        <div class="form-group full-width">

            <label for="current_password">
                Current Password
            </label>


            <div class="password-wrapper">

                <input
                    id="current_password"
                    name="current_password"
                    type="password"
                    autocomplete="current-password"
                    required
                >


                <button
                    type="button"
                    class="password-toggle"
                    data-target="current_password"
                    aria-label="Show current password"
                >
                    Show
                </button>

            </div>

        </div>



        {{-- =================================================
             NEW PASSWORD + CONFIRM PASSWORD
        ================================================== --}}

        <div class="password-fields-grid">


            {{-- NEW PASSWORD --}}

            <div class="form-group">

                <label for="password">
                    New Password
                </label>


                <div class="password-wrapper">

                    <input
                        id="password"
                        name="password"
                        type="password"
                        minlength="8"
                        autocomplete="new-password"
                        required
                    >


                    <button
                        type="button"
                        class="password-toggle"
                        data-target="password"
                        aria-label="Show new password"
                    >
                        Show
                    </button>

                </div>

            </div>



            {{-- CONFIRM PASSWORD --}}

            <div class="form-group">

                <label for="password_confirmation">
                    Confirm New Password
                </label>


                <div class="password-wrapper">

                    <input
                        id="password_confirmation"
                        name="password_confirmation"
                        type="password"
                        minlength="8"
                        autocomplete="new-password"
                        required
                    >


                    <button
                        type="button"
                        class="password-toggle"
                        data-target="password_confirmation"
                        aria-label="Show password confirmation"
                    >
                        Show
                    </button>

                </div>

            </div>

        </div>



        {{-- =================================================
             PASSWORD STRENGTH CHECKER
        ================================================== --}}

        <div class="password-strength-container">


            {{-- STRENGTH HEADER --}}

            <div class="password-strength-header">

                <span>
                    Password strength
                </span>


                <strong
                    id="passwordStrengthText"
                >
                    Not entered
                </strong>

            </div>


            {{-- STRENGTH BAR --}}

            <div class="password-strength-bar">

                <div
                    id="passwordStrengthBar"
                    class="password-strength-progress"
                ></div>

            </div>


            {{-- REQUIREMENTS --}}

            <ul class="password-requirements">


                {{-- LENGTH --}}

                <li id="lengthRequirement">

                    <span>○</span>

                    At least 8 characters

                </li>


                {{-- UPPERCASE --}}

                <li id="uppercaseRequirement">

                    <span>○</span>

                    One uppercase letter

                </li>


                {{-- LOWERCASE --}}

                <li id="lowercaseRequirement">

                    <span>○</span>

                    One lowercase letter

                </li>


                {{-- NUMBER --}}

                <li id="numberRequirement">

                    <span>○</span>

                    One number

                </li>


                {{-- SPECIAL CHARACTER --}}

                <li id="specialRequirement">

                    <span>○</span>

                    One special character

                </li>


            </ul>

        </div>



        {{-- =================================================
             PASSWORD MATCH MESSAGE
        ================================================== --}}

        <div
            class="password-match"
            id="passwordMatch"
        ></div>



        {{-- =================================================
             FORM ACTION
        ================================================== --}}

        <div class="form-actions">

            <button
                    type="button"
                    class="primary-button open-settings-confirm"
                    id="changePasswordButton"
                    data-form="passwordForm"
                    data-title="Change password?"
                    data-message="Are you sure you want to change your password?"
                    data-confirm="Yes, change password"
                >
                    Change Password
                </button>

        </div>


    </form>

</section>


{{-- =================================================
     GOOGLE AUTHENTICATOR
================================================= --}}

<section class="settings-card">

    {{-- HEADER --}}
    <div class="card-heading">

        <div class="card-icon">

            <svg
                xmlns="http://www.w3.org/2000/svg"
                width="21"
                height="21"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.8"
                stroke-linecap="round"
                stroke-linejoin="round"
            >
                <rect
                    x="3"
                    y="11"
                    width="18"
                    height="10"
                    rx="2"
                ></rect>

                <path
                    d="M7 11V7a5 5 0 0 1 10 0v4"
                ></path>

            </svg>

        </div>


        <div>

            <h2>
                Google Authenticator
            </h2>

            <p>
                Add an extra layer of security to your receptionist account.
            </p>

        </div>

    </div>


    {{-- =================================================
         CURRENT STATUS
    ================================================== --}}

    <div class="two-factor-status">

        <div class="two-factor-status-text">

            <strong>
                Two-Factor Authentication
            </strong>

            <span>
                Require a verification code when signing in.
            </span>

        </div>


        @if($user->two_factor_enabled)

            <span class="security-status enabled">

                <span class="status-dot"></span>

                Enabled

            </span>

        @else

            <span class="security-status disabled">

                <span class="status-dot"></span>

                Disabled

            </span>

        @endif

    </div>



    {{-- =================================================
         SUCCESS MESSAGE
    ================================================== --}}

    @if(session('two_factor_success'))

        <div class="security-success">

            <svg
                xmlns="http://www.w3.org/2000/svg"
                width="18"
                height="18"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
            >
                <path d="M20 6L9 17l-5-5"></path>
            </svg>

            <span>
                {{ session('two_factor_success') }}
            </span>

        </div>

    @endif



    {{-- =================================================
         ERROR MESSAGE
    ================================================== --}}

    @if(session('two_factor_error'))

        <div class="security-error">

            <svg
                xmlns="http://www.w3.org/2000/svg"
                width="18"
                height="18"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
            >
                <circle
                    cx="12"
                    cy="12"
                    r="9"
                ></circle>

                <path d="M12 8v4"></path>

                <path d="M12 16h.01"></path>

            </svg>

            <span>
                {{ session('two_factor_error') }}
            </span>

        </div>

    @endif



    {{-- =================================================
         ENABLE 2FA
    ================================================== --}}

    @if(!$user->two_factor_enabled)

        <div class="two-factor-description">

            <div class="security-info-icon">

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="18"
                    height="18"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >
                    <circle
                        cx="12"
                        cy="12"
                        r="9"
                    ></circle>

                    <path d="M12 11v5"></path>

                    <path d="M12 8h.01"></path>

                </svg>

            </div>


            <div>

                <strong>
                    Protect your account
                </strong>

                <p>
                    When enabled, you will need to enter a
                    verification code from Google Authenticator
                    after entering your password.
                </p>

            </div>

        </div>


        <form
            action="{{ route('receptionist.settings.2fa.enable') }}"
            method="POST"
        >

            @csrf

            <button
                type="submit"
                class="primary-button"
            >

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="17"
                    height="17"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >
                    <rect
                        x="3"
                        y="11"
                        width="18"
                        height="10"
                        rx="2"
                    ></rect>

                    <path
                        d="M7 11V7a5 5 0 0 1 10 0v4"
                    ></path>

                </svg>

                Set Up Google Authenticator

            </button>

        </form>


    {{-- =================================================
         ENABLED
    ================================================== --}}

    @else

        <div class="two-factor-enabled">

            <div class="security-success">

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="18"
                    height="18"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >
                    <path d="M20 6L9 17l-5-5"></path>
                </svg>

                <span>
                    Google Authenticator is currently enabled.
                </span>

            </div>


            <p class="two-factor-enabled-description">

                Your account is protected with
                two-factor authentication.

                You will be asked for a verification
                code when you sign in.

            </p>


            <form
                action="{{ route('receptionist.settings.2fa.disable') }}"
                method="POST"
                class="disable-2fa-form"
            >

                @csrf

                @method('DELETE')

                <button
                    type="submit"
                    class="logout-button"
                    onclick="return confirm(
                        'Are you sure you want to disable Google Authenticator?'
                    )"
                >

                    Disable Google Authenticator

                </button>

            </form>

        </div>

    @endif

</section>


            {{-- =================================================
                 NOTIFICATION PREFERENCES
            ================================================== --}}

            <section class="settings-card">

                <div class="card-heading">

                    <div class="card-icon">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="21"
                            height="21"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <path d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9"></path>
                            <path d="M10 21h4"></path>
                        </svg>
                    </div>

                    <div>
                        <h2>Notification Preferences</h2>
                        <p>Choose which account notifications you receive.</p>
                    </div>

                </div>


                <form
                    id="preferencesForm"
                    action="{{ route('receptionist.settings.update') }}"
                    method="POST"
                    class="settings-form"
                >

                    @csrf
                    @method('PUT')

                    <input
                        type="hidden"
                        name="name"
                        value="{{ $user->name }}"
                    >

                    <input
                        type="hidden"
                        name="email"
                        value="{{ $user->email }}"
                    >


                    <label class="preference-row">

                        <div class="preference-text">

                            <strong>
                                Appointment Reminders
                            </strong>

                            <span>
                                Receive reminders about upcoming appointments.
                            </span>

                        </div>

                        <span class="switch">

                            <input
                                type="checkbox"
                                name="appointment_reminders"
                                value="1"
                                {{ $user->appointment_reminders ? 'checked' : '' }}
                            >

                            <span class="slider"></span>

                        </span>

                    </label>


                    <label class="preference-row">

                        <div class="preference-text">

                            <strong>
                                Promotional Emails
                            </strong>

                            <span>
                                Receive clinic announcements and promotional messages.
                            </span>

                        </div>

                        <span class="switch">

                            <input
                                type="checkbox"
                                name="promotional_emails"
                                value="1"
                                {{ $user->promotional_emails ? 'checked' : '' }}
                            >

                            <span class="slider"></span>

                        </span>

                    </label>


                    <div class="form-actions">

                        <button
                            type="button"
                            class="primary-button open-settings-confirm"
                            data-form="preferencesForm"
                            data-title="Save preferences?"
                            data-message="Are you sure you want to save your notification preferences?"
                            data-confirm="Yes, save preferences"
                        >
                            Save Preferences
                        </button>

                    </div>

                </form>

            </section>


            {{-- =================================================
                 ACCOUNT
            ================================================== --}}


        </div>

    </main>

</div>

<div
    class="settings-modal-overlay"
    id="settingsConfirmModal"
>
    <div class="settings-confirm-modal">

        <div class="settings-modal-icon">

            <svg
                xmlns="http://www.w3.org/2000/svg"
                width="28"
                height="28"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
            >
                <path d="M12 9v4"></path>
                <path d="M12 17h.01"></path>
                <path d="M10.3 3.9 2.6 17a2 2 0 0 0 1.7 3h15.4a2 2 0 0 0 1.7-3L13.7 3.9a2 2 0 0 0-3.4 0z"></path>
            </svg>

        </div>

        <h3 id="settingsConfirmTitle">
            Confirm Action
        </h3>

        <p id="settingsConfirmMessage">
            Are you sure you want to continue?
        </p>

        <div class="settings-modal-actions">

            <button
                type="button"
                class="settings-modal-cancel"
                id="cancelSettingsAction"
            >
                Cancel
            </button>

            <button
                type="button"
                class="settings-modal-confirm"
                id="confirmSettingsAction"
            >
                Confirm
            </button>

        </div>

    </div>
</div>


<script src="{{ asset('js/receptionist/receptionist-settings.js') }}"></script>

</body>
</html>
