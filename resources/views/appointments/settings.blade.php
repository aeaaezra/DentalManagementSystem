<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Account Settings | Dental Portal</title>

    <link rel="stylesheet" href="{{ asset('css/appointment/appointment-settings.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <link rel="stylesheet"href="{{ asset('css/appointment/patient-theme.css') }}">

    <script src="{{ asset('js/patient-theme.js') }}"></script>

</head>

<body>

    {{-- MOBILE SETTINGS HEADER --}}
    <header class="mobile-settings-header">

        <button
            type="button"
            id="settingsHeaderMenuBtn"
            aria-label="Open Settings menu"
            aria-expanded="false"
            aria-controls="settingsMobileSidebar"
        >
            <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <line x1="4" y1="6" x2="20" y2="6"></line>
                <line x1="4" y1="12" x2="20" y2="12"></line>
                <line x1="4" y1="18" x2="20" y2="18"></line>
            </svg>
        </button>

        <div class="mobile-settings-title">
            Settings
        </div>

        <button
            type="button"
            class="mobile-settings-back"
            onclick="window.history.back();"
        >
            Back
        </button>

    </header>



<aside class="sidebar">

    <h3>⚙ Settings</h3>

    <nav>

        <a href="#profile" class="sidebar-link">

            <svg xmlns="http://www.w3.org/2000/svg"
                 width="20"
                 height="20"
                 viewBox="0 0 24 24"
                 fill="none"
                 stroke="currentColor"
                 stroke-width="2"
                 stroke-linecap="round"
                 stroke-linejoin="round">

                <path d="M20 21a8 8 0 0 0-16 0"></path>
                <circle cx="12" cy="7" r="4"></circle>

            </svg>

            <span>Profile</span>

        </a>


        {{-- SECURITY --}}
        <a href="#security" class="sidebar-link">

            <svg xmlns="http://www.w3.org/2000/svg"
                 width="20"
                 height="20"
                 viewBox="0 0 24 24"
                 fill="none"
                 stroke="currentColor"
                 stroke-width="2"
                 stroke-linecap="round"
                 stroke-linejoin="round">

                <rect x="3" y="11" width="18" height="10" rx="2"></rect>
                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>

            </svg>

            <span>Security</span>

        </a>


        {{-- NOTIFICATIONS --}}
        <a href="#notifications" class="sidebar-link">

            <svg xmlns="http://www.w3.org/2000/svg"
                 width="20"
                 height="20"
                 viewBox="0 0 24 24"
                 fill="none"
                 stroke="currentColor"
                 stroke-width="2"
                 stroke-linecap="round"
                 stroke-linejoin="round">

                <path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V4a2 2 0 10-4 0v1.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5"></path>
                <path d="M9 17a3 3 0 006 0"></path>

            </svg>

            <span>Notifications</span>

        </a>


        {{-- APPEARANCE --}}
        <a href="#appearance" class="sidebar-link">

            <svg xmlns="http://www.w3.org/2000/svg"
                 width="20"
                 height="20"
                 viewBox="0 0 24 24"
                 fill="none"
                 stroke="currentColor"
                 stroke-width="2"
                 stroke-linecap="round"
                 stroke-linejoin="round">

                <path d="M12 2a10 10 0 1 0 0 20c1.1 0 2-.9 2-2 0-.6-.3-1.2-.8-1.6-.5-.4-.8-.9-.8-1.4 0-1.1.9-2 2-2h2a5 5 0 0 0 5-5A10 10 0 0 0 12 2z"></path>

                <circle cx="7.5" cy="10.5" r="1"></circle>
                <circle cx="12" cy="7.5" r="1"></circle>
                <circle cx="16.5" cy="10.5" r="1"></circle>
                <circle cx="9.5" cy="15" r="1"></circle>

            </svg>

            <span>Appearance</span>

        </a>


        {{-- PREFERENCES --}}
        <a href="#preferences" class="sidebar-link">

            <svg xmlns="http://www.w3.org/2000/svg"
                 width="20"
                 height="20"
                 viewBox="0 0 24 24"
                 fill="none"
                 stroke="currentColor"
                 stroke-width="2"
                 stroke-linecap="round"
                 stroke-linejoin="round">

                <line x1="4" y1="21" x2="4" y2="14"></line>
                <line x1="4" y1="10" x2="4" y2="3"></line>

                <line x1="12" y1="21" x2="12" y2="12"></line>
                <line x1="12" y1="8" x2="12" y2="3"></line>

                <line x1="20" y1="21" x2="20" y2="16"></line>
                <line x1="20" y1="12" x2="20" y2="3"></line>

                <circle cx="4" cy="12" r="2"></circle>
                <circle cx="12" cy="10" r="2"></circle>
                <circle cx="20" cy="14" r="2"></circle>

            </svg>

            <span>Preferences</span>

        </a>



        <a href="#privacy" class="sidebar-link">

            <svg xmlns="http://www.w3.org/2000/svg"
                 width="20"
                 height="20"
                 viewBox="0 0 24 24"
                 fill="none"
                 stroke="currentColor"
                 stroke-width="2"
                 stroke-linecap="round"
                 stroke-linejoin="round">

                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                <path d="M9 12l2 2 4-4"></path>

            </svg>

            <span>Privacy</span>

        </a>



