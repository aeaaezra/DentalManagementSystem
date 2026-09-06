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

    <title>Notifications | Shine & Smile</title>

    <link
        rel="stylesheet"
        href="{{ asset('css/receptionist/receptionist-notifications.css') }}?v={{ time() }}"
    >

    <style>

        .notification-modal-overlay {
            position: fixed;
            inset: 0;
            z-index: 99999;

            display: flex;
            align-items: center;
            justify-content: center;

            padding: 20px;

            background: rgba(15, 23, 42, 0.55);
            backdrop-filter: blur(5px);

            opacity: 0;
            visibility: hidden;
            pointer-events: none;

            transition:
                opacity 0.25s ease,
                visibility 0.25s ease;
        }

        .notification-modal-overlay.active {
            opacity: 1;
            visibility: visible;
            pointer-events: auto;
        }

        .notification-modal {
            width: 100%;
            max-width: 440px;

            padding: 32px;

            background: #ffffff;

            border: 1px solid #e9edf2;
            border-radius: 20px;

            text-align: center;

            box-shadow:
                0 25px 70px
                rgba(15, 23, 42, 0.28);

            transform:
                translateY(20px)
                scale(0.97);

            transition:
                transform 0.25s ease;
        }

        .notification-modal-overlay.active
        .notification-modal {
            transform:
                translateY(0)
                scale(1);
        }

        .modal-icon {
            width: 64px;
            height: 64px;

            display: flex;
            align-items: center;
            justify-content: center;

            margin:
                0
                auto
                20px;

            border-radius: 18px;
        }

        .modal-icon-primary {
            background: #fdf2f8;
            color: #e52b88;
        }

        .modal-icon-danger {
            background: #fef2f2;
            color: #dc2626;
        }

        .notification-modal h3 {
            margin: 0 0 10px;

            color: #1e293b;

            font-size: 21px;
            font-weight: 800;

            letter-spacing: -0.3px;
        }

        .notification-modal p {
            margin: 0 auto;

            max-width: 360px;

            color: #64748b;

            font-size: 14px;

            line-height: 1.65;
        }

        .modal-actions {
            display: flex;

            justify-content: center;

            gap: 12px;

            margin-top: 28px;
        }

        .modal-actions button {
            min-height: 44px;

            padding: 0 20px;

            border-radius: 10px;

            font-size: 13px;
            font-weight: 700;

            cursor: pointer;

            transition:
                transform 0.2s ease,
                box-shadow 0.2s ease,
                background 0.2s ease;
        }

        .modal-cancel {
            border: 1px solid #e2e8f0;

            background: #ffffff;

            color: #64748b;
        }

        .modal-cancel:hover {
            background: #f8fafc;

            color: #334155;
        }

        .modal-confirm {
            border: none;

            color: #ffffff;
        }

        .modal-confirm-primary {
            background:
                linear-gradient(
                    135deg,
                    #db2777,
                    #ec4899
                );

            box-shadow:
                0 8px 18px
                rgba(219, 39, 119, 0.25);
        }

        .modal-confirm-primary:hover {
            transform: translateY(-2px);

            box-shadow:
                0 12px 25px
                rgba(219, 39, 119, 0.32);
        }

        .modal-confirm-danger {
            background: #dc2626;

            box-shadow:
                0 8px 18px
                rgba(220, 38, 38, 0.2);
        }

        .modal-confirm-danger:hover {
            background: #b91c1c;

            transform: translateY(-2px);

            box-shadow:
                0 12px 25px
                rgba(220, 38, 38, 0.3);
        }

        @media (max-width: 500px) {

            .notification-modal {
                padding: 26px 20px;
            }

            .modal-actions {
                flex-direction: column-reverse;
            }

            .modal-actions button {
                width: 100%;
            }

        }

    </style>

</head>


<body class="receptionist-body">


<header class="topbar">

    <div class="topbar-title">

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

                <path d="M10 21h4" />

            </svg>


            @if($unreadCount > 0)

                <span class="notification-count">
                    {{ $unreadCount }}
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


        <form
            action="{{ route('logout') }}"
            method="POST"
            class="logout-form"
        >

            @csrf

            <button
                type="submit"
                class="header-logout-button"
                title="Logout"
            >

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="19"
                    height="19"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >

                    <path
                        d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"
                    />

                    <polyline
                        points="16 17 21 12 16 7"
                    />

                    <line
                        x1="21"
                        y1="12"
                        x2="9"
                        y2="12"
                    />

                </svg>

                <span>
                    Logout
                </span>

            </button>

        </form>

    </div>

</header>



