<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >

    <title>
        Settings | Shine & Smile Dental Clinic
    </title>

    <link
        rel="stylesheet"
        href="{{ asset('css/dentists/dentist-settings.css') }}"
    >

</head>

<body>

<div class="settings-page">

<aside
    class="sidebar"
    id="sidebar"
>


    <div class="sidebar-header">

        <div class="clinic-brand">

            <div class="clinic-logo">

                <svg
                    viewBox="0 0 64 64"
                    fill="none"
                    aria-hidden="true"
                >

                    <path
                        d="M18 10C11 12 8 19 10 27C12 34 15 39 17 48C18 53 20 56 24 56C28 56 29 51 30 46C31 42 33 42 34 46C35 51 36 56 40 56C44 56 46 53 47 48C49 39 52 34 54 27C56 19 53 12 46 10C41 8 37 11 32 12C27 11 23 8 18 10Z"
                        stroke="currentColor"
                        stroke-width="3"
                        stroke-linejoin="round"
                    />

                    <path
                        d="M22 22C25 19 28 18 32 19C36 18 39 19 42 22"
                        stroke="currentColor"
                        stroke-width="3"
                        stroke-linecap="round"
                    />

                </svg>

            </div>


            <div class="clinic-brand-text">

                <strong>
                    Shine & Smile
                </strong>

                <span>
                    Dental Clinic
                </span>

            </div>

        </div>


        <button
            type="button"
            class="sidebar-close"
            id="sidebarClose"
            aria-label="Close sidebar"
        >

            <svg
                viewBox="0 0 24 24"
                fill="none"
                aria-hidden="true"
            >

                <path
                    d="M6 6L18 18M18 6L6 18"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                />

            </svg>

        </button>

    </div>


    <nav class="sidebar-navigation">

        <div class="navigation-section-title">
            MAIN MENU
        </div>

        <a
            href="{{ route('dentist.dashboard') }}"
            class="navigation-item {{ request()->routeIs('dentist.dashboard') ? 'active' : '' }}"
        >

            <span class="navigation-icon">

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    aria-hidden="true"
                >

                    <rect
                        x="4"
                        y="4"
                        width="6"
                        height="6"
                        rx="1"
                        stroke="currentColor"
                        stroke-width="1.8"
                    />

                    <rect
                        x="14"
                        y="4"
                        width="6"
                        height="6"
                        rx="1"
                        stroke="currentColor"
                        stroke-width="1.8"
                    />

                    <rect
                        x="4"
                        y="14"
                        width="6"
                        height="6"
                        rx="1"
                        stroke="currentColor"
                        stroke-width="1.8"
                    />

                    <rect
                        x="14"
                        y="14"
                        width="6"
                        height="6"
                        rx="1"
                        stroke="currentColor"
                        stroke-width="1.8"
                    />

                </svg>

            </span>

            <span>
                Dashboard
            </span>

        </a>


        {{-- ========================================================
             APPOINTMENTS
        ========================================================= --}}

        <a
            href="{{ route('dentist.appointments') }}"
            class="navigation-item {{ request()->routeIs('dentist.appointments*') ? 'active' : '' }}"
        >

            <span class="navigation-icon">

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    aria-hidden="true"
                >

                    <rect
                        x="4"
                        y="5"
                        width="16"
                        height="15"
                        rx="2"
                        stroke="currentColor"
                        stroke-width="1.8"
                    />

                    <path
                        d="M8 3V7M16 3V7"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                    />

                    <path
                        d="M4 10H20"
                        stroke="currentColor"
                        stroke-width="1.8"
                    />

                    <circle
                        cx="8"
                        cy="14"
                        r="1"
                        fill="currentColor"
                    />

                    <circle
                        cx="12"
                        cy="14"
                        r="1"
                        fill="currentColor"
                    />

                    <circle
                        cx="16"
                        cy="14"
                        r="1"
                        fill="currentColor"
                    />

                </svg>

            </span>

            <span>
                Appointments
            </span>

        </a>


        {{-- ========================================================
             PATIENT RECORDS
        ========================================================= --}}

        <a
            href="{{ route('dentist.patient-records') }}"
            class="navigation-item {{ request()->routeIs('dentist.patient-records') ? 'active' : '' }}"
        >

            <span class="navigation-icon">

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    aria-hidden="true"
                >

                    <circle
                        cx="9"
                        cy="8"
                        r="3"
                        stroke="currentColor"
                        stroke-width="1.8"
                    />

                    <path
                        d="M3 20C3 16.686 5.686 14 9 14C12.314 14 15 16.686 15 20"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                    />

                    <path
                        d="M16 11C18.2 11 20 9.2 20 7"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                    />

                    <path
                        d="M16 15C18.8 15 21 17.2 21 20"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                    />

                </svg>

            </span>

            <span>
                Patient Records
            </span>

        </a>


        {{-- ========================================================
             DENTAL CHART / ODONTOGRAM
        ========================================================= --}}

        <a
            href="{{ route('dentist.odontogram') }}"
            class="navigation-item {{ request()->routeIs('dentist.odontogram*') ? 'active' : '' }}"
        >

            <span class="navigation-icon">

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    aria-hidden="true"
                >

                    <path
                        d="M12 3C8 3 5 5.5 5 9C5 12 6.5 13.5 7 16.5C7.5 19.5 8.5 21 10 21C11.5 21 11.5 18 12 17C12.5 18 12.5 21 14 21C15.5 21 16.5 19.5 17 16.5C17.5 13.5 19 12 19 9C19 5.5 16 3 12 3Z"
                        stroke="currentColor"
                        stroke-width="1.7"
                        stroke-linejoin="round"
                    />

                </svg>

            </span>

            <span>
                Dental Chart
            </span>

        </a>


        {{-- ========================================================
             DIVIDER
        ========================================================= --}}

        <div class="navigation-divider"></div>


        {{-- ========================================================
             MANAGEMENT
        ========================================================= --}}

        <div class="navigation-section-title">
            MANAGEMENT
        </div>


        {{-- ========================================================
             TREATMENTS
        ========================================================= --}}

        <a
            href="{{ route('dentist.treatments') }}"
            class="navigation-item {{ request()->routeIs('dentist.treatments*') ? 'active' : '' }}"
        >

            <span class="navigation-icon">

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    aria-hidden="true"
                >

                    <circle
                        cx="12"
                        cy="12"
                        r="9"
                        stroke="currentColor"
                        stroke-width="1.8"
                    />

                    <path
                        d="M12 7V17"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                    />

                    <path
                        d="M7 12H17"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                    />

                </svg>

            </span>

            <span>
                Treatments
            </span>

        </a>


        {{-- ========================================================
             PROFILE
        ========================================================= --}}

        <div class="navigation-divider"></div>


        <div class="navigation-section-title">
            ACCOUNT
        </div>

      <a
    href="{{ route('dentist.settings') }}"
    class="navigation-item {{ request()->routeIs('dentist.settings*') ? 'active' : '' }}"
    id="settingsNavigationItem"