<button
    type="button"
    class="settings-report-card"
    onclick="openReportIssueModal()"
>
    <div class="report-card-left">

        <div class="report-card-icon">
            <svg
                width="21"
                height="21"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
            >
                <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0Z"/>
                <line x1="12" y1="9" x2="12" y2="13"/>
                <line x1="12" y1="17" x2="12.01" y2="17"/>
            </svg>
        </div>

        <div class="report-card-content">
            <span class="report-card-title">
                Report a Problem
            </span>

            <span class="report-card-description">
                Tell us about an issue you encountered
            </span>
        </div>

    </div>

    <div class="report-card-arrow">
        <svg
            width="18"
            height="18"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
        >
            <polyline points="9 18 15 12 9 6"/>
        </svg>
    </div>
</button>

    </nav>

</aside>

<div
    id="settingsMobileSidebarOverlay"
    aria-hidden="true"
></div>

<aside
    id="settingsMobileSidebar"
    aria-hidden="true"
>
    <nav class="settings-mobile-nav">


        <a href="#profile" class="settings-mobile-link">
            <span>Profile</span>
        </a>

        <a href="#security" class="settings-mobile-link">
            <span>Security</span>
        </a>

        <a href="#notifications" class="settings-mobile-link">
            <span>Notifications</span>
        </a>

        <a href="#appearance" class="settings-mobile-link">
            <span>Appearance</span>
        </a>

        <a href="#preferences" class="settings-mobile-link">
            <span>Preferences</span>
        </a>

        <a href="#privacy" class="settings-mobile-link">
            <span>Privacy</span>
        </a>

        <button
            type="button"
            class="settings-mobile-link settings-mobile-report"
            onclick="openReportIssueModal(); closeSettingsMobileSidebar();"
        >
            <span>Report a Problem</span>
        </button>

    </nav>
</aside>

