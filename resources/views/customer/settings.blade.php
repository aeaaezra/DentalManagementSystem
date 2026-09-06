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
        Shine & Smile | Settings
    </title>


    <link
        rel="stylesheet"
        href="{{ asset('css/customer/product.css') }}"
    >


    <link
        rel="stylesheet"
        href="{{ asset('css/customer/settings.css') }}"
    >

</head>


<body>


    {{-- =========================================================
         HEADER
    ========================================================== --}}

    <header class="customer-header">


        {{-- BRAND --}}

        <div class="brand">

            <div class="brand-icon">
                🦷
            </div>


            <div>

                <h1>
                    Shine & Smile
                </h1>

                <span>
                    Dental Products
                </span>

            </div>

        </div>



        {{-- NAVIGATION --}}

        <nav class="customer-nav">

            <a
                href="{{ route('customer.products') }}"
                class="nav-link"
            >
                Products
            </a>


            <a
                href="{{ route('customer.orders') }}"
                class="nav-link"
            >
                My Orders
            </a>

        </nav>



        {{-- HEADER ACTIONS --}}

        <div class="header-actions">


            {{-- CART --}}

            <a
                href="{{ route('customer.cart') }}"
                class="cart-button"
                aria-label="Shopping Cart"
            >

                🛒

                <span id="cartCount">
                    0
                </span>

            </a>



            {{-- PROFILE --}}

            <div class="customer-profile-wrapper">

                <button
                    type="button"
                    class="customer-profile"
                    id="profileDropdownButton"
                    aria-expanded="false"
                >

                    <div class="profile-avatar">

                        {{
                            strtoupper(
                                substr(
                                    auth()->user()->name ?? 'C',
                                    0,
                                    1
                                )
                            )
                        }}

                    </div>


                    <div class="profile-info">

                        <strong>
                            {{ auth()->user()->name ?? 'Customer' }}
                        </strong>

                        <small>
                            Customer
                        </small>

                    </div>


                    <span class="profile-chevron">
                        ▾
                    </span>

                </button>



                {{-- PROFILE DROPDOWN --}}

                <div
                    class="profile-dropdown"
                    id="profileDropdown"
                >

                    <div class="dropdown-user">

                        <div class="dropdown-avatar">

                            {{
                                strtoupper(
                                    substr(
                                        auth()->user()->name ?? 'C',
                                        0,
                                        1
                                    )
                                )
                            }}

                        </div>


                        <div>

                            <strong>
                                {{ auth()->user()->name ?? 'Customer' }}
                            </strong>

                            <span>
                                {{ auth()->user()->email ?? '' }}
                            </span>

                        </div>

                    </div>


                    <div class="dropdown-divider"></div>


                    <a
                        href="{{ route('customer.settings') }}"
                        class="dropdown-item active"
                    >

                        <span class="dropdown-icon">
                            ⚙️
                        </span>

                        Settings

                    </a>


                    <div class="dropdown-divider"></div>


                    <form
                        method="POST"
                        action="{{ route('logout') }}"
                    >

                        @csrf

                        <button
                            type="submit"
                            class="dropdown-item logout-item"
                        >

                            <span class="dropdown-icon">
                                🚪
                            </span>

                            Logout

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </header>



    {{-- =========================================================
         MAIN
    ========================================================== --}}

    <main class="settings-page">


        {{-- PAGE HEADER --}}

        <section class="settings-heading">

            <div>

                <span class="settings-label">
                    ACCOUNT SETTINGS
                </span>


                <h2>
                    Settings
                </h2>


                <p>
                    Manage your account and ordering preferences.
                </p>

            </div>

        </section>



        {{-- =====================================================
             SETTINGS LAYOUT
        ====================================================== --}}

        <div class="settings-layout">


            {{-- =================================================
                 SETTINGS SIDEBAR
            ================================================== --}}

            <aside class="settings-sidebar">


                <button
                    type="button"
                    class="settings-menu active"
                    data-section="profile"
                >

                    <span>
                        👤
                    </span>

                    Profile

                </button>


                <button
                    type="button"
                    class="settings-menu"
                    data-section="password"
                >

                    <span>
                        🔒
                    </span>

                    Password

                </button>


                <button
                    type="button"
                    class="settings-menu"
                    data-section="notifications"
                >

                    <span>
                        🔔
                    </span>

                    Notifications

                </button>


                <button
                    type="button"
                    class="settings-menu"
                    data-section="ordering"
                >

                    <span>
                        🛒
                    </span>

                    Ordering

                </button>


                <button
                    type="button"
                    class="settings-menu"
                    data-section="account"
                >

                    <span>
                        ⚙️
                    </span>

                    Account

                </button>

            </aside>



            {{-- =================================================
                 SETTINGS CONTENT
            ================================================== --}}

            <section class="settings-content">


                {{-- =================================================
                     PROFILE
                ================================================== --}}

                <div
                    class="settings-panel active"
                    id="profile"
                >

                    <div class="panel-header">

                        <div>

                            <h3>
                                Profile Information
                            </h3>

                            <p>
                                Update your personal information.
                            </p>

                        </div>

                    </div>


                    <form
                        id="profileForm"
                        class="settings-form"
                    >

                        @csrf


                        <div class="profile-preview">

                            <div class="large-avatar">

                                {{
                                    strtoupper(
                                        substr(
                                            auth()->user()->name ?? 'C',
                                            0,
                                            1
                                        )
                                    )
                                }}

                            </div>


                            <div>

                                <strong>
                                    {{ auth()->user()->name ?? 'Customer' }}
                                </strong>

                                <span>
                                    Customer Account
                                </span>

                            </div>

                        </div>


                        <div class="form-grid">


                            <div class="form-group">

                                <label>
                                    Full Name
                                </label>

                                <input
                                    type="text"
                                    name="name"
                                    value="{{ auth()->user()->name ?? '' }}"
                                    placeholder="Enter your name"
                                >

                            </div>


                            <div class="form-group">

                                <label>
                                    Email Address
                                </label>

                                <input
                                    type="email"
                                    name="email"
                                    value="{{ auth()->user()->email ?? '' }}"
                                    placeholder="Enter your email"
                                >

                            </div>


                            <div class="form-group">

                                <label>
                                    Phone Number
                                </label>

                                <input
                                    type="text"
                                    name="phone"
                                    placeholder="Enter phone number"
                                >

                            </div>


                            <div class="form-group">

                                <label>
                                    Address
                                </label>

                                <input
                                    type="text"
                                    name="address"
                                    placeholder="Enter your address"
                                >

                            </div>

                        </div>


                        <div class="form-actions">

                            <button
                                type="submit"
                                class="save-button"
                            >
                                Save Changes
                            </button>

                        </div>

                    </form>

                </div>



                {{-- =================================================
                     PASSWORD
                ================================================== --}}

                <div
                    class="settings-panel"
                    id="password"
                >

                    <div class="panel-header">

                        <div>

                            <h3>
                                Change Password
                            </h3>

                            <p>
                                Keep your account secure by using
                                a strong password.
                            </p>

                        </div>

                    </div>


                    <form
                        id="passwordForm"
                        class="settings-form"
                    >

                        @csrf


                        <div class="form-group">

                            <label>
                                Current Password
                            </label>

                            <input
                                type="password"
                                name="current_password"
                                placeholder="Enter current password"
                            >

                        </div>


                        <div class="form-group">

                            <label>
                                New Password
                            </label>

                            <input
                                type="password"
                                name="password"
                                placeholder="Enter new password"
                            >

                        </div>


                        <div class="form-group">

                            <label>
                                Confirm New Password
                            </label>

                            <input
                                type="password"
                                name="password_confirmation"
                                placeholder="Confirm new password"
                            >

                        </div>


                        <div class="password-tip">

                            🔐

                            <span>
                                Use at least 8 characters with a
                                combination of letters and numbers.
                            </span>

                        </div>


                        <div class="form-actions">

                            <button
                                type="submit"
                                class="save-button"
                            >
                                Update Password
                            </button>

                        </div>

                    </form>

                </div>



                {{-- =================================================
                     NOTIFICATIONS
                ================================================== --}}

                <div
                    class="settings-panel"
                    id="notifications"
                >

                    <div class="panel-header">

                        <div>

                            <h3>
                                Notifications
                            </h3>

                            <p>
                                Choose which notifications you want
                                to receive.
                            </p>

                        </div>

                    </div>


                    <div class="preference-list">


                        <div class="preference-item">

                            <div class="preference-icon">
                                📦
                            </div>


                            <div class="preference-text">

                                <strong>
                                    Order Updates
                                </strong>

                                <span>
                                    Receive updates when your order
                                    status changes.
                                </span>

                            </div>


                            <label class="switch">

                                <input
                                    type="checkbox"
                                    checked
                                    name="order_notifications"
                                >

                                <span class="slider"></span>

                            </label>

                        </div>



                        <div class="preference-item">

                            <div class="preference-icon">
                                🛍️
                            </div>


                            <div class="preference-text">

                                <strong>
                                    Promotions
                                </strong>

                                <span>
                                    Receive special offers and
                                    product promotions.
                                </span>

                            </div>


                            <label class="switch">

                                <input
                                    type="checkbox"
                                    checked
                                    name="promotion_notifications"
                                >

                                <span class="slider"></span>

                            </label>

                        </div>



                        <div class="preference-item">

                            <div class="preference-icon">
                                📅
                            </div>


                            <div class="preference-text">

                                <strong>
                                    Appointment Notifications
                                </strong>

                                <span>
                                    Receive important appointment
                                    reminders and updates.
                                </span>

                            </div>


                            <label class="switch">

                                <input
                                    type="checkbox"
                                    checked
                                    name="appointment_notifications"
                                >

                                <span class="slider"></span>

                            </label>

                        </div>

                    </div>

                </div>



                {{-- =================================================
                     ORDERING
                ================================================== --}}

                <div
                    class="settings-panel"
                    id="ordering"
                >

                    <div class="panel-header">

                        <div>

                            <h3>
                                Ordering Preferences
                            </h3>

                            <p>
                                Customize how you place and receive
                                your orders.
                            </p>

                        </div>

                    </div>


                    <div class="preference-list">


                        <div class="preference-item">

                            <div class="preference-icon">
                                🏥
                            </div>


                            <div class="preference-text">

                                <strong>
                                    Clinic Pickup
                                </strong>

                                <span>
                                    Prefer picking up orders at
                                    Shine & Smile Dental Clinic.
                                </span>

                            </div>


                            <label class="switch">

                                <input
                                    type="checkbox"
                                    name="clinic_pickup"
                                >

                                <span class="slider"></span>

                            </label>

                        </div>



                        <div class="preference-item">

                            <div class="preference-icon">
                                🚚
                            </div>


                            <div class="preference-text">

                                <strong>
                                    Delivery
                                </strong>

                                <span>
                                    Enable delivery as your preferred
                                    ordering method.
                                </span>

                            </div>


                            <label class="switch">

                                <input
                                    type="checkbox"
                                    checked
                                    name="delivery"
                                >

                                <span class="slider"></span>

                            </label>

                        </div>


                    </div>


                    <div class="info-box">

                        💡

                        <span>
                            Your selected ordering preferences can
                            be used automatically during checkout.
                        </span>

                    </div>

                </div>



                {{-- =================================================
                     ACCOUNT
                ================================================== --}}

                <div
                    class="settings-panel"
                    id="account"
                >

                    <div class="panel-header">

                        <div>

                            <h3>
                                Account
                            </h3>

                            <p>
                                Manage your Shine & Smile customer
                                account.
                            </p>

                        </div>

                    </div>


                    <div class="account-actions">


                        <div class="danger-box">

                            <div>

                                <strong>
                                    Delete Account
                                </strong>

                                <p>
                                    Permanently delete your customer
                                    account and associated data.
                                </p>

                            </div>


                            <button
                                type="button"
                                class="danger-button"
                                id="deleteAccountButton"
                            >
                                Delete Account
                            </button>

                        </div>


                    </div>

                </div>

            </section>

        </div>

    </main>



    {{-- =========================================================
         TOAST
    ========================================================== --}}

    <div
        id="settingsToast"
        class="settings-toast"
    ></div>



    {{-- =========================================================
         JAVASCRIPT
    ========================================================== --}}

    <script src="{{ asset('js/customer/settings.js') }}"></script>

</body>

</html>