>
    <span class="navigation-icon">
        <svg
            xmlns="http://www.w3.org/2000/svg"
            width="20"
            height="20"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
        >
            <circle cx="12" cy="12" r="3"></circle>

            <path d="M12 2v2"></path>
            <path d="M12 20v2"></path>
            <path d="m4.93 4.93 1.41 1.41"></path>
            <path d="m17.66 17.66 1.41 1.41"></path>
            <path d="M2 12h2"></path>
            <path d="M20 12h2"></path>
            <path d="m6.34 17.66-1.41 1.41"></path>
            <path d="m19.07 4.93-1.41 1.41"></path>

            <circle cx="12" cy="12" r="7"></circle>
        </svg>
    </span>

    <span>
        Settings
    </span>
</a>

    </nav>


    <div class="sidebar-footer">

        <form
            method="POST"
            action="{{ route('logout') }}"
        >

            @csrf

            <button
                type="submit"
                class="logout-button"
            >

                <span class="navigation-icon">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        aria-hidden="true"
                    >

                        <path
                            d="M10 17L15 12L10 7"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />

                        <path
                            d="M15 12H3"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                        />

                        <path
                            d="M21 19V5C21 3.9 20.1 3 19 3H13"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                        />

                    </svg>

                </span>

                <span>
                    Logout
                </span>

            </button>

        </form>

    </div>