<main class="main">

    <div class="back-bar">

        <a href="{{ session('settings_return_url', route('appointments.homepage')) }}"
           class="back-btn">

            <svg xmlns="http://www.w3.org/2000/svg"
                 width="20"
                 height="20"
                 viewBox="0 0 24 24"
                 fill="none"
                 stroke="currentColor"
                 stroke-width="2.5"
                 stroke-linecap="round"
                 stroke-linejoin="round">

                <polyline points="15 18 9 12 15 6"></polyline>

            </svg>

            <span>Back</span>

        </a>

    </div>

    <section id="profile" class="card">

        <h2>Profile</h2>

        <form
            action="{{ route('appointments.settings.profile') }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf
            @method('PUT')


            <div class="profile-section">

                <img
                    id="preview"
                    class="profile-img"
                    src="{{ $user->profile_picture
                        ? asset('storage/' . $user->profile_picture)
                        : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=FCE7F3&color=E91E63' }}"
                    alt="Profile Picture"
                >

                <input
                    type="file"
                    name="profile_picture"
                    id="profile_picture"
                    accept="image/*"
                    onchange="previewImage(event)"
                >

            </div>


            <div class="form-group">

                <label for="name">
                    Full Name
                </label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ $user->name }}"
                    placeholder="Full Name"
                    readonly
                    class="readonly-input"
                >

            </div>


            <div class="form-group">

                <label for="email">
                    Email Address
                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ $user->email }}"
                    placeholder="Email Address"
                    readonly
                    class="readonly-input"
                >

            </div>


            <div class="form-actions">

                <button
                    type="submit"
                    class="save-btn"
                >

                    <span>
                        Save Changes
                    </span>

                    <span class="icon">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="20"
                            height="20"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >

                            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>

                            <polyline points="17 21 17 13 7 13 7 21"></polyline>

                            <polyline points="7 3 7 8 15 8"></polyline>

                        </svg>

                    </span>

                </button>

            </div>

        </form>

    </section>

    <section id="security" class="card">

        <div class="security-header">

            <div>

                <h2>Security</h2>

                <p>
                    Manage your password and account security settings.
                </p>

            </div>

        </div>


        @if(session('success'))

            <div class="success-message">

                <span>✓</span>

                {{ session('success') }}

            </div>

        @endif


        @if(session('error'))

            <div class="error-message">

                <span>✕</span>

                {{ session('error') }}

            </div>

        @endif



        <div class="security-section">

            <div class="section-title">

                <div class="section-icon">
                    🔒
                </div>

                <div>

                    <h3>Change Password</h3>

                    <p>
                        Use a strong password to keep your account secure.
                    </p>

                </div>

            </div>


            <form
                id="passwordForm"
                action="{{ route('settings.password.update') }}"
                method="POST"
            >

                @csrf

                <div class="form-group">

                    <label for="currPass">
                        Current Password
                    </label>

                    <div class="password-wrapper">

                        <input
                            type="password"
                            id="currPass"
                            name="current_password"
                            placeholder="Enter your current password"
                            autocomplete="current-password"
                            required
                        >

                        <button
                            type="button"
                            class="eye-icon"
                            onclick="togglePass('currPass', this)"
                            aria-label="Show password"
                        >

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

                                <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12z"></path>
                                <circle cx="12" cy="12" r="3"></circle>

                            </svg>

                        </button>

                    </div>

                    @error('current_password')

                        <small class="error-message">
                            {{ $message }}
                        </small>

                    @enderror

                    <small
                        id="currentPasswordError"
                        class="field-message"
                    ></small>

                </div>

                <div class="form-group">

                    <label for="newPass">
                        New Password
                    </label>

                    <div class="password-wrapper">

                        <input
                            type="password"
                            id="newPass"
                            name="password"
                            placeholder="Create a strong new password"
                            autocomplete="new-password"
                            required
                        >

                        <button
                            type="button"
                            class="eye-icon"
                            onclick="togglePass('newPass', this)"
                            aria-label="Show password"
                        >

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

                                <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12z"></path>
                                <circle cx="12" cy="12" r="3"></circle>

                            </svg>

                        </button>

                    </div>

                    @error('password')

                        <small class="error-message">
                            {{ $message }}
                        </small>

                    @enderror

                </div>


                <div
                    id="passwordChecker"
                    class="password-checker hidden"
                >

                    <div class="password-strength">

                        <span>Password Strength:</span>

                        <strong id="strengthText">
                            Weak
                        </strong>

                    </div>


                    <ul class="password-checklist">

                        <li id="length">
                            • At least 8 characters
                        </li>

                        <li id="uppercase">
                            • One uppercase letter
                        </li>

                        <li id="lowercase">
                            • One lowercase letter
                        </li>

                        <li id="number">
                            • One number
                        </li>

                        <li id="special">
                            • One special character
                        </li>

                    </ul>

                </div>

                <div class="form-group">

                    <label for="confPass">
                        Confirm New Password
                    </label>

                    <div class="password-wrapper">

                        <input
                            type="password"
                            id="confPass"
                            name="password_confirmation"
                            placeholder="Confirm your new password"
                            autocomplete="new-password"
                            required
                        >

                        <button
                            type="button"
                            class="eye-icon"
                            onclick="togglePass('confPass', this)"
                            aria-label="Show password"
                        >

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

                                <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12z"></path>
                                <circle cx="12" cy="12" r="3"></circle>

                            </svg>

                        </button>

                    </div>


                    @error('password_confirmation')

                        <small class="error-message">
                            {{ $message }}
                        </small>

                    @enderror


                    <small
                        id="confirmError"
                        class="confirm-error"
                    ></small>

                </div>

                <div class="button-group">

                    <button
                        type="submit"
                        class="btn btn-primary change-password-btn"
                    >

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="19"
                            height="19"
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

                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>

                        </svg>

                        <span>
                            Change Password
                        </span>

                    </button>

                </div>

            </form>

        </div>


        <div class="security-section two-factor-section">

            <div class="section-title">

                <div class="section-icon security-shield">
                    🛡
                </div>

                <div>

                    <h3>
                        Two-Factor Authentication
                    </h3>

                    <p>
                        Add an extra layer of protection to your account.
                    </p>

                </div>

            </div>


            <div class="two-factor-actions">

                @if((bool) auth()->user()->two_factor_enabled)

                    <div class="two-factor-status enabled">

                        <div class="status-indicator">
                            ✓
                        </div>

                        <div>

                            <strong>
                                Two-Factor Authentication Enabled
                            </strong>

                            <span>
                                Your account has additional security protection.
                            </span>

                        </div>

                    </div>


                    <form
                        id="disable2faForm"
                        action="{{ route('2fa.disable') }}"
                        method="POST"
                    >

                        @csrf

                        <button
                            type="submit"
                            class="btn btn-danger disable-2fa-btn"
                        >

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="19"
                                height="19"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            >

                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>

                                <line x1="9" y1="9" x2="15" y2="15"></line>
                                <line x1="15" y1="9" x2="9" y2="15"></line>

                            </svg>

                            <span>
                                Disable Two-Factor Auth
                            </span>

                        </button>

                    </form>

                @else

                    <div class="two-factor-status disabled-status">

                        <div class="status-indicator">
                            !
                        </div>

                        <div>

                            <strong>
                                Two-Factor Authentication Disabled
                            </strong>

                            <span>
                                Enable it to better protect your account.
                            </span>

                        </div>

                    </div>


                    <a
                        href="{{ route('settings.2fa') }}"
                        class="btn btn-primary enable-2fa-btn"
                    >

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="19"
                            height="19"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >

                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                            <path d="M9 12l2 2 4-4"></path>

                        </svg>

                        <span>
                            Enable Two-Factor Auth
                        </span>

                    </a>

                @endif

            </div>

        </div>

    </section>


    <section id="notifications" class="card">

        <h2>Notifications</h2>

        <form
            action="{{ route('appointments.settings.notifications') }}"
            method="POST"
        >

            @csrf
            @method('PUT')


            <div class="setting-row">

                <div>

                    <span>
                        Appointment Reminders
                    </span>

                    <p>
                        Receive reminders about your appointments.
                    </p>

                </div>


                <label class="switch">

                    <input
                        type="checkbox"
                        name="appointment_reminders"
                        value="1"
                        {{ $user->appointment_reminders ? 'checked' : '' }}
                    >

                    <span class="slider"></span>

                </label>

            </div>


            <div class="setting-row">

                <div>

                    <span>
                        Promotional Emails
                    </span>

                    <p>
                        Receive promotions and special offers.
                    </p>

                </div>


                <label class="switch">

                    <input
                        type="checkbox"
                        name="promotional_emails"
                        value="1"
                        {{ $user->promotional_emails ? 'checked' : '' }}
                    >

                    <span class="slider"></span>

                </label>

            </div>


            <div class="notification-save">

                <button
                    type="submit"
                    class="save-btn"
                >
                    Save Notification Settings
                </button>

            </div>

        </form>

    </section>


    <section id="appearance" class="card">

        <h2>Appearance</h2>

        <div class="appearance-setting">

            <div class="appearance-info">

                <div class="appearance-icon">
    <svg xmlns="http://www.w3.org/2000/svg"
         width="22"
         height="22"
         viewBox="0 0 24 24"
         fill="none"
         stroke="currentColor"
         stroke-width="2"
         stroke-linecap="round"
         stroke-linejoin="round">

        <path d="M21 12.79A9 9 0 1 1 11.21 3
                 7 7 0 0 0 21 12.79z"></path>

    </svg>
