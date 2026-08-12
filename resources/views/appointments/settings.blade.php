<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Settings | Dental Portal</title>
<link rel="stylesheet" href="{{ asset('css/settings.css') }}">
</head>
<body>

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

    <form action="{{ route('appointments.settings.profile') }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <!-- Profile Picture -->
        <div class="profile-section">

            <img
                id="preview"
                class="profile-img"
                src="{{ $user->profile_picture
                        ? asset('storage/'.$user->profile_picture)
                        : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=FCE7F3&color=E91E63' }}"
                alt="Profile">

            <input
                type="file"
                name="profile_picture"
                id="profile_picture"
                accept="image/*"
                onchange="previewImage(event)">

        </div>

        <!-- Name -->
        <div class="form-group">

            <label for="name">Full Name</label>

            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name', $user->name) }}"
                placeholder="Full Name">

        </div>

        <!-- Email -->
        <div class="form-group">

            <label for="email">Email Address</label>

            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email', $user->email) }}"
                placeholder="Email Address">

        </div>

        <!-- Save Button -->
        <div class="form-actions">

            <button type="submit" class="save-btn">

                <span>Save Changes</span>

                <span class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         width="20"
                         height="20"
                         viewBox="0 0 24 24"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="2.5"
                         stroke-linecap="round"
                         stroke-linejoin="round">
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
    <h2>Security</h2>

    @if(session('success'))
        <div class="success-message">
            {{ session('success') }}
        </div>
    @endif

    @error('current_password')
        <div class="error-message">
            {{ $message }}
        </div>
    @enderror

<form action="{{ route('settings.password.update') }}" method="POST">
    @csrf


    <div class="form-group">
    <label>Current Password</label>

    <div class="password-wrapper">

        <input
        type="password"
        id="currPass"
        name="current_password"
        placeholder="••••••••"
        required>



        <span class="eye-icon" onclick="togglePass('currPass')">
            <svg xmlns="http://www.w3.org/2000/svg"
                width="22"
                height="22"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2">

                <path d="M2.062 12.348a1 1 0 010-.696
                10.75 10.75 0 0119.876 0
                1 1 0 010 .696
                10.75 10.75 0 01-19.876 0"/>

                <circle cx="12" cy="12" r="3"/>
            </svg>
        </span>
    </div>

        @error('current_password')
            <small class="error-message">
                {{ $message }}
            </small>
        @enderror

    <small id="currentPasswordError"></small>
</div>

    <div class="form-group">
        <label>New Password</label>

        <div class="password-wrapper">

            <input
            type="password"
            id="newPass"
            name="password"
            placeholder="••••••••"
            required>

            @error('password')
                <small class="error-message">
                    {{ $message }}
                </small>
            @enderror

            <span class="eye-icon" onclick="togglePass('newPass')">
                <svg id="newPass-eye" xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">

                    <path d="M2.062 12.348a1 1 0 0 1 0-.696
                    10.75 10.75 0 0 1 19.876 0
                    1 1 0 0 1 0 .696
                    10.75 10.75 0 0 1-19.876 0"/>

                    <circle cx="12" cy="12" r="3"/>
                </svg>
            </span>

        </div>
    </div>

    <div id="passwordChecker" class="hidden">

    <div class="password-strength">
        Password Strength:
        <span id="strengthText">Weak</span>
    </div>

    <ul class="password-checklist">
        <li id="length">❌ At least 8 characters</li>
        <li id="uppercase">❌ One uppercase letter</li>
        <li id="lowercase">❌ One lowercase letter</li>
        <li id="number">❌ One number</li>
        <li id="special">❌ One special character</li>
    </ul>

</div>

    <div class="form-group">
    <label>Confirm New Password</label>

    <div class="password-wrapper">

        <input
        type="password"
        id="confPass"
        name="password_confirmation"
        placeholder="••••••••"
        required>

            @error('password_confirmation')
                <small class="error-message">
                    {{ $message }}
                </small>
            @enderror

        <span class="eye-icon" onclick="togglePass('confPass')">
            <svg id="confPass-eye" xmlns="http://www.w3.org/2000/svg"
                width="22"
                height="22"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round">

                <path d="M2.062 12.348a1 1 0 0 1 0-.696
                10.75 10.75 0 0 1 19.876 0
                1 1 0 0 1 0 .696
                10.75 10.75 0 0 1-19.876 0"/>

                <circle cx="12" cy="12" r="3"/>
            </svg>
        </span>

    </div>

    <small id="confirmError" class="confirm-error"></small>

</div>

    <div class="button-group">
        <button type="submit" class="btn btn-primary">
    <svg xmlns="http://www.w3.org/2000/svg"
        width="20"
        height="20"
        viewBox="0 0 24 24"
        fill="none"
        stroke="currentColor"
        stroke-width="2"
        stroke-linecap="round"
        stroke-linejoin="round"
        style="margin-right:8px; vertical-align:middle;">

        <rect x="3" y="11" width="18" height="10" rx="2" ry="2"></rect>

        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>

    </svg>

    Change Password
</button>

    <button
    class="btn btn-outline"
    type="button"
    onclick="window.location='{{ route('settings.2fa') }}'">

    🛡 Enable Two-Factor Auth
</button>

        </div>

    </form>

</section>

    <section id="notifications" class="card">
        <h2>Notifications</h2>
        <div style="display:flex; justify-content: space-between; margin-bottom: 1rem;">
            <span>Appointment Reminders</span>
            <label class="switch"><input type="checkbox" checked><span class="slider"></span></label>
        </div>
        <div style="display:flex; justify-content: space-between;">
            <span>Promotional Emails</span>
            <label class="switch"><input type="checkbox"><span class="slider"></span></label>
        </div>
    </section>

    <section id="appearance" class="card">
        <h2>Appearance</h2>
        <label><input type="radio" name="theme"> Light</label>
        <label style="margin-left: 20px;"><input type="radio" name="theme" checked> Pink Mode</label>
    </section>

    <section id="preferences" class="card">
        <h2>Appointment Preferences</h2>
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
        <h2>Privacy</h2>
        <button class="btn btn-outline" style="margin-right: 10px;">Download Data</button>
        <button class="btn btn-danger" onclick="confirmDelete()">Delete Account</button>
    </section>
</main>



<script src="{{ asset('js/settings.js') }}"></script>
</body>
</html>