</aside>


    <main class="main-content">



        <header class="top-header">

            <div class="header-left">

                <button
                    type="button"
                    class="mobile-menu-button"
                    id="mobileMenuButton"
                    aria-label="Open menu"
                >

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M4 6H20M4 12H20M4 18H20"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                        />
                    </svg>

                </button>

                <div>

                    <h1 class="page-title">
                        Patient Records
                    </h1>

                    <p class="page-subtitle">
                        Manage and review patient dental records
                    </p>

                </div>

            </div>


            <div class="header-right">




                <button
                    type="button"
                    class="header-icon-button"
                    id="notificationButton"
                    aria-label="Notifications"
                >

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M18 8C18 4.68629 15.3137 2 12 2C8.68629 2 6 4.68629 6 8C6 15 3 15 3 17H21C21 15 18 15 18 8Z"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linejoin="round"
                        />

                        <path
                            d="M10 21H14"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                        />
                    </svg>

                    <span class="notification-badge">
                        0
                    </span>

                </button>




                <div class="header-profile">

                    <div class="header-profile-avatar">

                        @if(auth()->user()->profile_picture)

                            <img
                                src="{{ asset('storage/' . auth()->user()->profile_picture) }}"
                                alt="{{ auth()->user()->name }}"
                            >

                        @else

                            <span>
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </span>

                        @endif

                    </div>

                    <div class="header-profile-info">

                        <strong>
                            Dr. {{ auth()->user()->name }}
                        </strong>

                        <span>
                            Dentist
                        </span>

                    </div>

                </div>

            </div>

        </header>


        <section class="page-content">


            <div class="page-heading">

                <div>

                    <div class="breadcrumb">

                        <span>
                            Dentist
                        </span>

                        <span>/</span>

                        <span>
                            Settings
                        </span>

                    </div>


                    <h1>
                        Settings
                    </h1>


                    <p>
                        Manage your account, security, and preferences.
                    </p>

                </div>

            </div>

            <div class="settings-layout">

                <aside class="settings-menu">

                    <button
                        type="button"
                        class="settings-menu-item active"
                        data-section="profile"
                    >

                        <span class="settings-menu-icon">

                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <circle
                                    cx="12"
                                    cy="8"
                                    r="4"
                                />

                                <path
                                    d="M4 21c0-4 3.5-7 8-7s8 3 8 7"
                                />
                            </svg>

                        </span>

                        <span>
                            Profile
                        </span>

                    </button>


                    <button
                        type="button"
                        class="settings-menu-item"
                        data-section="security"
                    >

                        <span class="settings-menu-icon">

                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <rect
                                    x="4"
                                    y="10"
                                    width="16"
                                    height="11"
                                    rx="2"
                                />

                                <path
                                    d="M8 10V7a4 4 0 0 1 8 0v3"
                                />

                            </svg>

                        </span>

                        <span>
                            Security
                        </span>

                    </button>


                    <button
                        type="button"
                        class="settings-menu-item"
                        data-section="notifications"
                    >

                        <span class="settings-menu-icon">

                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <path
                                    d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9"
                                />

                                <path d="M10 21h4"/>

                            </svg>

                        </span>

                        <span>
                            Notifications
                        </span>

                    </button>


                </aside>


                <div class="settings-content">


                    {{-- PROFILE --}}

<section
    class="settings-section active"
    id="profileSection"
>

    <div class="section-header">
        <div>
            <h2>
                Profile Settings
            </h2>

            <p>
                Manage your profile photo and contact information.
            </p>
        </div>
    </div>

    <form
        id="profileForm"
        enctype="multipart/form-data"
    >

<div class="profile-image-section">

    <div class="profile-image-wrapper">

        @if(!empty($user->profile_photo))

            <img
                src="{{ asset('storage/' . $user->profile_photo) }}"
                alt="Profile Photo"
                class="profile-image"
                id="profileImagePreview"
            >

        @else

            <div
                class="profile-image-placeholder"
                id="profileImagePlaceholder"
            >
                {{ strtoupper(substr($user->name ?? 'D', 0, 1)) }}
            </div>

        @endif

    </div>

    <div class="profile-image-info">

        <h3>Profile Image</h3>

        <p>
            Upload a profile picture for your dentist account.
        </p>

        <input
            type="file"
            id="profilePhoto"
            name="profile_photo"
            class="profile-image-input"
            accept=".jpg,.jpeg,.png,.webp"
        >

        <small class="profile-image-hint">
            JPG, PNG or WEBP. Maximum 2 MB.
        </small>

    </div>