</div>

                <div>

                    <h3>
                        Dark Mode
                    </h3>

                    <p>
                        Switch between light and dark appearance.
                    </p>

                </div>

            </div>


            <label class="theme-switch">

                <input
                    type="checkbox"
                    id="darkModeToggle"
                    aria-label="Toggle dark mode"
                >

                <span class="theme-slider">

                    <span class="theme-slider-icon sun">

    <svg xmlns="http://www.w3.org/2000/svg"
         width="15"
         height="15"
         viewBox="0 0 24 24"
         fill="none"
         stroke="currentColor"
         stroke-width="2"
         stroke-linecap="round"
         stroke-linejoin="round">

        <circle cx="12" cy="12" r="4"></circle>

        <path d="M12 2v2"></path>
        <path d="M12 20v2"></path>
        <path d="m4.93 4.93 1.41 1.41"></path>
        <path d="m17.66 17.66 1.41 1.41"></path>
        <path d="M2 12h2"></path>
        <path d="M20 12h2"></path>
        <path d="m6.34 17.66-1.41 1.41"></path>
        <path d="m19.07 4.93-1.41 1.41"></path>

    </svg>

</span>


<span class="theme-slider-icon moon">

    <svg xmlns="http://www.w3.org/2000/svg"
         width="15"
         height="15"
         viewBox="0 0 24 24"
         fill="none"
         stroke="currentColor"
         stroke-width="2"
         stroke-linecap="round"
         stroke-linejoin="round">

        <path d="M21 12.79A9 9 0 1 1 11.21 3
                 7 7 0 0 0 21 12.79z"></path>

    </svg>

