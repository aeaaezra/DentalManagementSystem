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
        Shine & Smile | My Profile
    </title>


    {{-- =========================================================
         CSS
    ========================================================== --}}

    <link
        rel="stylesheet"
        href="{{ asset('css/customer/profile.css') }}"
    >

</head>


<body>


{{-- =============================================================
     HEADER
============================================================= --}}

<header class="customer-header">

    {{-- BRAND --}}

    <div class="brand">

        <div class="brand-icon">

            <svg
                viewBox="0 0 24 24"
                aria-hidden="true"
            >

                <path
                    d="M8.5 3.5
                       C6.2 3.5 4.5 5.2 4.5 7.8
                       C4.5 11.2 5.8 14.3 6.4 17.4
                       C6.8 19.5 7.7 21 9 21
                       C10.3 21 10.5 18.2 12 18.2
                       C13.5 18.2 13.7 21 15 21
                       C16.3 21 17.2 19.5 17.6 17.4
                       C18.2 14.3 19.5 11.2 19.5 7.8
                       C19.5 5.2 17.8 3.5 15.5 3.5
                       C14 3.5 13 4.3 12 4.3
                       C11 4.3 10 3.5 8.5 3.5Z"
                />

            </svg>

        </div>


        <div class="brand-text">

            <h1>
                Shine & Smile
            </h1>

            <span>
                Dental Clinic
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

            <svg
                viewBox="0 0 24 24"
                aria-hidden="true"
            >

                <path
                    d="M3 4h2l2.4 11.2a2 2 0 0 0 2 1.6h7.8a2 2 0 0 0 2-1.6L21 8H6"
                />

                <circle
                    cx="10"
                    cy="20"
                    r="1.2"
                />

                <circle
                    cx="18"
                    cy="20"
                    r="1.2"
                />

            </svg>


            <span id="cartCount">
                0
            </span>

        </a>


        {{-- PROFILE DROPDOWN --}}

        <div class="customer-profile-wrapper">


            <button
                type="button"
                class="customer-profile"
                id="profileDropdownButton"
                aria-expanded="false"
                aria-haspopup="true"
            >

                <div class="profile-avatar">

                    {{
                        strtoupper(
                            substr(
                                $user->name ?? 'C',
                                0,
                                1
                            )
                        )
                    }}

                </div>


                <div class="profile-info">

                    <strong>
                        {{ $user->name ?? 'Customer' }}
                    </strong>

                    <small>
                        Customer
                    </small>

                </div>


                <span class="profile-chevron">

                    <svg viewBox="0 0 24 24">

                        <path
                            d="m6 9 6 6 6-6"
                        />

                    </svg>

                </span>

            </button>


            {{-- DROPDOWN --}}

            <div
                class="profile-dropdown"
                id="profileDropdown"
            >

                <div class="dropdown-user">


                    <div class="dropdown-avatar">

                        {{
                            strtoupper(
                                substr(
                                    $user->name ?? 'C',
                                    0,
                                    1
                                )
                            )
                        }}

                    </div>


                    <div class="dropdown-user-info">

                        <strong>
                            {{ $user->name ?? 'Customer' }}
                        </strong>

                        <span>
                            {{ $user->email ?? '' }}
                        </span>

                    </div>

                </div>


                <div class="dropdown-divider"></div>


                {{-- PROFILE --}}

                <a
                    href="{{ route('customer.profile') }}"
                    class="dropdown-item active"
                >

                    <span class="dropdown-icon">

                        <svg viewBox="0 0 24 24">

                            <circle
                                cx="12"
                                cy="7"
                                r="4"
                            />

                            <path
                                d="M4 21a8 8 0 0 1 16 0"
                            />

                        </svg>

                    </span>

                    <span>
                        My Profile
                    </span>

                </a>


                {{-- SETTINGS --}}

                <a
                    href="{{ route('customer.settings') }}"
                    class="dropdown-item"
                >

                    <span class="dropdown-icon">

                        <svg viewBox="0 0 24 24">

                            <circle
                                cx="12"
                                cy="12"
                                r="3"
                            />

                            <path
                                d="M19 13v-2l-2-.5
                                   a6.8 6.8 0 0 0-.6-1.4l1-1.7
                                   -1.4-1.4-1.7 1
                                   A6.8 6.8 0 0 0 13 6.4L12.5 4h-2l-.5 2.4
                                   a6.8 6.8 0 0 0-1.4.6l-1.7-1
                                   L5.5 7.4l1 1.7
                                   A6.8 6.8 0 0 0 5.9 10.5L4 11v2l1.9.5
                                   c.2.5.4 1 .7 1.4l-1 1.7
                                   1.4 1.4 1.7-1
                                   c.4.3.9.5 1.4.6l.5 2.4h2l.5-2.4
                                   c.5-.1 1-.4 1.4-.6l1.7 1
                                   1.4-1.4-1-1.7
                                   c.3-.4.5-.9.6-1.4L19 13Z"
                            />

                        </svg>

                    </span>

                    <span>
                        Settings
                    </span>

                </a>


                <div class="dropdown-divider"></div>


                {{-- LOGOUT --}}

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

                            <svg viewBox="0 0 24 24">

                                <path
                                    d="M10 4H5a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h5"
                                />

                                <path
                                    d="M14 8l4 4-4 4"
                                />

                                <path
                                    d="M18 12H9"
                                />

                            </svg>

                        </span>

                        <span>
                            Logout
                        </span>

                    </button>

                </form>

            </div>

        </div>

    </div>

