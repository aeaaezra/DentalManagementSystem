<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Appointment Confirmed | Shine & Smile</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('css/appointment/patient-theme.css') }}">
    <script src="{{ asset('js/patient-theme.js') }}"></script>


    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: Inter, sans-serif;
            color: #172033;
            background: linear-gradient(135deg, #fff7fb, #ffeaf4, #fff8fb);
            min-height: 100vh;
        }

        .page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px 15px;
        }

        .card {
            width: 100%;
            max-width: 760px;
            background: #fff;
            border: 1px solid #f8d8e8;
            border-radius: 28px;
            padding: 50px;
            text-align: center;
            box-shadow: 0 20px 60px rgba(225, 29, 116, .10);
        }

        .success-wrapper {
            position: relative;
            width: 105px;
            height: 105px;
            margin: 0 auto 28px;
        }

        .success-icon {
            width: 105px;
            height: 105px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(145deg, #f95a91, #ed2777);
            color: #fff;
            font-size: 52px;
            font-weight: 700;
            box-shadow: 0 15px 30px rgba(236,72,153,.25);
        }

        .calendar-badge {
            position: absolute;
            right: -5px;
            bottom: -4px;
            width: 42px;
            height: 42px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
            color: #df277b;
            font-size: 19px;
            box-shadow: 0 5px 15px rgba(0,0,0,.12);
        }

        h1 {
            margin: 0 0 15px;
            color: #101827;
            font-size: 44px;
            line-height: 1.2;
            font-weight: 800;
        }

        .message {
            max-width: 620px;
            margin: 0 auto;
            color: #596579;
            font-size: 18px;
            line-height: 1.6;
        }

        .appointment-info {
            margin-top: 38px;
            padding: 28px;
            background: linear-gradient(135deg, #fff7fa, #fff1f7);
            border: 1px solid #f8dbe9;
            border-radius: 20px;
            text-align: left;
        }

        .confirmation-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding-bottom: 20px;
            border-bottom: 1px solid #f4c9dc;
        }

        .confirmation-label {
            color: #df277b;
            font-size: 14px;
            font-weight: 800;
            letter-spacing: .5px;
        }

        .confirmation-code {
            padding: 9px 14px;
            background: #fff;
            border: 1px solid #f3d8e5;
            border-radius: 10px;
            color: #172033;
            font-size: 15px;
            font-weight: 700;
        }

        .details {
            display: flex;
            flex-direction: column;
            gap: 20px;
            padding-top: 22px;
        }

        .detail {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .detail-icon {
            width: 43px;
            height: 43px;
            flex-shrink: 0;
            border-radius: 13px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fde4f0;
            color: #df277b;
            font-size: 18px;
        }

        .detail-text {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .detail-label {
            color: #697386;
            font-size: 13px;
            font-weight: 500;
        }

        .detail-value {
            color: #172033;
            font-size: 15px;
            font-weight: 600;
        }

        .status {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-top: 25px;
            padding: 9px 15px;
            border-radius: 999px;
            background: #fff7ed;
            color: #c2410c;
            font-size: 13px;
            font-weight: 600;
        }

        .status-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #f97316;
        }

        .buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 32px;
        }

        .button {
            min-width: 190px;
            border: none;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            padding: 14px 22px;
            border-radius: 11px;
            font-family: inherit;
            font-size: 14px;
            font-weight: 600;
            transition: .2s ease;
        }

        .calendar-button {
            color: #fff;
            background: linear-gradient(135deg, #ec277b, #df1670);
            box-shadow: 0 10px 25px rgba(236,39,123,.22);
        }

        .calendar-button:hover,
        .print-button:hover {
            transform: translateY(-2px);
        }

        .print-button {
            color: #475569;
            background: #fff;
            border: 1px solid #dce1e8;
        }

        .history-button {
            display: inline-block;
            margin-top: 20px;
            color: #df277b;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
        }

        .history-button:hover { text-decoration: underline; }

        @media (max-width: 600px) {
            .card { padding: 40px 20px; border-radius: 20px; }
            h1 { font-size: 32px; }
            .message { font-size: 15px; }
            .appointment-info { padding: 20px; }
            .confirmation-header { flex-direction: column; align-items: flex-start; }
            .buttons { flex-direction: column; }
            .button { width: 100%; min-width: 0; }
        }

        @media print {
            body { background: #fff; }
            .page { padding: 0; }
            .card { max-width: 100%; border: none; box-shadow: none; }
            .buttons, .history-button, .status { display: none; }
        }
    </style>
</head>

<body>

<div class="page">
    <main class="card">

        <div class="success-wrapper">
            <div class="success-icon">✓</div>
            <div class="calendar-badge">📅</div>
        </div>

        <h1>You're All Set! 🎉</h1>

        <p class="message">
            Thank you for booking your appointment with us.
            Your appointment has been successfully submitted.
        </p>

        <section class="appointment-info">

            <div class="confirmation-header">
                <div class="confirmation-label">CONFIRMATION CODE</div>
                <div class="confirmation-code">
                    SC-{{ str_pad($appointment->id, 5, '0', STR_PAD_LEFT) }}
                </div>
            </div>

            <div class="details">

                <div class="detail">
                    <div class="detail-icon">📅</div>
                    <div class="detail-text">
                        <span class="detail-label">Date &amp; Time</span>
                        <strong class="detail-value">
                            {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('l, F d, Y') }}
                            at
                            {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}
                        </strong>
                    </div>
                </div>

                <div class="detail">
                    <div class="detail-icon">🦷</div>
                    <div class="detail-text">
                        <span class="detail-label">Service</span>
                        <strong class="detail-value">
                            {{ $appointment->service->service_name ?? 'Dental Service' }}
                        </strong>
                    </div>
                </div>

                <div class="detail">
                    <div class="detail-icon">👨‍⚕️</div>
                    <div class="detail-text">
                        <span class="detail-label">Practitioner</span>
                        <strong class="detail-value">
                            {{ $appointment->doctor_name ?? 'Dental Practitioner' }}
                        </strong>
                    </div>
                </div>

                <div class="detail">
                    <div class="detail-icon">📍</div>
                    <div class="detail-text">
                        <span class="detail-label">Location</span>
                        <strong class="detail-value">Shine &amp; Smile Dental Clinic</strong>
                    </div>
                </div>

            </div>
        </section>

        <div class="status">
            <span class="status-dot"></span>
            Appointment Pending Confirmation
        </div>

        <div class="buttons">
            <button type="button" class="button calendar-button" id="addCalendar">

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
        aria-hidden="true"
    >
        <rect x="3" y="4" width="18" height="18" rx="2"></rect>

        <line x1="16" y1="2" x2="16" y2="6"></line>

        <line x1="8" y1="2" x2="8" y2="6"></line>

        <line x1="3" y1="10" x2="21" y2="10"></line>

        <line x1="12" y1="14" x2="12" y2="18"></line>

        <line x1="10" y1="16" x2="14" y2="16"></line>
    </svg>

    <span>Add to Calendar</span>

</button>

            <button
    type="button"
    class="button print-button"
    onclick="window.print()"
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
        aria-hidden="true"
    >
        <polyline points="6 9 6 2 18 2 18 9"></polyline>

        <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path>

        <rect
            x="6"
            y="14"
            width="12"
            height="8"
        ></rect>
    </svg>

    <span>Print Summary</span>
</button>

        </div>

        <a href="{{ route('appointments.history') }}" class="history-button">
            View Appointment History →
        </a>

    </main>
</div>

<script>
document.getElementById('addCalendar')?.addEventListener('click', function () {
    const date = "{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('Ymd') }}";
    const start = "{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('His') }}";
    const end = "{{ \Carbon\Carbon::parse($appointment->appointment_time)->addHour()->format('His') }}";

    const title = 'Dental Appointment - Shine & Smile';
    const details = 'Dental appointment at Shine & Smile Dental Clinic.';
    const location = 'Shine & Smile Dental Clinic';

    const url =
        'https://calendar.google.com/calendar/render' +
        '?action=TEMPLATE' +
        '&text=' + encodeURIComponent(title) +
        '&dates=' + date + 'T' + start + '/' + date + 'T' + end +
        '&details=' + encodeURIComponent(details) +
        '&location=' + encodeURIComponent(location);

    window.open(url, '_blank', 'noopener,noreferrer');
});
</script>

</body>
</html>