</span>



                </span>

            </label>

        </div>

    </section>


    <section id="preferences" class="card">

        <h2>
            Appointment Preferences
        </h2>

        <select>
            <option>Dr. Maria Santos</option>
            <option>Dr. John Doe</option>
        </select>

        <select>
            <option>1 day before</option>
            <option>3 days before</option>
        </select>

    </section>


    <section id="privacy" class="card">

        <h2>
            Privacy
        </h2>


        <div class="privacy-actions">

            <button
                type="button"
                class="btn btn-outline"
                id="downloadDataBtn"
            >
                Download Data
            </button>


            <form
                method="POST"
                action="{{ route('logout') }}"
                style="display: inline;"
            >

                @csrf

                <button
                    type="submit"
                    class="btn btn-danger"
                    onclick="return confirmLogout();"
                >
                    Logout
                </button>

            </form>

        </div>

    </section>

</main>

<div
    id="reportIssueModal"
    class="report-modal-overlay"
    aria-hidden="true"
>
    <div
        class="report-modal"
        role="dialog"
        aria-modal="true"
        aria-labelledby="reportIssueTitle"
    >


        <div class="report-modal-header">

            <div class="report-modal-title-wrapper">

                <div class="report-modal-icon">
                    <svg
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >
                        <path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0Z"/>
                        <line x1="12" y1="9" x2="12" y2="13"/>
                        <line x1="12" y1="17" x2="12.01" y2="17"/>
                    </svg>
                </div>

                <div class="report-modal-title">
                    <h2 id="reportIssueTitle">
                        Report an Issue
                    </h2>

                    <p>
                        Tell us what went wrong.
                    </p>
                </div>

            </div>

            <button
                type="button"
                class="report-modal-close"
                onclick="closeReportIssueModal()"
                aria-label="Close"
            >
                ✕
            </button>

        </div>



        <form
            id="reportIssueForm"
            action="{{ route('appointments.issue.store') }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf


            <div class="report-form-group">

                <label
                    for="modal_issue_type"
                    class="report-form-label"
                >
                    Issue Type
                    <span class="report-required">*</span>
                </label>

                <select
                    id="modal_issue_type"
                    name="issue_type"
                    class="report-form-control"
                    required
                >

                    <option value="">
                        Select an issue type
                    </option>

                    <option value="Appointment Problem">
                        Appointment Problem
                    </option>

                    <option value="Login Problem">
                        Login Problem
                    </option>

                    <option value="Notification Problem">
                        Notification Problem
                    </option>

                    <option value="Payment Problem">
                        Payment Problem
                    </option>

                    <option value="Other">
                        Other
                    </option>

                </select>

            </div>



            <div class="report-form-group">

                <label
                    for="modal_description"
                    class="report-form-label"
                >
                    What happened?
                    <span class="report-required">*</span>
                </label>

                <textarea
                    id="modal_description"
                    name="description"
                    class="report-form-control report-description"
                    placeholder="Please describe what went wrong..."
                    required
                ></textarea>

                <div class="report-help">
                    Please provide as much detail as possible.
                </div>

            </div>


            <div class="report-form-group">

                <label
                    for="modal_screenshot"
                    class="report-form-label"
                >
                    Screenshot
                </label>

                <input
                    type="file"
                    id="modal_screenshot"
                    name="screenshot"
                    class="report-form-control report-file"
                    accept=".jpg,.jpeg,.png,.webp"
                >

                <div class="report-help">
                    Optional. JPG, JPEG, PNG, or WEBP. Maximum 5 MB.
                </div>

            </div>



            <div class="report-modal-actions">

                <button
                    type="button"
                    class="report-btn report-btn-cancel"
                    onclick="closeReportIssueModal()"
                >
                    Cancel
                </button>

                <button
                    type="button"
                    class="report-btn report-btn-submit"
                    onclick="openReportConfirmModal()"
                >
                    Submit Report
                </button>

            </div>

        </form>

    </div>