<div class="receptionist-layout">


    <aside class="receptionist-sidebar">


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



        <nav class="sidebar-navigation">


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
                >

                    <path d="M3 10.5L12 3l9 7.5" />
                    <path d="M5 9.5V21h14V9.5" />
                    <path d="M9 21v-6h6v6" />

                </svg>

                <span>
                    Dashboard
                </span>

            </a>



            <a
                href="{{ route('receptionist.dashboard') }}#appointments"
                class="sidebar-link"
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



        <div class="sidebar-user">

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



    <main class="receptionist-main">

        <div class="notifications-page">


            <div class="notifications-header">

                <div>

                    <div class="breadcrumb">
                        Receptionist / Notifications
                    </div>

                    <h1>
                        Notifications
                    </h1>

                    <p>
                        Stay updated with your clinic activities.
                    </p>

                </div>


                @if($unreadCount > 0)

                    <form
                        action="{{ route('receptionist.notifications.read-all') }}"
                        method="POST"
                        id="markAllReadForm"
                    >

                        @csrf

                        @method('PATCH')

                        <button
                            type="button"
                            class="mark-all-button"
                            id="openMarkAllModal"
                        >

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

                                <path d="M20 6L9 17l-5-5" />

                            </svg>

                            Mark all as read

                        </button>

                    </form>

                @endif

            </div>



            @if(session('success'))

                <div class="alert-message success-message">

                    <div class="alert-icon">

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

                            <path d="M20 6L9 17l-5-5" />

                        </svg>

                    </div>

                    <span>
                        {{ session('success') }}
                    </span>

                </div>

            @endif



            @if(session('error'))

                <div class="alert-message error-message">

                    <div class="alert-icon">

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

                            <circle
                                cx="12"
                                cy="12"
                                r="10"
                            />

                            <line
                                x1="15"
                                y1="9"
                                x2="9"
                                y2="15"
                            />

                            <line
                                x1="9"
                                y1="9"
                                x2="15"
                                y2="15"
                            />

                        </svg>

                    </div>

                    <span>
                        {{ session('error') }}
                    </span>

                </div>

            @endif



            <section class="notifications-card">


                <div class="notifications-card-header">

                    <div>

                        <h2>
                            All Notifications
                        </h2>

                        <p>
                            Appointment updates and clinic activities
                        </p>

                    </div>


                    <div class="notification-summary">

                        <span>
                            {{ $notifications->total() }}
                        </span>

                        Notifications

                    </div>

                </div>



                <div class="notification-list">


                    @forelse($notifications as $notification)

                        @php
                            $data = $notification->data;
                        @endphp


                        <article
                            class="notification-item {{ $notification->read_at ? 'read' : 'unread' }}"
                        >


                            <div class="notification-icon">

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="22"
                                    height="22"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                >

                                    <path
                                        d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9"
                                    />

                                    <path d="M10 21h4" />

                                </svg>

                            </div>



                            <div class="notification-content">

                                <div class="notification-title-row">

                                    <h3>
                                        {{ $data['title'] ?? 'Notification' }}
                                    </h3>


                                    @if(!$notification->read_at)

                                        <span
                                            class="unread-dot"
                                            title="Unread"
                                        ></span>

                                    @endif

                                </div>


                                <p>
                                    {{ $data['message'] ?? 'No message available.' }}
                                </p>


                                <span class="notification-date">

                                    {{ $notification->created_at->format('M d, Y • h:i A') }}

                                </span>

                            </div>



                            <div class="notification-action">


                                @if(!$notification->read_at)

                                    <form
                                        action="{{ route(
                                            'receptionist.notifications.read',
                                            $notification->id
                                        ) }}"
                                        method="POST"
                                        class="mark-read-form"
                                    >

                                        @csrf

                                        @method('PATCH')

                                        <button
                                            type="button"
                                            class="read-button open-mark-read-modal"
                                            data-id="{{ $notification->id }}"
                                        >

                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                width="16"
                                                height="16"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="2"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                            >

                                                <path d="M20 6L9 17l-5-5" />

                                            </svg>

                                            Mark as read

                                        </button>

                                    </form>

                                @else

                                    <span class="read-label">

                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="15"
                                            height="15"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="2"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        >

                                            <path d="M20 6L9 17l-5-5" />

                                        </svg>

                                        Read

                                    </span>

                                @endif



                                <form
                                    action="{{ route(
                                        'receptionist.notifications.destroy',
                                        $notification->id
                                    ) }}"
                                    method="POST"
                                    class="delete-notification-form"
                                >

                                    @csrf

                                    @method('DELETE')

                                    <button
                                        type="button"
                                        class="delete-notification-button open-delete-modal"
                                        title="Delete notification"
                                        data-id="{{ $notification->id }}"
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

                                            <path d="M3 6h18" />
                                            <path d="M8 6V4h8v2" />
                                            <path d="M19 6l-1 14H6L5 6" />
                                            <path d="M10 11v6" />
                                            <path d="M14 11v6" />

                                        </svg>

                                        Delete

                                    </button>

                                </form>

                            </div>

                        </article>


                    @empty


                        <div class="empty-notifications">

                            <div class="empty-icon">

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="44"
                                    height="44"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                >

                                    <path
                                        d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9"
                                    />

                                    <path d="M10 21h4" />

                                </svg>

                            </div>


                            <h3>
                                No notifications
                            </h3>


                            <p>
                                You're all caught up.
                            </p>


                            <span>
                                New appointment updates and clinic activities
                                will appear here.
                            </span>

                        </div>


                    @endforelse

                </div>



                @if($notifications->hasPages())

                    <div class="notification-pagination">

                        {{ $notifications->links() }}

                    </div>

                @endif


            </section>

        </div>

    </main>