</header>



{{-- =============================================================
     MAIN
============================================================= --}}

<main class="profile-page">


    {{-- PAGE HEADER --}}

    <section class="profile-heading">

        <div>

            <span class="profile-label">
                CUSTOMER ACCOUNT
            </span>

            <h2>
                My Profile
            </h2>

            <p>
                View and manage your Shine & Smile
                customer information.
            </p>

        </div>


        <a
            href="{{ route('customer.settings') }}"
            class="profile-settings-button"
        >

            <svg viewBox="0 0 24 24">

                <circle
                    cx="12"
                    cy="12"
                    r="3"
                />

                <path
                    d="M19 13v-2l-2-.5"
                />

            </svg>

            Settings

        </a>

    </section>



    {{-- PROFILE HERO --}}

    <section class="profile-hero">


        <div class="profile-hero-left">


            <div class="profile-large-avatar">

                {{
                    strtoupper(
                        substr(
                            $user->name ?? 'C',
                            0,
                            1
                        )
                    )
                }}

            </div>


            <div class="profile-hero-info">

                <span class="customer-badge">
                    CUSTOMER
                </span>


                <h3>
                    {{ $user->name ?? 'Customer' }}
                </h3>


                <p>
                    {{ $user->email ?? 'No email address' }}
                </p>


                <span class="member-since">
                    Shine & Smile Customer
                </span>

            </div>

        </div>


        <div class="profile-hero-action">

            <a
                href="#personalInformation"
                class="edit-profile-button"
            >

                <svg viewBox="0 0 24 24">

                    <path
                        d="M4 20h4L19 9a2.8 2.8 0 0 0-4-4L4 16v4Z"
                    />

                    <path
                        d="m13.5 6.5 4 4"
                    />

                </svg>

                Edit Profile

            </a>

        </div>

    </section>



    {{-- PROFILE LAYOUT --}}

    <div class="profile-layout">


        {{-- PERSONAL INFORMATION --}}

        <section
            class="profile-main-card"
            id="personalInformation"
        >


            <div class="profile-card-header">

                <div>

                    <h3>
                        Personal Information
                    </h3>

                    <p>
                        Your basic account information.
                    </p>

                </div>

            </div>


            <div class="information-grid">


                {{-- NAME --}}

                <div class="information-item">

                    <div class="information-icon">

                        <svg viewBox="0 0 24 24">

                            <circle
                                cx="12"
                                cy="7"
                                r="4"
                            />

                            <path
                                d="M4 21a8 8 0 0 1 16 0"
                            />

                        </svg>

                    </div>


                    <div class="information-content">

                        <span>
                            Full Name
                        </span>

                        <strong>
                            {{ $user->name ?? 'Not provided' }}
                        </strong>

                    </div>

                </div>



                {{-- EMAIL --}}

                <div class="information-item">

                    <div class="information-icon">

                        <svg viewBox="0 0 24 24">

                            <rect
                                x="3"
                                y="5"
                                width="18"
                                height="14"
                                rx="2"
                            />

                            <path
                                d="m3 7 9 6 9-6"
                            />

                        </svg>

                    </div>


                    <div class="information-content">

                        <span>
                            Email Address
                        </span>

                        <strong>
                            {{ $user->email ?? 'Not provided' }}
                        </strong>

                    </div>

                </div>



                {{-- PHONE --}}

                <div class="information-item">

                    <div class="information-icon">

                        <svg viewBox="0 0 24 24">

                            <path
                                d="M6.5 3.5
                                   9 3
                                   11 8
                                   8.5 9.5
                                   a15 15 0 0 0 6 6
                                   L16 13
                                   21 15
                                   20.5 17.5
                                   C20 20 18 21 16.5 20.5
                                   8.5 18
                                   5 14
                                   3.5 7.5
                                   C3 5.8 4.5 4 6.5 3.5Z"
                            />

                        </svg>

                    </div>


                    <div class="information-content">

                        <span>
                            Phone Number
                        </span>

                        <strong>
                            {{ $user->phone ?? 'Not provided' }}
                        </strong>

                    </div>

                </div>



                {{-- ADDRESS --}}

                <div class="information-item">

                    <div class="information-icon">

                        <svg viewBox="0 0 24 24">

                            <path
                                d="M20 10
                                   c0 5-8 11-8 11
                                   S4 15 4 10
                                   a8 8 0 1 1 16 0Z"
                            />

                            <circle
                                cx="12"
                                cy="10"
                                r="2.5"
                            />

                        </svg>

                    </div>


                    <div class="information-content">

                        <span>
                            Address
                        </span>

                        <strong>
                            {{ $user->address ?? 'Not provided' }}
                        </strong>

                    </div>

                </div>

            </div>

        </section>



        {{-- RIGHT SIDE --}}

        <aside class="profile-side">


            {{-- ORDER ACTIVITY --}}

            <div class="profile-side-card">

                <div class="side-card-header">

                    <h3>
                        Order Activity
                    </h3>

                </div>


                {{-- TOTAL ORDERS --}}

                <div class="activity-stat">

                    <div class="activity-icon">

                        <svg viewBox="0 0 24 24">

                            <path
                                d="m4 7 8-4 8 4-8 4-8-4Z"
                            />

                            <path
                                d="M4 7v10l8 4 8-4V7"
                            />

                            <path
                                d="M12 11v10"
                            />

                        </svg>

                    </div>


                    <div>

                        <span>
                            Total Orders
                        </span>

                        <strong>
                            {{ $totalOrders ?? 0 }}
                        </strong>

                    </div>

                </div>


                {{-- PENDING ORDERS --}}

                <div class="activity-stat">

                    <div class="activity-icon pending">

                        <svg viewBox="0 0 24 24">

                            <circle
                                cx="12"
                                cy="12"
                                r="8"
                            />

                            <path
                                d="M12 7v5l3 2"
                            />

                        </svg>

                    </div>


                    <div>

                        <span>
                            Pending Orders
                        </span>

                        <strong>
                            {{ $pendingOrders ?? 0 }}
                        </strong>

                    </div>

                </div>


                {{-- COMPLETED ORDERS --}}

                <div class="activity-stat">

                    <div class="activity-icon completed">

                        <svg viewBox="0 0 24 24">

                            <path
                                d="m5 12 4 4L19 6"
                            />

                        </svg>

                    </div>


                    <div>

                        <span>
                            Completed Orders
                        </span>

                        <strong>
                            {{ $completedOrders ?? 0 }}
                        </strong>

                    </div>

                </div>


                <a
                    href="{{ route('customer.orders') }}"
                    class="view-orders-button"
                >
                    View My Orders
                </a>

            </div>



            {{-- ACCOUNT INFORMATION --}}

            <div class="profile-side-card">

                <div class="side-card-header">

                    <h3>
                        Account Information
                    </h3>

                </div>


                <div class="account-detail">

                    <span>
                        Account Type
                    </span>

                    <strong>
                        Customer
                    </strong>

                </div>


                <div class="account-detail">

                    <span>
                        Account ID
                    </span>

                    <strong>
                        #{{ $user->id }}
                    </strong>

                </div>


                <div class="account-detail">

                    <span>
                        Email
                    </span>

                    <strong>

                        @if($user->email_verified_at)

                            Verified

                        @else

                            Not Verified

                        @endif

                    </strong>

                </div>


                <a
                    href="{{ route('customer.settings') }}"
                    class="settings-link"
                >
                    Manage Account Settings
                    <span>→</span>
                </a>

            </div>

        </aside>

    </div>



    {{-- =========================================================
         QUICK ACTIONS
    ========================================================== --}}

    <section class="quick-actions">


        <div class="quick-actions-header">

            <h3>
                Quick Actions
            </h3>

            <p>
                Quickly access your customer features.
            </p>

        </div>


        <div class="quick-action-grid">


            {{-- PRODUCTS --}}

            <a
                href="{{ route('customer.products') }}"
                class="quick-action"
            >

                <div class="quick-action-icon">

                    <svg viewBox="0 0 24 24">

                        <path
                            d="M6 8h12l1 13H5L6 8Z"
                        />

                        <path
                            d="M9 8a3 3 0 0 1 6 0"
                        />

                    </svg>

                </div>


                <div class="quick-action-content">

                    <strong>
                        Browse Products
                    </strong>

                    <span>
                        Shop dental products
                    </span>

                </div>


                <span class="quick-arrow">

                    <svg viewBox="0 0 24 24">

                        <path
                            d="M5 12h14"
                        />

                        <path
                            d="m13 6 6 6-6 6"
                        />

                    </svg>

                </span>

            </a>



            {{-- CART --}}

            <a
                href="{{ route('customer.cart') }}"
                class="quick-action"
            >

                <div class="quick-action-icon">

                    <svg viewBox="0 0 24 24">

                        <path
                            d="M3 4h2l2.4 11.2a2 2 0 0 0 2 1.6h7.8a2 2 0 0 0 2-1.6L21 8H6"
                        />

                        <circle
                            cx="10"
                            cy="20"
                            r="1.2"
                        />

                        <circle
                            cx="18"
                            cy="20"
                            r="1.2"
                        />

                    </svg>

                </div>


                <div class="quick-action-content">

                    <strong>
                        Shopping Cart
                    </strong>

                    <span>
                        Review your selected items
                    </span>

                </div>


                <span class="quick-arrow">

                    <svg viewBox="0 0 24 24">

                        <path
                            d="M5 12h14"
                        />

                        <path
                            d="m13 6 6 6-6 6"
                        />

                    </svg>

                </span>

            </a>



            {{-- ORDERS --}}

            <a
                href="{{ route('customer.orders') }}"
                class="quick-action"
            >

                <div class="quick-action-icon">

                    <svg viewBox="0 0 24 24">

                        <path
                            d="m4 7 8-4 8 4-8 4-8-4Z"
                        />

                        <path
                            d="M4 7v10l8 4 8-4V7"
                        />

                        <path
                            d="M12 11v10"
                        />

                    </svg>

                </div>


                <div class="quick-action-content">

                    <strong>
                        My Orders
                    </strong>

                    <span>
                        Track your orders
                    </span>

                </div>


                <span class="quick-arrow">

                    <svg viewBox="0 0 24 24">

                        <path
                            d="M5 12h14"
                        />

                        <path
                            d="m13 6 6 6-6 6"
                        />

                    </svg>

                </span>

            </a>



            {{-- SETTINGS --}}

            <a
                href="{{ route('customer.settings') }}"
                class="quick-action"
            >

                <div class="quick-action-icon">

                    <svg viewBox="0 0 24 24">

                        <circle
                            cx="12"
                            cy="12"
                            r="3"
                        />

                        <path
                            d="M19 13v-2l-2-.5
                               a6.8 6.8 0 0 0-.6-1.4l1-1.7
                               -1.4-1.4-1.7 1
                               A6.8 6.8 0 0 0 13 6.4L12.5 4h-2l-.5 2.4
                               a6.8 6.8 0 0 0-1.4.6l-1.7-1
                               L5.5 7.4l1 1.7
                               A6.8 6.8 0 0 0 5.9 10.5L4 11v2l1.9.5
                               c.2.5.4 1 .9 1.4l-1 1.7
                               1.4 1.4 1.7-1
                               c.4.3.9.5 1.4.6l.5 2.4h2l.5-2.4
                               c.5-.1 1-.4 1.4-.6l1.7 1
                               1.4-1.4-1-1.7
                               c.3-.4.5-.9.6-1.4L19 13Z"
                        />

                    </svg>

                </div>


                <div class="quick-action-content">

                    <strong>
                        Settings
                    </strong>

                    <span>
                        Manage your account
                    </span>

                </div>


                <span class="quick-arrow">

                    <svg viewBox="0 0 24 24">

                        <path
                            d="M5 12h14"
                        />

                        <path
                            d="m13 6 6 6-6 6"
                        />

                    </svg>

                </span>

            </a>

        </div>

    </section>

</main>



{{-- =============================================================
     JAVASCRIPT
============================================================= --}}

<script
    src="{{ asset('js/customer/profile.js') }}"
></script>


</body>
</html>