</div>


        <div class="form-grid">

            <div class="form-group">

                <label>
                    Full Name
                </label>

                <div class="readonly-input">

                    <input
                        type="text"
                        id="profileName"
                        name="name"
                        value="{{ $user->name ?? '' }}"
                        readonly
                    >

                    <span class="lock-icon">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
                            <rect
                                x="5"
                                y="10"
                                width="14"
                                height="10"
                                rx="2"
                            />

                            <path
                                d="M8 10V7a4 4 0 0 1 8 0v3"
                            />
                        </svg>

                    </span>

                </div>

                <small class="field-note">
                    Your name is managed by the administrator.
                </small>

            </div>

            <div class="form-group">

                <label>
                    Email Address
                </label>

                <div class="readonly-input">

                    <input
                        type="email"
                        id="profileEmail"
                        name="email"
                        value="{{ $user->email ?? '' }}"
                        readonly
                    >

                    <span class="lock-icon">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
                            <rect
                                x="5"
                                y="10"
                                width="14"
                                height="10"
                                rx="2"
                            />

                            <path
                                d="M8 10V7a4 4 0 0 1 8 0v3"
                            />
                        </svg>

                    </span>

                </div>

                <small class="field-note">
                    Your email is managed by the administrator.
                </small>

            </div>

            <div class="form-group">

                <label>
                    Phone Number
                </label>

                <input
                    type="text"
                    id="profilePhone"
                    name="phone"
                    value="{{ $user->phone ?? '' }}"
                    placeholder="09XXXXXXXXX"
                >

            </div>

            <div class="form-group">

                <label>
                    Role
                </label>

                <input
                    type="text"
                    value="Dentist"
                    disabled
                >

            </div>

        </div>

        <div class="form-actions">

            <button
                type="submit"
                class="primary-button"
                id="saveProfileButton"
            >
                Save Changes
            </button>

        </div>

    </form>

</section>

                    {{-- SECURITY --}}

                  <section
    class="settings-section"
    id="securitySection"