</div>



<div
    id="reportConfirmModal"
    class="report-modal-overlay"
    aria-hidden="true"
>
    <div
        class="report-confirm-modal"
        role="dialog"
        aria-modal="true"
    >

        <div class="report-status-icon report-warning-icon">
            ?
        </div>

        <h2>
            Submit Issue Report?
        </h2>

        <p>
            Are you sure you want to submit this issue report?
            Our team will review and investigate the problem.
        </p>

        <div class="report-confirm-actions">

            <!-- CANCEL -->
            <button
                type="button"
                class="report-btn report-btn-cancel"
                onclick="closeReportConfirmModal()"
            >
                Cancel
            </button>

            <!-- SUBMIT -->
            <button
                type="button"
                class="report-btn report-btn-submit"
                onclick="submitIssueReport()"
            >
                Submit Report
            </button>

        </div>

    </div>
</div>
<div
    id="reportSuccessModal"
    class="report-modal-overlay"
    aria-hidden="true"
>
    <div
        class="report-confirm-modal"
        role="dialog"
        aria-modal="true"
    >

        <div class="report-status-icon report-success-icon">
            ✓
        </div>

        <h2>
            Report Submitted!
        </h2>

        <p>
            Your issue has been successfully submitted.
            Thank you for helping us improve Shine & Smile.
        </p>

        <button
            type="button"
            class="report-btn report-btn-submit"
            onclick="closeReportSuccessModal()"
        >
            Done
        </button>

    </div>
</div>
<!-- ==========================================================
     SUBMIT ISSUE REPORT CONFIRMATION MODAL
     ========================================================== -->

<div
    id="reportConfirmModal"
    class="report-modal-overlay"
    aria-hidden="true"
