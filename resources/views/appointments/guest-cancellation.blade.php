<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#ffffff">

    <title>Manage Your Appointment | Shine & Smile Dental</title>

    <style>
        :root {
            --pink: #d92d78;
            --pink-dark: #b91c60;
            --pink-light: #fff1f6;
            --pink-border: #f5c4d8;
            --text: #263244;
            --muted: #667085;
            --border: #e4e7ec;
            --white: #ffffff;
            --danger: #b42318;
            --success: #067647;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 40px 20px;
            background: #faf8fa;
            color: var(--text);
            font-family: Arial, Helvetica, sans-serif;
            font-size: 15px;
            line-height: 1.6;
        }

        .page {
            width: 100%;
            max-width: 760px;
            margin: 0 auto;
        }

        .brand {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 28px;
            text-align: center;
        }

        .brand img {
            display: block;
            width: 100%;
            max-width: 310px;
            max-height: 105px;
            object-fit: contain;
        }

        .brand-fallback {
            color: var(--pink);
            font-size: 25px;
            font-weight: 700;
            letter-spacing: -0.6px;
        }

        .brand-fallback span {
            display: block;
            color: var(--muted);
            font-size: 11px;
            font-weight: 500;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .card {
            padding: 36px;
            background: var(--white);
            border: 1px solid #f0e8ed;
            border-radius: 14px;
            box-shadow: 0 8px 30px rgba(45, 25, 38, 0.05);
        }

        h1 {
            margin: 0 0 10px;
            color: var(--pink-dark);
            font-size: clamp(25px, 4vw, 32px);
            font-weight: 700;
            line-height: 1.25;
            letter-spacing: -0.7px;
        }

        .intro {
            margin: 0 0 24px;
            color: #596579;
        }

        .details {
            margin: 24px 0 26px;
            padding: 20px 22px;
            background: #fff7fa;
            border: 1px solid #f9e1eb;
            border-radius: 10px;
        }

        .detail-row {
            display: grid;
            grid-template-columns: minmax(145px, 190px) 1fr;
            gap: 12px;
            padding: 5px 0;
        }

        .detail-label {
            color: #344054;
            font-weight: 700;
        }

        .detail-value {
            overflow-wrap: anywhere;
        }

        .status {
            color: var(--success);
            font-weight: 600;
            text-transform: capitalize;
        }

        .field {
            margin-bottom: 21px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #344054;
            font-size: 14px;
            font-weight: 700;
        }

        .required {
            color: var(--pink);
        }

        select,
        textarea,
        input[type="date"] {
            display: block;
            width: 100%;
            padding: 13px 14px;
            border: 1px solid #d0d5dd;
            border-radius: 8px;
            background-color: #fff;
            color: #202939;
            font: inherit;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        select {
            min-height: 48px;
        }

        textarea {
            min-height: 120px;
            resize: vertical;
        }

        select:focus,
        textarea:focus,
        input[type="date"]:focus {
            outline: none;
            border-color: var(--pink);
            box-shadow: 0 0 0 3px rgba(217, 45, 120, 0.12);
        }

        .submit-button {
            display: block;
            width: 100%;
            min-height: 50px;
            margin-top: 26px;
            padding: 13px 20px;
            border: 1px solid var(--pink);
            border-radius: 8px;
            background: var(--pink);
            color: #fff;
            font: inherit;
            font-weight: 700;
            cursor: pointer;
            transition: background-color 0.2s, transform 0.2s;
        }

        .section-title {
            margin: 30px 0 8px;
            color: var(--pink-dark);
            font-size: 21px;
        }

        .section-intro {
            margin: 0 0 20px;
            color: var(--muted);
        }

        .secondary-card {
            margin-top: 28px;
            padding-top: 24px;
            border-top: 1px solid var(--border);
        }

        .action-choices {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
            margin: 26px 0;
        }

        .action-choice {
            display: flex;
            align-items: center;
            gap: 13px;
            width: 100%;
            min-height: 88px;
            padding: 17px;
            text-align: left;
            border: 1px solid #f0b5cf;
            border-radius: 10px;
            background: #fff;
            color: #344054;
            font: inherit;
            cursor: pointer;
            transition: border-color .2s, background-color .2s, box-shadow .2s;
        }

        .action-choice:hover,
        .action-choice:focus-visible {
            border-color: var(--pink);
            box-shadow: 0 0 0 3px rgba(217, 45, 120, .10);
            outline: none;
        }

        .action-choice[aria-expanded="true"] {
            border-color: var(--pink);
            background: #fff5f9;
            box-shadow: 0 0 0 2px rgba(217, 45, 120, .10);
        }

        .action-choice .action-icon {
            display: grid;
            flex: 0 0 42px;
            width: 42px;
            height: 42px;
            place-items: center;
            border-radius: 50%;
            background: #fce7f1;
            color: var(--pink-dark);
            font-size: 27px;
            font-weight: 700;
        }

        .action-choice strong,
        .action-choice small {
            display: block;
        }

        .action-choice strong {
            margin-bottom: 5px;
            color: var(--pink-dark);
        }

        .action-choice small {
            color: var(--muted);
            font-size: 13px;
            line-height: 1.45;
        }

        .action-panel {
            margin-top: 24px;
        }

        .action-panel[hidden] {
            display: none !important;
        }

        .time-slot-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 10px 12px;
            margin-top: 4px;
        }

        .time-slot-button {
            min-height: 50px;
            padding: 12px 10px;
            border: 1px solid #198754;
            border-radius: 8px;
            background: #198754;
            color: #fff;
            font: inherit;
            font-weight: 700;
            cursor: pointer;
            transition: background-color .15s, box-shadow .15s;
        }

        .time-slot-button:hover {
            background: #157347;
        }
.time-slot-button:disabled {
    background: #e9ecef;
    border-color: #ced4da;
    color: #6c757d;
    cursor: not-allowed;
    opacity: 1;
    box-shadow: none;
}

.time-slot-button:disabled:hover {
    background: #e9ecef;
}
        .time-slot-button[aria-pressed="true"] {
            background: #0f5132;
            border-color: #0f5132;
            box-shadow: 0 0 0 3px rgba(25, 135, 84, .22);
        }

        .time-slot-button:focus-visible {
            outline: 3px solid rgba(25, 135, 84, .28);
            outline-offset: 2px;
        }

        .slot-placeholder {
            grid-column: 1 / -1;
            margin: 0;
            padding: 12px 0;
            color: var(--muted);
            font-size: 14px;
        }

        @media (max-width: 600px) {
            .action-choices {
                grid-template-columns: 1fr;
            }

            .time-slot-grid {
                gap: 8px;
            }
        }

        .field-hint {
            display: block;
            margin-top: 6px;
            color: var(--muted);
            font-size: 13px;
        }

        .submit-button:disabled {
            opacity: 0.55;
            cursor: not-allowed;
        }

        .submit-button:hover {
            background: var(--pink-dark);
        }

        .submit-button:focus-visible {
            outline: 3px solid rgba(217, 45, 120, 0.25);
            outline-offset: 3px;
        }

        .security-note {
            margin: 20px 0 0;
            color: var(--muted);
            font-size: 13px;
            text-align: center;
        }

        .error-box {
            margin: 18px 0;
            padding: 14px 18px;
            border: 1px solid #fecdca;
            border-radius: 8px;
            background: #fef3f2;
            color: var(--danger);
        }

        .error-box ul {
            margin: 0;
            padding-left: 20px;
        }

        .success-box {
            padding: 20px;
            border: 1px solid #abefc6;
            border-radius: 9px;
            background: #ecfdf3;
            color: #05603a;
        }

        .success-box strong {
            display: block;
            margin-bottom: 5px;
            font-size: 17px;
        }

        @media (max-width: 600px) {
            body {
                padding: 24px 14px;
            }

            .brand {
                margin-bottom: 20px;
            }

            .brand img {
                max-width: 250px;
                max-height: 85px;
            }

            .card {
                padding: 24px 19px;
                border-radius: 11px;
            }

            .details {
                padding: 15px;
            }

            .detail-row {
                grid-template-columns: 1fr;
                gap: 0;
                padding: 7px 0;
            }

            .detail-label {
                font-size: 13px;
            }
        }
    </style>
</head>
<body>
<div class="page">

    <header class="brand">
        <img
            src="{{ asset('images/shine-and-smile-logo.png') }}"
            alt="Shine & Smile Dental Management System"
            onerror="this.style.display='none'; document.getElementById('brand-fallback').hidden=false;"
        >

        <div id="brand-fallback" class="brand-fallback" hidden>
            Shine &amp; Smile
            <span>Dental Management System</span>
        </div>
    </header>

    <main class="card">
        <h1>Manage Your Appointment</h1>

        @if (!empty($requestPending))
            <div class="success-box" role="status">
                <strong>Request awaiting clinic review</strong>
                Your appointment currently has a pending
                {{ $appointment->status === 'reschedule_requested' ? 'rescheduling' : 'cancellation' }}
                request. Your original appointment details have not been changed
                by this page. Please wait for the clinic's decision by email.
            </div>
        @elseif (!empty($submitted))
            <div class="success-box" role="status">
                <strong>Cancellation request submitted</strong>
                Your appointment has not been cancelled yet. The clinic will
                review your request and email you its decision.
            </div>
        @elseif (!empty($rescheduleSubmitted))
            <div class="success-box" role="status">
                <strong>Rescheduling request submitted</strong>
                Your original appointment remains unchanged while the clinic
                reviews your proposed date and time. You will be notified by email.
            </div>
        @else
            <p class="intro">
                Review your booking below. You can request a different schedule
                or submit a cancellation request. Neither request is final until
                the clinic reviews it.
            </p>

            <section class="details" aria-label="Appointment details">
                <div class="detail-row">
                    <span class="detail-label">Appointment date</span>
                    <span class="detail-value">
                        {{ $appointment->appointment_date?->format('F d, Y') ?? $appointment->appointment_date ?? 'Not specified' }}
                    </span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Appointment time</span>
                    <span class="detail-value">
                        {{ $appointment->appointment_time ?? 'Not specified' }}
                    </span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Status</span>
                    <span class="detail-value status">
                        {{ str_replace('_', ' ', ucfirst($appointment->status)) }}
                    </span>
                </div>
            </section>

            @if ($errors->any())
                <div class="error-box" role="alert">
                    <strong>Please correct the following:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="action-choices" aria-label="Choose an appointment action">
                <button type="button" class="action-choice" id="choose-reschedule"
                        aria-controls="reschedule-panel" aria-expanded="false">
                    <span class="action-icon">↻</span>
                    <span>
                        <strong>Reschedule Appointment</strong>
                        <small>Choose a new date and available time.</small>
                    </span>
                </button>

                <button type="button" class="action-choice cancellation-choice"
                        id="choose-cancellation"
                        aria-controls="cancellation-panel" aria-expanded="false">
                    <span class="action-icon">×</span>
                    <span>
                        <strong>Request Cancellation</strong>
                        <small>Request to cancel your appointment.</small>
                    </span>
                </button>
            </div>

            <section id="reschedule-panel"
                     class="action-panel"
                     aria-labelledby="reschedule-heading"
                     hidden>
                <h2 class="section-title" id="reschedule-heading">Request a Reschedule</h2>
                <p class="section-intro">
                    Choose a new date to check the clinic's available appointment times.
                </p>

                <form id="reschedule-form" method="POST"
                      action="{{ $rescheduleSubmitUrl }}">
                    @csrf

                    <div class="field">
                        <label for="reschedule_date">
                            Preferred new date <span class="required">*</span>
                        </label>
                        <input
                            id="reschedule_date"
                            name="reschedule_date"
                            type="date"
                            min="{{ now()->toDateString() }}"
                            value="{{ old('reschedule_date') }}"
                            required
                        >
                    </div>

                    <div class="field">
                        <label>Available appointment times <span class="required">*</span></label>
                        <input type="hidden" id="reschedule_time" name="reschedule_time"
                               value="{{ old('reschedule_time') }}" required>
                        <div id="reschedule-time-slots" class="time-slot-grid"
                             aria-label="Available appointment times">
                            <p class="slot-placeholder">Choose a date to see available times.</p>
                        </div>
                        <span id="slot-message" class="field-hint" role="status" aria-live="polite">
                            Select a date to check availability.
                        </span>
                    </div>

                    <div class="field">
                        <label for="reschedule_reason">Reason for rescheduling (optional)</label>
                        <textarea
                            id="reschedule_reason"
                            name="reschedule_reason"
                            maxlength="1000"
                            placeholder="Tell us why you need to change your appointment (optional)"
                        >{{ old('reschedule_reason') }}</textarea>
                    </div>

                    <button id="reschedule-submit" class="submit-button" type="submit" disabled>
                        Submit Rescheduling Request
                    </button>
                </form>
            </section>

            <section id="cancellation-panel"
                     class="action-panel"
                     aria-labelledby="cancellation-heading"
                     hidden>
                <h2 class="section-title" id="cancellation-heading">Request Cancellation</h2>
                <p class="section-intro">
                    If you no longer need the appointment, submit a cancellation request.
                </p>

                <form method="POST" action="{{ url()->full() }}">
                    @csrf

                    <div class="field">
                        <label for="cancellation_reason">
                            Reason for cancellation <span class="required">*</span>
                        </label>
                        <select id="cancellation_reason" name="cancellation_reason" required>
                            <option value="">Select a reason</option>
                            @foreach ([
                                'Schedule conflict',
                                'Illness or medical concern',
                                'Transportation problem',
                                'Financial reasons',
                                'Other'
                            ] as $reason)
                                <option value="{{ $reason }}"
                                    @selected(old('cancellation_reason') === $reason)
                                >{{ $reason }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="field">
                        <label for="cancellation_details">Additional details (optional)</label>
                        <textarea
                            id="cancellation_details"
                            name="cancellation_details"
                            maxlength="1000"
                            placeholder="Provide any additional information (optional)"
                        >{{ old('cancellation_details') }}</textarea>
                    </div>

                    <button class="submit-button" type="submit">
                        Submit Cancellation Request
                    </button>
                </form>
            </section>

            <p class="security-note">
                For your security, this link expires. If it has expired,
                contact the clinic for assistance.
            </p>
        @endif
    </main>
</div>

@if (empty($submitted) && empty($rescheduleSubmitted) && empty($requestPending))
<script>
(() => {
    const rescheduleChoice = document.getElementById('choose-reschedule');
    const cancellationChoice = document.getElementById('choose-cancellation');
    const reschedulePanel = document.getElementById('reschedule-panel');
    const cancellationPanel = document.getElementById('cancellation-panel');

    const dateInput = document.getElementById('reschedule_date');
    const timeInput = document.getElementById('reschedule_time');
    const slotsContainer = document.getElementById('reschedule-time-slots');
    const submitButton = document.getElementById('reschedule-submit');
    const message = document.getElementById('slot-message');
    const rescheduleForm = document.getElementById('reschedule-form');

    if (!rescheduleChoice || !cancellationChoice || !reschedulePanel ||
        !cancellationPanel || !dateInput || !timeInput ||
        !slotsContainer || !submitButton || !message || !rescheduleForm) {
        return;
    }

    const slotsUrl = @json($rescheduleSlotsUrl);
    const oldTime = @json(old('reschedule_time'));
    const showRescheduleInitially = @json(
        old('reschedule_date') || old('reschedule_time')
    );
    const showCancellationInitially = @json(old('cancellation_reason'));
    let requestNumber = 0;

    function chooseAction(action) {
        const showReschedule = action === 'reschedule';

        reschedulePanel.hidden = !showReschedule;
        cancellationPanel.hidden = showReschedule;

        rescheduleChoice.setAttribute('aria-expanded', String(showReschedule));
        cancellationChoice.setAttribute('aria-expanded', String(!showReschedule));
    }

    rescheduleChoice.addEventListener('click', () => {
        chooseAction('reschedule');
        if (dateInput.value && slotsContainer.querySelector('.slot-placeholder')) {
            loadSlots();
        }
    });

    cancellationChoice.addEventListener('click', () => {
        chooseAction('cancellation');
    });

    function showPlaceholder(text) {
        slotsContainer.replaceChildren();
        const placeholder = document.createElement('p');
        placeholder.className = 'slot-placeholder';
        placeholder.textContent = text;
        slotsContainer.appendChild(placeholder);
    }

    function resetSlots(text) {
        timeInput.value = '';
        submitButton.disabled = true;
        showPlaceholder(text);
    }

function renderSlots(slots) {
    slotsContainer.replaceChildren();

    slots.forEach(slot => {
        const button = document.createElement('button');
        button.type = 'button';
        button.className = 'time-slot-button';
        button.textContent = slot.time;
        button.dataset.time = slot.start;
        button.disabled = !slot.available;
        button.setAttribute('aria-pressed', 'false');

        if (slot.available && oldTime && oldTime === slot.start) {
            button.setAttribute('aria-pressed', 'true');
            timeInput.value = slot.start;
        }

        button.addEventListener('click', () => {
            if (!slot.available) return;

            slotsContainer.querySelectorAll('.time-slot-button').forEach(item => {
                item.setAttribute('aria-pressed', 'false');
            });

            button.setAttribute('aria-pressed', 'true');
            timeInput.value = slot.start;
            submitButton.disabled = false;
            message.textContent = `Selected appointment time: ${slot.time}`;
        });

        slotsContainer.appendChild(button);
    });

    submitButton.disabled = !timeInput.value;
}
    async function loadSlots() {
        const thisRequest = ++requestNumber;
        const date = dateInput.value;

        timeInput.value = '';
        resetSlots(date ? 'Loading available times…' : 'Choose a date to see available times.');
        message.textContent = date ? 'Checking availability…' : 'Select a date to check availability.';

        if (!date) return;

        try {
            const csrfInput = rescheduleForm.querySelector('input[name="_token"]');

            const response = await fetch(slotsUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=UTF-8',
                    'X-CSRF-TOKEN': csrfInput ? csrfInput.value : '',
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                body: new URLSearchParams({ date })
            });

            const data = await response.json();

            if (thisRequest !== requestNumber) return;

            if (!response.ok || !Array.isArray(data)) {
                throw new Error(data.message || 'Could not load available times.');
            }

const availableCount = data.filter(slot => slot.available).length;

renderSlots(data);

message.textContent = availableCount > 0
    ? `${availableCount} available time${availableCount === 1 ? '' : 's'} found.`
    : 'No available times. All displayed slots are unavailable; please choose another date.';

        } catch (error) {
            if (thisRequest !== requestNumber) return;
            resetSlots('Unable to load times');
            message.textContent =
                error.message || 'Unable to load times. Refresh the page and try again.';
        }
    }

    dateInput.addEventListener('change', loadSlots);

    rescheduleForm.addEventListener('submit', event => {
        if (!dateInput.value || !timeInput.value || submitButton.disabled) {
            event.preventDefault();
            message.textContent = 'Please choose a date and an available time before submitting.';
        }
    });

    if (showRescheduleInitially) {
        chooseAction('reschedule');
    } else if (showCancellationInitially) {
        chooseAction('cancellation');
    }

    if (dateInput.value) {
        loadSlots();
    }
})();
</script>

@endif

</body>
</html>
