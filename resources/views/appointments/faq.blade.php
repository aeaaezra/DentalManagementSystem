<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta  name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}" >

    <title>  FAQ | Shine & Smile Dental Clinic </title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/appointment/faq.css') }}" >
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('css/appointment/patient-theme.css') }}">
    <script src="{{ asset('js/patient-theme.js') }}"></script>


</head>


<body>

    <!-- ========================================================
         PAGE
    ========================================================= -->

    <div class="faq-page">


        <!-- ====================================================
             HEADER
        ===================================================== -->

        <header class="faq-header">

            <div class="faq-header-container">


                <!-- LOGO -->

                <a
                    href="{{ url('/') }}"
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


                <!-- BACK BUTTON -->

                <a
                    href="{{ url()->previous() }}"
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


        <!-- ====================================================
             MAIN
        ===================================================== -->

        <main class="faq-main">


            <!-- =================================================
                 SUCCESS MESSAGE
            ================================================== -->

            @if(session('success'))

                <div class="contact-success">

                    <div class="contact-success-icon">

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


                    <div>

                        <h3>
                            Message Sent
                        </h3>

                        <p>
                            {{ session('success') }}
                        </p>

                    </div>

                </div>

            @endif


            <!-- =================================================
                 ERROR MESSAGE
            ================================================== -->

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


            <!-- =================================================
                 HERO
            ================================================== -->

            <section class="faq-hero">

                <div class="faq-hero-icon">

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
                            d="M8.228 9.247a4.75 4.75 0 017.544 0c.98 1.194.98 2.9 0 4.094-.533.65-1.29 1.159-2.19 1.467-.98.335-1.582 1.255-1.582 2.291V17"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 21h.01"
                        />

                    </svg>

                </div>


                <h1>
                    Frequently Asked Questions
                </h1>


                <p>
                    Find quick answers to common questions about
                    appointments, dental services, payments,
                    and your patient account.
                </p>

            </section>


            <!-- =================================================
                 SEARCH
            ================================================== -->

            <section class="faq-search-container">

                <div class="faq-search-box">

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
                            d="m21 21-4.35-4.35m1.35-5.4a6.75 6.75 0 11-13.5 0 6.75 6.75 0 0113.5 0z"
                        />

                    </svg>


                    <input
                        type="text"
                        id="faqSearch"
                        placeholder="Search a question..."
                        autocomplete="off"
                    >

                </div>

            </section>


            <!-- =================================================
                 CATEGORIES
            ================================================== -->

            <div
                class="faq-categories"
                id="faqCategories"
            >

                <button
                    type="button"
                    class="faq-category active"
                    data-category="all"
                >
                    All
                </button>


                <button
                    type="button"
                    class="faq-category"
                    data-category="appointment"
                >
                    Appointments
                </button>


                <button
                    type="button"
                    class="faq-category"
                    data-category="service"
                >
                    Dental Services
                </button>


                <button
                    type="button"
                    class="faq-category"
                    data-category="payment"
                >
                    Payments
                </button>


                <button
                    type="button"
                    class="faq-category"
                    data-category="account"
                >
                    Account
                </button>

            </div>


            <!-- =================================================
                 FAQ LIST
            ================================================== -->

            <div
                id="faqList"
                class="faq-list"
            >


                <!-- FAQ 01 -->

                <div
                    class="faq-item"
                    data-category="appointment"
                    data-question="How do I book an appointment?"
                >

                    <button
                        type="button"
                        class="faq-question"
                    >

                        <div class="faq-question-content">

                            <div class="faq-number">
                                01
                            </div>

                            <span>
                                How do I book an appointment?
                            </span>

                        </div>


                        <span class="faq-icon">
                            +
                        </span>

                    </button>


                    <div class="faq-answer">

                        <p>
                            Go to the Appointment page, select your
                            preferred dental service, choose an available
                            date and time, complete the required information,
                            and submit your appointment request.
                        </p>

                    </div>

                </div>


                <!-- FAQ 02 -->

                <div
                    class="faq-item"
                    data-category="appointment"
                    data-question="How can I check my appointment status?"
                >

                    <button
                        type="button"
                        class="faq-question"
                    >

                        <div class="faq-question-content">

                            <div class="faq-number">
                                02
                            </div>

                            <span>
                                How can I check my appointment status?
                            </span>

                        </div>


                        <span class="faq-icon">
                            +
                        </span>

                    </button>


                    <div class="faq-answer">

                        <p>
                            Open your Appointment History to view
                            your appointments and their current status.
                        </p>

                    </div>

                </div>


                <!-- FAQ 03 -->

                <div
                    class="faq-item"
                    data-category="appointment"
                    data-question="Can I cancel my appointment?"
                >

                    <button
                        type="button"
                        class="faq-question"
                    >

                        <div class="faq-question-content">

                            <div class="faq-number">
                                03
                            </div>

                            <span>
                                Can I cancel my appointment?
                            </span>

                        </div>


                        <span class="faq-icon">
                            +
                        </span>

                    </button>


                    <div class="faq-answer">

                        <p>
                            If your appointment is eligible for cancellation,
                            you can cancel it through your appointment
                            management options. For assistance, please
                            contact the clinic.
                        </p>

                    </div>

                </div>


                <!-- FAQ 04 -->

                <div
                    class="faq-item"
                    data-category="service"
                    data-question="What dental services are available?"
                >

                    <button
                        type="button"
                        class="faq-question"
                    >

                        <div class="faq-question-content">

                            <div class="faq-number">
                                04
                            </div>

                            <span>
                                What dental services are available?
                            </span>

                        </div>


                        <span class="faq-icon">
                            +
                        </span>

                    </button>


                    <div class="faq-answer">

                        <p>
                            Available dental services can be viewed on
                            the Appointment page. Select a service to see
                            its available details before booking.
                        </p>

                    </div>

                </div>


                <!-- FAQ 05 -->

                <div
                    class="faq-item"
                    data-category="payment"
                    data-question="How do I pay for my appointment?"
                >

                    <button
                        type="button"
                        class="faq-question"
                    >

                        <div class="faq-question-content">

                            <div class="faq-number">
                                05
                            </div>

                            <span>
                                How do I pay for my appointment?
                            </span>

                        </div>


                        <span class="faq-icon">
                            +
                        </span>

                    </button>


                    <div class="faq-answer">

                        <p>
                            Available payment options are shown during
                            the appointment process or can be confirmed
                            with the clinic.
                        </p>

                    </div>

                </div>


                <!-- FAQ 06 -->

                <div
                    class="faq-item"
                    data-category="account"
                    data-question="How do I update my patient information?"
                >

                    <button
                        type="button"
                        class="faq-question"
                    >

                        <div class="faq-question-content">

                            <div class="faq-number">
                                06
                            </div>

                            <span>
                                How do I update my patient information?
                            </span>

                        </div>


                        <span class="faq-icon">
                            +
                        </span>

                    </button>


                    <div class="faq-answer">

                        <p>
                            You can update the information available
                            through your patient profile. If you need
                            assistance changing important patient details,
                            please contact the clinic.
                        </p>

                    </div>

                </div>

            </div>


            <!-- =================================================
                 NO RESULTS
            ================================================== -->

            <div
                id="faqNoResults"
                class="faq-no-results"
            >

                <div class="faq-no-results-icon">

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
                            d="m21 21-4.35-4.35m1.35-5.4a6.75 6.75 0 11-13.5 0 6.75 6.75 0 0113.5 0z"
                        />

                    </svg>

                </div>


                <h3>
                    No questions found
                </h3>


                <p>
                    Try searching for another keyword.
                </p>

            </div>


            <!-- =================================================
                 CONTACT CTA
            ================================================== -->

            <section class="faq-contact">

                <div class="faq-contact-content">

                    <div>

                        <div class="faq-contact-label">

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

                            Need assistance?

                        </div>


                        <h2>
                            Still have questions?
                        </h2>


                        <p>
                            Our clinic team is ready to help you.
                        </p>

                    </div>


                    <a
                        href="{{ url('/contact') }}"
                        class="faq-contact-button"
                    >

                        Contact Us

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
                                d="M17 8l4 4m0 0l-4 4m4-4H3"
                            />

                        </svg>

                    </a>

                </div>

            </section>

        </main>


        <!-- ====================================================
             FOOTER
        ===================================================== -->

        <footer class="faq-footer">

            © {{ date('Y') }} Shine & Smile Dental Clinic.
            All rights reserved.

        </footer>

    </div>


    <!-- FAQ JAVASCRIPT -->

    <script src="{{ asset('js/faq.js') }}"></script>

</body>

</html>
