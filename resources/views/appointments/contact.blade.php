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
        Contact Us | Shine & Smile Dental Clinic
    </title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link
        rel="stylesheet"
        href="{{ asset('css/appointment/contact.css') }}"
    >

    <link
        rel="icon"
        type="image/png"
        href="{{ asset('images/favicon.png') }}"
    >

    <!-- GLOBAL PATIENT THEME -->
    <link
        rel="stylesheet"
        href="{{ asset('css/appointment/patient-theme.css') }}"
    >

    <script
        src="{{ asset('js/patient-theme.js') }}"
    ></script>

</head>
<body>
    <div class="contact-page">
        <header class="contact-header">
            <div class="contact-header-container">

                <a
                    href="{{ route('appointments.homepage') }}"
                    class="clinic-logo"
                >

                    <div class="clinic-logo-icon">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                        >

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 3c-2.5 0-4 2-4 4.5C8 10 6 11 6 14c0 3.5 2.5 6 5 6 1 0 1.5-.5 2-.5s1 .5 2 .5c2.5 0 5-2.5 5-6 0-3-2-4-2-6.5C18 5 16.5 3 14 3c-1 0-1.5.5-2 .5S13 3 12 3z"
                            />

                        </svg>

                    </div>


                    <div>

                        <div class="clinic-name">
                            Shine & Smile
                        </div>

                        <div class="clinic-subtitle">
                            Dental Clinic
                        </div>

                    </div>

                </a>


                <a
                    href="{{ route('appointments.homepage') }}"
                    class="back-button"
                >

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                    >

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M15 19l-7-7 7-7"
                        />

                    </svg>

                    Back

                </a>

            </div>

        </header>

        <main class="contact-main">

            <section class="contact-hero">

                <div class="contact-hero-icon">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                    >

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M21 10.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l2.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 017 3.7 8.48 8.48 0 011 3.8v.5z"
                        />

                    </svg>

                </div>


                <h1>
                    Contact Us
                </h1>


                <p>
                    Have a question or need assistance?
                    We're here to help. Send us a message
                    and our clinic team will get back to you.
                </p>

            </section>

            <section class="contact-grid">

    <div class="contact-information">

                    <div class="section-heading">

                        <span>
                            GET IN TOUCH
                        </span>

                        <h2>
                            We're here to help
                        </h2>

                        <p>
                            You can reach Shine & Smile Dental Clinic
                            through any of the following channels.
                        </p>

                    </div>

                    <div class="contact-info-card">

                        <div class="contact-info-icon">

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                            >

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 21s8-7.2 8-13a8 8 0 10-16 0c0 5.8 8 13 8 13z"
                                />

                                <circle
                                    cx="12"
                                    cy="8"
                                    r="2.5"
                                />

                            </svg>

                        </div>

                        <div>

                            <h3>
                                Clinic Address
                            </h3>

                            <p>
                                Shine & Smile Dental Clinic
                                <br>
                                Your clinic address here
                            </p>

                        </div>

                    </div>

                    <div class="contact-info-card">

                        <div class="contact-info-icon">

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                            >

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6A19.79 19.79 0 012.12 4.18 2 2 0 014.11 2h3a2 2 0 012 1.72c.12.9.33 1.78.62 2.63a2 2 0 01-.45 2.11L8 9.73a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.85.29 1.73.5 2.63.62A2 2 0 0122 16.92z"
                                />

                            </svg>

                        </div>


                        <div>

                            <h3>
                                Phone
                            </h3>

                            <p>
                                +63 XXX XXX XXXX
                            </p>

                        </div>

                    </div>

                    <div class="contact-info-card">

                        <div class="contact-info-icon">

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                            >

                                <rect
                                    x="3"
                                    y="5"
                                    width="18"
                                    height="14"
                                    rx="2"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="m3 7 9 6 9-6"
                                />

                            </svg>

                        </div>

                        <div>

                            <h3>
                                Email
                            </h3>

                            <p>
                                info@shineandsmile.com
                            </p>

                        </div>

                    </div>

                    <div class="contact-info-card">

                        <div class="contact-info-icon">

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                            >

                                <circle
                                    cx="12"
                                    cy="12"
                                    r="9"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 7v5l3 2"
                                />

                            </svg>

                        </div>

                        <div>

                            <h3>
                                Clinic Hours
                            </h3>

                            <p>
                                Monday - Saturday
                                <br>
                                8:00 AM - 5:00 PM
                            </p>

                        </div>

                    </div>


                </div>

                <div class="contact-form-card">

                    <div class="form-heading">

                        <h2>
                            Send us a message
                        </h2>

                        <p>
                            Fill out the form below and we'll
                            get back to you as soon as possible.
                        </p>

                    </div>

                    <form
                        id="contactForm"
                        method="POST"
                        action="{{ route('contact.store') }}"
                    >

                        @csrf

                        <div class="form-group">

                            <label for="name">
                                Full Name
                            </label>

                            <input
                                type="text"
                                id="name"
                                name="name"
                                placeholder="Enter your full name"
                                value="{{ old('name', auth()->user()->name ?? '') }}"
                                maxlength="255"
                                autocomplete="name"
                                required
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
                                placeholder="Enter your email address"
                                value="{{ old('email', auth()->user()->email ?? '') }}"
                                maxlength="255"
                                autocomplete="email"
                                required
                            >

                        </div>

                        <div class="form-group">

                            <label for="subject">
                                Subject
                            </label>

                            <select
                                id="subject"
                                name="subject"
                                required
                            >

                                <option value="">
                                    Select a subject
                                </option>

                                <option
                                    value="appointment"
                                    {{ old('subject') === 'appointment' ? 'selected' : '' }}
                                >
                                    Appointment
                                </option>

                                <option
                                    value="dental_service"
                                    {{ old('subject') === 'dental_service' ? 'selected' : '' }}
                                >
                                    Dental Service
                                </option>

                                <option
                                    value="payment"
                                    {{ old('subject') === 'payment' ? 'selected' : '' }}
                                >
                                    Payment
                                </option>

                                <option
                                    value="patient_record"
                                    {{ old('subject') === 'patient_record' ? 'selected' : '' }}
                                >
                                    Patient Record
                                </option>

                                <option
                                    value="technical"
                                    {{ old('subject') === 'technical' ? 'selected' : '' }}
                                >
                                    Technical Issue
                                </option>

                                <option
                                    value="other"
                                    {{ old('subject') === 'other' ? 'selected' : '' }}
                                >
                                    Other
                                </option>

                            </select>

                        </div>


                        <!-- MESSAGE -->

                        <div class="form-group">

                            <label for="message">
                                Message
                            </label>

                            <textarea
                                id="message"
                                name="message"
                                rows="6"
                                maxlength="1000"
                                placeholder="Write your message here..."
                                required
                            >{{ old('message') }}</textarea>


                            <div
                                id="characterCount"
                                class="character-count"
                            >
                                0 / 1000
                            </div>

                        </div>


                        <!-- VALIDATION ERRORS -->

                        @if($errors->any())

                            <div class="contact-error">

                                <strong>
                                    Please check the following:
                                </strong>

                                <ul>

                                    @foreach($errors->all() as $error)

                                        <li>
                                            {{ $error }}
                                        </li>

                                    @endforeach

                                </ul>

                            </div>

                        @endif


                        <!-- SUBMIT -->

                        <button
                            type="submit"
                            id="contactSubmit"
                            class="contact-submit"
                        >

                            <span id="contactSubmitText">
                                Send Message
                            </span>

                            <svg
                                id="contactSubmitIcon"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                            >

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M22 2L11 13"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M22 2l-7 20-4-9-9-4 20-7z"
                                />

                            </svg>

                        </button>

                    </form>

                </div>

            </section>


            <!-- =================================================
                 MAP / LOCATION
            ================================================== -->

            <section class="location-section">

                <div class="location-heading">

                    <span>
                        FIND US
                    </span>

                    <h2>
                        Visit our clinic
                    </h2>

                    <p>
                        We look forward to welcoming you
                        to Shine & Smile Dental Clinic.
                    </p>

                </div>


                <div class="map-placeholder">

                    <div class="map-content">

                        <div class="map-icon">

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                            >

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 21s8-7.2 8-13a8 8 0 10-16 0c0 5.8 8 13 8 13z"
                                />

                                <circle
                                    cx="12"
                                    cy="8"
                                    r="2.5"
                                />

                            </svg>

                        </div>


                        <h3>
                            Shine & Smile Dental Clinic
                        </h3>


                        <p>
                            Your clinic location
                        </p>


                        <button
                            type="button"
                            id="openMapButton"
                            class="map-button"
                        >

                            Open in Maps

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                            >

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M14 3h7v7"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M10 14L21 3"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M21 14v5a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h5"
                                />

                            </svg>

                        </button>

                    </div>

                </div>

            </section>


            <!-- =================================================
                 EMERGENCY CTA
            ================================================== -->

            <section class="emergency-card">

                <div class="emergency-icon">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                    >

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 9v4"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 17h.01"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M10.3 3.8L2.7 17a2 2 0 001.7 3h15.2a2 2 0 001.7-3L13.7 3.8a2 2 0 00-3.4 0z"
                        />

                    </svg>

                </div>


                <div>

                    <h2>
                        Need urgent dental assistance?
                    </h2>

                    <p>
                        For urgent concerns, please contact
                        the clinic directly by phone.
                    </p>

                </div>


                <a
                    href="tel:+63XXXXXXXXXX"
                    class="emergency-button"
                >

                    Call Clinic

                </a>

            </section>

        </main>


        <!-- =====================================================
             FOOTER
        ====================================================== -->

        <footer class="contact-footer">

            © {{ date('Y') }}
            Shine & Smile Dental Clinic.
            All rights reserved.

        </footer>

    </div>


    <!-- ============================================================
         SUCCESS MODAL
    ============================================================ -->

    <div
        id="successModal"
        class="contact-modal"
        aria-hidden="true"
    >

        <div
            class="contact-modal-overlay"
            id="successModalOverlay"
        ></div>


        <div
            class="contact-modal-card"
            role="dialog"
            aria-modal="true"
            aria-labelledby="successModalTitle"
        >

            <div class="modal-success-icon">

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                >

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M5 13l4 4L19 7"
                    />

                </svg>

            </div>


            <h2 id="successModalTitle">
                Message Sent Successfully!
            </h2>


            <p>
                Thank you for contacting
                <strong>Shine & Smile Dental Clinic</strong>.
                Your message has been received by our clinic team.
            </p>


            <p class="modal-small-text">
                We will review your message and get back to you
                as soon as possible.
            </p>


            <button
                type="button"
                id="closeSuccessModal"
                class="modal-done-button"
            >
                Done
            </button>

        </div>

    </div>


    <!-- ============================================================
         ERROR MODAL
    ============================================================ -->

    <div
        id="errorModal"
        class="contact-modal"
        aria-hidden="true"
    >

        <div
            class="contact-modal-overlay"
            id="errorModalOverlay"
        ></div>


        <div
            class="contact-modal-card"
            role="dialog"
            aria-modal="true"
            aria-labelledby="errorModalTitle"
        >

            <div class="modal-error-icon">

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                >

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 9v4"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 17h.01"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M10.3 3.8L2.7 17a2 2 0 001.7 3h15.2a2 2 0 001.7-3L13.7 3.8a2 2 0 00-3.4 0z"
                    />

                </svg>

            </div>


            <h2 id="errorModalTitle">
                Message Could Not Be Sent
            </h2>


            <p>
                We couldn't send your message right now.
                Please check your connection and try again.
            </p>


            <button
                type="button"
                id="closeErrorModal"
                class="modal-done-button error-button"
            >
                Try Again
            </button>

        </div>

    </div>


    <script src="{{ asset('js/contact.js') }}"></script>

</body>

</html>