>

    {{-- ============================================================
         SECURITY HEADER
    ============================================================ --}}

    <div class="section-header">

        <div>

            <h2>
                Security
            </h2>

            <p>
                Change your password and secure your account.
            </p>

        </div>

    </div>


    {{-- ============================================================
         CHANGE PASSWORD
    ============================================================ --}}

    <div class="security-card">

        <div class="security-card-header">

            <div>

                <h3>
                    Change Password
                </h3>

                <p>
                    Use a strong password to protect your dentist account.
                </p>

            </div>

        </div>


        <form
            id="passwordForm"
        >

            {{-- ====================================================
                 CURRENT PASSWORD
            ===================================================== --}}

            <div class="form-group">

                <label for="currentPassword">
                    Current Password
                </label>

                <div class="password-input">

                    <input
                        type="password"
                        id="currentPassword"
                        name="current_password"
                        autocomplete="current-password"
                        required
                    >

                    <button
                        type="button"
                        class="password-toggle"
                        data-target="currentPassword"
                        aria-label="Show current password"
                    >
                        Show
                    </button>

                </div>

            </div>


            {{-- ====================================================
                 NEW PASSWORD
            ===================================================== --}}

            <div class="form-group">

                <label for="newPassword">
                    New Password
                </label>

                <div class="password-input">

                    <input
                        type="password"
                        id="newPassword"
                        name="password"
                        autocomplete="new-password"
                        required
                    >

                    <button
                        type="button"
                        class="password-toggle"
                        data-target="newPassword"
                        aria-label="Show new password"
                    >
                        Show
                    </button>

                </div>


                {{-- Password Strength --}}

                <div
                    class="password-strength"
                    id="passwordStrength"
                >

                    <div class="password-strength-bar">

                        <span
                            id="passwordStrengthBar"
                        ></span>

                    </div>

                    <span
                        id="passwordStrengthText"
                    >
                        Enter a password
                    </span>

                </div>

            </div>


            {{-- ====================================================
                 CONFIRM PASSWORD
            ===================================================== --}}

            <div class="form-group">

                <label for="confirmPassword">
                    Confirm New Password
                </label>

                <div class="password-input">

                    <input
                        type="password"
                        id="confirmPassword"
                        name="password_confirmation"
                        autocomplete="new-password"
                        required
                    >

                    <button
                        type="button"
                        class="password-toggle"
                        data-target="confirmPassword"
                        aria-label="Show password confirmation"
                    >
                        Show
                    </button>

                </div>

                <small
                    id="passwordMatchMessage"
                    class="password-match-message"
                ></small>

            </div>


            {{-- ====================================================
                 PASSWORD REQUIREMENTS
            ===================================================== --}}

            <div class="password-requirements">

                <strong>
                    Password requirements
                </strong>

                <ul>

                    <li id="requirementLength">
                        <span class="requirement-icon">○</span>
                        At least 8 characters
                    </li>

                    <li id="requirementLetter">
                        <span class="requirement-icon">○</span>
                        At least one letter
                    </li>

                    <li id="requirementNumber">
                        <span class="requirement-icon">○</span>
                        At least one number
                    </li>

                    <li id="requirementSpecial">
                        <span class="requirement-icon">○</span>
                        At least one special character
                    </li>

                    <li id="requirementMatch">
                        <span class="requirement-icon">○</span>
                        Passwords match
                    </li>

                </ul>

            </div>


            {{-- ====================================================
                 PASSWORD ACTION
            ===================================================== --}}

            <div class="form-actions">

                <button
                    type="submit"
                    class="primary-button"
                    id="changePasswordButton"
                >
                    Change Password
                </button>

            </div>

        </form>

    </div>


    {{-- ============================================================
         TWO-FACTOR AUTHENTICATION
    ============================================================ --}}

    <div class="security-card two-factor-card">

        <div class="security-card-header">

            <div>

                <h3>
                    Two-Factor Authentication
                </h3>

                <p>
                    Add an extra layer of security to your dentist account.
                </p>

            </div>


            {{-- 2FA STATUS --}}

            <div
                class="two-factor-status"
                id="twoFactorStatus"
            >

                @if(auth()->user()->two_factor_enabled)

                    <span class="status-dot enabled"></span>

                    <span>
                        Enabled
                    </span>

                @else

                    <span class="status-dot disabled"></span>

                    <span>
                        Disabled
                    </span>

                @endif

            </div>

        </div>


        {{-- ========================================================
             ENABLED STATE
        ========================================================= --}}

        @if(auth()->user()->two_factor_enabled)

            <div
                class="two-factor-enabled"
                id="twoFactorEnabled"
            >

                <div class="two-factor-icon">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >

                        <path
                            d="M12 3L19 6V11C19 16 16 19 12 21C8 19 5 16 5 11V6L12 3Z"
                            stroke-linejoin="round"
                        />

                        <path
                            d="M9 12L11 14L15 10"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />

                    </svg>

                </div>


                <div class="two-factor-info">

                    <strong>
                        Your account is protected
                    </strong>

                    <p>
                        Two-factor authentication is currently enabled.
                    </p>

                </div>


                <button
                    type="button"
                    class="danger-button"
                    id="disableTwoFactorButton"
                >
                    Disable 2FA
                </button>

            </div>

        @else

            {{-- ====================================================
                 DISABLED STATE
            ===================================================== --}}

            <div
                class="two-factor-disabled"
                id="twoFactorDisabled"
            >

                <div class="two-factor-icon">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >

                        <path
                            d="M12 3L19 6V11C19 16 16 19 12 21C8 19 5 16 5 11V6L12 3Z"
                            stroke-linejoin="round"
                        />

                        <path
                            d="M12 8V13"
                            stroke-linecap="round"
                        />

                        <circle
                            cx="12"
                            cy="16"
                            r=".7"
                            fill="currentColor"
                        />

                    </svg>

                </div>


                <div class="two-factor-info">

                    <strong>
                        Protect your account with 2FA
                    </strong>

                    <p>
                        Use an authenticator app to generate a security code
                        when signing in.
                    </p>

                </div>


                <button
                    type="button"
                    class="primary-button"
                    id="enableTwoFactorButton"
                >
                    Enable 2FA
                </button>

            </div>

        @endif


        {{-- ========================================================
             2FA SETUP PANEL
        ========================================================= --}}

        <div
            class="two-factor-setup"
            id="twoFactorSetup"
            style="display: none;"
        >

            <div class="setup-header">

                <h4>
                    Set up two-factor authentication
                </h4>

                <p>
                    Scan the QR code using Google Authenticator,
                    Microsoft Authenticator, or another compatible
                    authenticator app.
                </p>

            </div>


            {{-- QR CODE --}}

            <div
                class="two-factor-qr"
                id="twoFactorQr"
            >
                {{-- QR code will be inserted here --}}
            </div>


            {{-- SECRET --}}

            <div class="two-factor-secret">

                <span>
                    Can't scan the QR code?
                </span>

                <code id="twoFactorSecret">
                    Loading...
                </code>

            </div>


            {{-- VERIFICATION CODE --}}

            <div class="form-group">

                <label for="twoFactorCode">
                    Verification Code
                </label>

                <input
                    type="text"
                    id="twoFactorCode"
                    name="code"
                    inputmode="numeric"
                    maxlength="6"
                    autocomplete="one-time-code"
                    placeholder="Enter 6-digit code"
                >

                <small>
                    Enter the code generated by your authenticator app.
                </small>

            </div>


            {{-- ACTIONS --}}

            <div class="form-actions">

                <button
                    type="button"
                    class="secondary-button"
                    id="cancelTwoFactorButton"
                >
                    Cancel
                </button>

                <button
                    type="button"
                    class="primary-button"
                    id="verifyTwoFactorButton"
                >
                    Verify & Enable 2FA
                </button>

            </div>

        </div>

    </div>