>
    <div
        class="report-confirm-modal"
        role="dialog"
        aria-modal="true"
        aria-labelledby="reportConfirmTitle"
    >

        <div class="report-status-icon report-warning-icon">
            ?
        </div>

        <h2 id="reportConfirmTitle">
            Submit Issue Report?
        </h2>

        <p>
            Are you sure you want to submit this issue report?
            Our team will review and investigate the problem.
        </p>

        <div class="report-confirm-actions">

            <!-- CANCEL -->
            <button
                type="button"
                class="report-btn report-btn-cancel"
                onclick="closeReportConfirmModal()"
            >
                Cancel
            </button>

            <!-- ACTUALLY SUBMIT -->
            <button
                type="button"
                class="report-btn report-btn-submit"
                onclick="confirmReportSubmission()"
            >
                Submit Report
            </button>

        </div>

    </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function () {

    const disable2faForm =
        document.getElementById("disable2faForm");

    if (disable2faForm) {

        disable2faForm.addEventListener("submit", function (event) {

            event.preventDefault();

            if (!confirm(
                "Are you sure you want to disable Two-Factor Authentication?"
            )) {
                return;
            }

            const submitButton =
                disable2faForm.querySelector(
                    'button[type="submit"]'
                );

            if (!submitButton) {
                return;
            }

            const originalText =
                submitButton.textContent;

            submitButton.disabled = true;
            submitButton.textContent = "Disabling...";

            fetch(disable2faForm.action, {
                method: "POST",

                headers: {
                    "Accept": "application/json",
                    "X-Requested-With": "XMLHttpRequest"
                },

                body: new FormData(disable2faForm)
            })

            .then(function (response) {

                return response.json().then(function (data) {

                    if (!response.ok) {

                        throw new Error(
                            data.message ||
                            "Unable to disable 2FA."
                        );
                    }

                    return data;
                });
            })

            .then(function (data) {

                if (!data.success) {

                    throw new Error(
                        data.message ||
                        "Unable to disable 2FA."
                    );
                }

                alert(
                    data.message ||
                    "Two-Factor Authentication has been disabled."
                );

                window.location.reload();
            })

            .catch(function (error) {

                console.error(error);

                alert(
                    error.message ||
                    "Something went wrong while disabling 2FA."
                );

                submitButton.disabled = false;
                submitButton.textContent = originalText;
            });
        });
    }
});
</script>


{{-- =========================================================
     REPORT SUCCESS MODAL
     ========================================================= --}}

@if(session('success'))

<script>
document.addEventListener("DOMContentLoaded", function () {

    const reportSuccessModal =
        document.getElementById("reportSuccessModal");

    if (!reportSuccessModal) {

        console.error(
            "Report Success Modal was not found."
        );

        return;
    }

    reportSuccessModal.classList.add("active");

    reportSuccessModal.setAttribute(
        "aria-hidden",
        "false"
    );

    document.body.style.overflow = "hidden";
});
</script>

@endif


{{-- =========================================================
     SETTINGS JAVASCRIPT
     ========================================================= --}}

<script>
document.addEventListener("DOMContentLoaded", function () {
    const menuButton = document.getElementById("settingsHeaderMenuBtn");
    const sidebar = document.getElementById("settingsMobileSidebar");
    const overlay = document.getElementById("settingsMobileSidebarOverlay");

    if (!menuButton || !sidebar) return;

    function openSettingsMenu() {
        sidebar.classList.add("active");
        if (overlay) overlay.classList.add("active");
        sidebar.setAttribute("aria-hidden", "false");
        if (overlay) overlay.setAttribute("aria-hidden", "false");
        menuButton.setAttribute("aria-expanded", "true");
        document.body.classList.add("settings-menu-open");
    }

    function closeSettingsMenu() {
        sidebar.classList.remove("active");
        if (overlay) overlay.classList.remove("active");
        sidebar.setAttribute("aria-hidden", "true");
        if (overlay) overlay.setAttribute("aria-hidden", "true");
        menuButton.setAttribute("aria-expanded", "false");
        document.body.classList.remove("settings-menu-open");
    }

    menuButton.addEventListener("click", function () {
        if (sidebar.classList.contains("active")) {
            closeSettingsMenu();
        } else {
            openSettingsMenu();
        }
    });

    if (overlay) {
        overlay.addEventListener("click", closeSettingsMenu);
    }

    sidebar.querySelectorAll(".settings-mobile-link").forEach(function (link) {
        link.addEventListener("click", function () {
            closeSettingsMenu();
        });
    });

    document.addEventListener("keydown", function (event) {
        if (event.key === "Escape") closeSettingsMenu();
    });
});
</script>

<script src="{{ asset('js/settings.js') }}"></script>
</body>
</html>