</div>



{{-- =========================================
     MARK ALL AS READ MODAL
========================================= --}}

<div
    class="notification-modal-overlay"
    id="markAllModal"
>

    <div class="notification-modal">

        <div class="modal-icon modal-icon-primary">

            <svg
                xmlns="http://www.w3.org/2000/svg"
                width="30"
                height="30"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
            >

                <path d="M20 6L9 17l-5-5" />
                <path d="M4 12l3 3" />

            </svg>

        </div>


        <h3>
            Mark all as read?
        </h3>


        <p>
            All unread notifications will be marked as read.
        </p>


        <div class="modal-actions">

            <button
                type="button"
                class="modal-cancel"
                data-close="markAllModal"
            >
                Cancel
            </button>


            <button
                type="button"
                class="modal-confirm modal-confirm-primary"
                id="confirmMarkAll"
            >
                Mark all as read
            </button>

        </div>

    </div>

</div>



{{-- =========================================
     MARK AS READ MODAL
========================================= --}}

<div
    class="notification-modal-overlay"
    id="markReadModal"
>

    <div class="notification-modal">

        <div class="modal-icon modal-icon-primary">

            <svg
                xmlns="http://www.w3.org/2000/svg"
                width="30"
                height="30"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
            >

                <path d="M20 6L9 17l-5-5" />

            </svg>

        </div>


        <h3>
            Mark as read?
        </h3>


        <p>
            This notification will be marked as read.
        </p>


        <div class="modal-actions">

            <button
                type="button"
                class="modal-cancel"
                data-close="markReadModal"
            >
                Cancel
            </button>


            <button
                type="button"
                class="modal-confirm modal-confirm-primary"
                id="confirmMarkRead"
            >
                Mark as read
            </button>

        </div>

    </div>

</div>



{{-- =========================================
     DELETE NOTIFICATION MODAL
========================================= --}}

<div
    class="notification-modal-overlay"
    id="deleteModal"
>

    <div class="notification-modal">

        <div class="modal-icon modal-icon-danger">

            <svg
                xmlns="http://www.w3.org/2000/svg"
                width="30"
                height="30"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
            >

                <path d="M3 6h18" />
                <path d="M8 6V4h8v2" />
                <path d="M19 6l-1 14H6L5 6" />
                <path d="M10 11v6" />
                <path d="M14 11v6" />

            </svg>

        </div>


        <h3>
            Delete notification?
        </h3>


        <p>
            Are you sure you want to delete this notification?
            This action cannot be undone.
        </p>


        <div class="modal-actions">

            <button
                type="button"
                class="modal-cancel"
                data-close="deleteModal"
            >
                Cancel
            </button>


            <button
                type="button"
                class="modal-confirm modal-confirm-danger"
                id="confirmDelete"
            >
                Yes, delete
            </button>

        </div>

    </div>

</div>

@if(session('success'))
<div
    class="notification-modal-overlay success-modal-overlay active"
    id="successModal"
>
    <div class="notification-modal success-notification-modal">

        <div class="modal-icon success-icon">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                width="32"
                height="32"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2.5"
                stroke-linecap="round"
                stroke-linejoin="round"
            >
                <path d="M20 6L9 17l-5-5"/>
            </svg>
        </div>

        <h3 id="successModalTitle">
            Success!
        </h3>

        <p id="successModalMessage">
            {{ session('success') }}
        </p>

        <div class="modal-actions success-modal-actions">

            <button
                type="button"
                class="modal-confirm success-close-button"
                id="closeSuccessModal"
            >
                Okay
            </button>

        </div>

    </div>
</div>
@endif


<script src="{{ asset('js/receptionist-notifications.js') }}"></script>


</body>

</html>