</section>
<!--NOTIFICATION-->
<section
    class="settings-section"
    id="notificationsSection"
>


    <div class="section-header">

        <div>

            <h2>
                Notifications
            </h2>

            <p>
                Choose which notifications you want to receive.
            </p>

        </div>

    </div>


    @if(session('success'))

        <div class="settings-success-message">

            {{ session('success') }}

        </div>

    @endif


    <form
        method="POST"
        action="{{ route('dentist.settings.preferences.update') }}"
        id="notificationForm"
    >

        @csrf

        <div class="setting-option">

            <div>

                <strong>
                    Appointment Notifications
                </strong>

                <p>
                    Receive notifications about appointments.
                </p>

            </div>


            <label class="switch">

                {{-- Send 0 when unchecked --}}
                <input
                    type="hidden"
                    name="appointment_notifications"
                    value="0"
                >

                <input
                    type="checkbox"
                    id="appointmentNotifications"
                    name="appointment_notifications"
                    value="1"

                    {{ ($settings->appointment_notifications ?? true)
                        ? 'checked'
                        : ''
                    }}
                >

                <span></span>

            </label>

        </div>

        <div class="setting-option">

            <div>

                <strong>
                    Treatment Notifications
                </strong>

                <p>
                    Receive notifications about treatment updates.
                </p>

            </div>


            <label class="switch">

                {{-- Send 0 when unchecked --}}
                <input
                    type="hidden"
                    name="treatment_notifications"
                    value="0"
                >

                <input
                    type="checkbox"
                    id="treatmentNotifications"
                    name="treatment_notifications"
                    value="1"

                    {{ ($settings->treatment_notifications ?? true)
                        ? 'checked'
                        : ''
                    }}
                >

                <span></span>

            </label>

        </div>

        <div class="setting-option">

            <div>

                <strong>
                    System Notifications
                </strong>

                <p>
                    Receive important system notifications.
                </p>

            </div>


            <label class="switch">

                {{-- Send 0 when unchecked --}}
                <input
                    type="hidden"
                    name="system_notifications"
                    value="0"
                >

                <input
                    type="checkbox"
                    id="systemNotifications"
                    name="system_notifications"
                    value="1"

                    {{ ($settings->system_notifications ?? true)
                        ? 'checked'
                        : ''
                    }}
                >

                <span></span>

            </label>

        </div>


        <div class="form-actions">

            <button
                type="submit"
                class="primary-button"
                id="saveNotificationButton"
            >
                Save Preferences
            </button>

        </div>

    </form>

</section>

    </main>

</div>


{{-- =====================================================
     TOAST
====================================================== --}}

<div
    class="toast-container"
    id="toastContainer"
></div>


<script>
window.DENTIST_SETTINGS = {

    profileUrl:
        @json(route('dentist.settings.profile.update')),

    passwordUrl:
        @json(route('dentist.settings.password.update')),

    preferencesUrl:
        @json(route('dentist.settings.preferences.update')),

    appearanceUrl:
        @json(route('dentist.settings.appearance.update')),

    twoFactorSetupUrl:
        @json(route('dentist.settings.2fa.setup')),

    twoFactorVerifyUrl:
        @json(route('dentist.settings.2fa.verify')),

    twoFactorDisableUrl:
        @json(route('dentist.settings.2fa.disable')),

    csrf:
        @json(csrf_token())
};
</script>

<script src="{{ asset('js/dentist-settings.js') }}"></script>

<script src="{{ asset('js/dentist-settings-2fa.js') }}"></script>


</body>

</html>
