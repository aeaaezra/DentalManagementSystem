
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Terms &amp; Conditions | Shine &amp; Smile Dental</title>

    <meta name="description" content="Read the terms and conditions for using the Shine & Smile Dental Management System and online appointment services.">

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600;9..144,700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">

    <style>
        .ss-legal {
            min-height: 70vh;
            padding: 150px 0 90px;
            background: var(--c-void, #101010);
            color: var(--c-porcelain, #f7f4f0);
        }

        .ss-legal-header {
            max-width: 820px;
            margin: 0 auto 42px;
            text-align: center;
        }

        .ss-legal-eyebrow {
            display: inline-block;
            margin-bottom: 16px;
            color: var(--c-silver-dim, #aaa);
            font-size: .75rem;
            font-weight: 700;
            letter-spacing: .18em;
            text-transform: uppercase;
        }

        .ss-legal-title {
            margin: 0 0 18px;
            font-family: 'Fraunces', serif;
            font-size: clamp(2.3rem, 5vw, 4rem);
            font-weight: 600;
            line-height: 1.12;
        }

        .ss-legal-intro {
            color: var(--c-silver-dim, #aaa);
            font-size: 1rem;
            line-height: 1.9;
        }

        .ss-legal-card {
            max-width: 900px;
            margin: 0 auto;
            padding: clamp(24px, 5vw, 52px);
            border: 1px solid rgba(255, 255, 255, .12);
            border-radius: 18px;
            background: rgba(255, 255, 255, .035);
        }

        .ss-legal-section + .ss-legal-section {
            margin-top: 34px;
            padding-top: 28px;
            border-top: 1px solid rgba(255, 255, 255, .10);
        }

        .ss-legal-section h2 {
            margin: 0 0 13px;
            color: var(--c-porcelain, #f7f4f0);
            font-family: 'Fraunces', serif;
            font-size: 1.45rem;
            font-weight: 600;
        }

        .ss-legal-section p,
        .ss-legal-section li {
            color: var(--c-silver-dim, #c2c2c2);
            font-size: .96rem;
            line-height: 1.9;
        }

        .ss-legal-section p {
            margin: 0 0 12px;
        }

        .ss-legal-section ul {
            margin: 12px 0 0;
            padding-left: 24px;
            list-style: disc;
        }

        .ss-legal-section li {
            margin-bottom: 8px;
        }

        .ss-legal-section a {
            color: var(--c-porcelain, #f7f4f0);
            text-decoration: underline;
            text-underline-offset: 4px;
        }

        .ss-legal-actions {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 12px;
            margin-top: 32px;
        }

        @media (max-width: 600px) {
            .ss-legal {
                padding-top: 120px;
            }
        }
    </style>
</head>

<body class="ss-body">

<nav id="ssNav" class="ss-nav">
    <div class="ss-container ss-nav-row">
        <a href="{{ url('/') }}" class="ss-nav-logo">Shine &amp; Smile</a>

        <div class="ss-nav-links">
            <a href="{{ url('/') }}">Home</a>
            <a href="{{ url('/#about') }}">About</a>
            <a href="{{ url('/#services') }}">Services</a>
            <a href="{{ url('/#contact') }}">Contact</a>
        </div>

        <div class="ss-nav-actions">
            <a href="{{ route('appointments.login') }}" class="ss-btn ss-btn--ghost ss-btn--sm">Login</a>
            <a href="{{ route('appointments.create') }}" class="ss-btn ss-btn--solid ss-btn--sm">Book Appointment</a>
        </div>
    </div>
</nav>

<main class="ss-legal">
    <div class="ss-container">

        <header class="ss-legal-header">
            <span class="ss-legal-eyebrow">Shine &amp; Smile Dental Clinic</span>
            <h1 class="ss-legal-title">Terms &amp; Conditions</h1>
            <p class="ss-legal-intro">
                Please read these terms before using our website, account features,
                or online appointment services.
            </p>
        </header>

        <article class="ss-legal-card">

            <section class="ss-legal-section">
                <h2>1. Acceptance of These Terms</h2>
                <p>
                    By accessing or using the Shine &amp; Smile Dental Management System,
                    you agree to comply with these Terms &amp; Conditions. If you do not
                    agree, please discontinue use of the online services.
                </p>
                <p>
                    These terms govern use of the website and its online features.
                    Specific treatment arrangements may also be subject to separate
                    explanations, consent forms, or agreements provided by the clinic.
                </p>
            </section>

            <section class="ss-legal-section">
                <h2>2. Online Accounts</h2>
                <p>
                    Some features may require you to create or access an account.
                    You are responsible for providing accurate information and taking
                    reasonable steps to protect your login credentials.
                </p>
                <ul>
                    <li>Provide information that is accurate and up to date.</li>
                    <li>Keep your password confidential.</li>
                    <li>Notify the clinic if you believe someone has accessed your account without permission.</li>
                    <li>Do not use another person's account without authorization.</li>
                </ul>
            </section>

            <section class="ss-legal-section">
                <h2>3. Appointment Requests</h2>
                <p>
                    Submitting an online appointment request does not, by itself,
                    guarantee that the requested date or time is available. Please
                    check the appointment status or wait for confirmation from the clinic.
                </p>
                <p>
                    You should provide accurate contact details and arrive at the
                    confirmed appointment time. If you need to change or cancel an
                    appointment, use the available appointment features or contact
                    the clinic directly.
                </p>
                <p>
                    Any applicable cancellation deadlines, missed-appointment rules,
                    or fees should be communicated by the clinic before they apply.
                </p>
            </section>

            <section class="ss-legal-section">
                <h2>4. Dental Care and Medical Information</h2>
                <p>
                    Website content and online account features are provided for
                    administrative and informational purposes. They do not replace
                    a dental examination, diagnosis, treatment plan, or professional
                    advice from a qualified dental practitioner.
                </p>
                <p>
                    Provide relevant and accurate information to your dental care
                    provider. If you have an urgent dental or medical concern, contact
                    an appropriate healthcare professional rather than relying solely
                    on website messages or appointment requests.
                </p>
            </section>

            <section class="ss-legal-section">
                <h2>5. Fees and Payments</h2>
                <p>
                    Treatment fees, payment arrangements, and any applicable charges
                    should be explained by the clinic before the relevant service or
                    transaction. Please confirm the amount and accepted payment methods
                    directly with the clinic.
                </p>
                <p>
                    This page does not establish a specific refund policy, cancellation
                    fee, deposit requirement, or payment deadline. Any such policy
                    must be communicated separately by the clinic.
                </p>
            </section>

            <section class="ss-legal-section">
                <h2>6. Acceptable Use</h2>
                <p>You agree not to:</p>
                <ul>
                    <li>Use the website for unlawful, fraudulent, or misleading purposes.</li>
                    <li>Attempt to access accounts, records, or systems without authorization.</li>
                    <li>Interfere with the operation, security, or availability of the website.</li>
                    <li>Submit malicious code or information intended to disrupt the service.</li>
                    <li>Misuse another person's personal information.</li>
                </ul>
            </section>

            <section class="ss-legal-section">
                <h2>7. Privacy and Personal Information</h2>
                <p>
                    Personal information submitted through the website may be used
                    for purposes related to account administration, appointment
                    coordination, and clinic services, subject to applicable law and
                    the clinic's actual privacy practices.
                </p>
                <p>
                    Please read our
                    <a href="{{ route('privacy.policy') }}">Privacy Policy</a>
                    to understand how personal information is handled. Contact the
                    clinic if you have questions about the information you provide.
                </p>
            </section>

            <section class="ss-legal-section">
                <h2>8. Website Availability and Content</h2>
                <p>
                    We aim to keep the website useful and available, but uninterrupted
                    access cannot be guaranteed. Features may occasionally be unavailable
                    for maintenance, security, or technical reasons.
                </p>
                <p>
                    Website content may be updated when needed. Information displayed
                    online should not be treated as a substitute for direct confirmation
                    of appointment availability, treatment details, or fees.
                </p>
            </section>

            <section class="ss-legal-section">
                <h2>9. Limitation and Applicable Law</h2>
                <p>
                    Nothing in these terms is intended to exclude rights or remedies
                    that cannot legally be excluded under applicable law. Questions
                    concerning these terms should be raised with the clinic so they
                    can be reviewed and addressed appropriately.
                </p>
                <p>
                    These terms should be reviewed by the clinic to ensure that they
                    accurately reflect its operations and comply with applicable laws
                    of the Philippines.
                </p>
            </section>

            <section class="ss-legal-section">
                <h2>10. Updates and Contact</h2>
                <p>
                    These terms may be revised when the website or clinic procedures
                    change. The updated version will be published on this page.
                    Please review it periodically.
                </p>
                <p>
                    For questions about these terms, please contact Shine &amp; Smile
                    Dental Clinic using the clinic's verified contact details published
                    on its official website or provided directly by clinic staff.
                </p>
            </section>

<div class="ss-legal-actions">
    <a href="{{ route('appointments.landing') }}"
       class="ss-btn ss-btn--ghost">
        Back to Home
    </a>

    <a href="{{ route('appointments.landing') }}"
       class="ss-btn ss-btn--solid">
        Book an Appointment
    </a>

</div>
        </article>
    </div>
</main>

<footer class="ss-footer">
    <div class="ss-container">
        <div class="ss-footer-grid">

            <div class="ss-footer-brand-column">
                <div class="ss-footer-brand">Shine &amp; Smile</div>
                <p>Dental Management System</p>
            </div>

            <div class="ss-footer-column">
                <h4>QUICK LINKS</h4>
                <ul>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="{{ url('/#about') }}">About</a></li>
                    <li><a href="{{ url('/#services') }}">Services</a></li>
                    <li><a href="{{ url('/#contact') }}">Contact</a></li>
                </ul>
            </div>

            <div class="ss-footer-column">
                <h4>ACCOUNT</h4>
                <ul>
                    <li><a href="{{ route('appointments.login') }}">Login</a></li>
                    <li><a href="{{ route('appointments.create') }}">Book Appointment</a></li>
                </ul>
            </div>

            <div class="ss-footer-column">
                <h4>LEGAL</h4>
                <ul>
                    <li><a href="{{ route('privacy.policy') }}">Privacy Policy</a></li>
                    <li><a href="{{ route('terms.conditions') }}" aria-current="page">Terms &amp; Conditions</a></li>
                </ul>
            </div>

        </div>

        <div class="ss-footer-bottom">
            &copy; {{ date('Y') }} Shine &amp; Smile Dental Management System. All Rights Reserved.
        </div>
    </div>
</footer>

</body>
</html>
