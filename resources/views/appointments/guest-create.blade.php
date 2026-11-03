
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Book an Appointment | Shine &amp; Smile</title>
    <style>
{{-- Appointment Modal --}}
<div id="appointmentModal" class="appointment-modal">
    <div class="appointment-modal__dialog" role="dialog" aria-modal="true"
         aria-labelledby="appointmentModalTitle">

        <header class="appointment-modal__header">
            <div>
                <span class="appointment-modal__brand">SHINE &amp; SMILE DENTAL CLINIC</span>
                <h2 id="appointmentModalTitle">Book an Appointment</h2>
                <p>Complete your patient information and appointment details.</p>
            </div>

            <button type="button" class="appointment-modal__close"
                    aria-label="Close appointment modal"
                    onclick="document.getElementById('appointmentModal').classList.remove('is-open')">
                &times;
            </button>
        </header>

        <div class="appointment-modal__body">
            <form class="appointment-form" method="POST" action="{{ route('appointments.guest.store') }}">
                @csrf

                <p class="appointment-form__intro">
                    Complete the form below to request a dental appointment.
                    Your appointment will be pending until the clinic reviews it.
                </p>

                <section class="appointment-section">
                    <h3>Patient Information</h3>

                    {{-- Keep your existing patient fields here --}}
                    {{-- Full name, mobile number, email, age, sex, civil status,
                         occupation, address --}}
                </section>

                <section class="appointment-section">
                    <h3>Appointment Details</h3>

                    <label for="service_category_id">Service Category <span>*</span></label>
                    <select id="service_category_id" name="service_category_id" required>
                        {{-- Keep your existing category options --}}
                    </select>

                    <label class="procedure-heading">Dental Procedure <span>*</span></label>
                    <p class="procedure-help">
                        Select one or more procedures to see the total price and duration.
                    </p>

                    <div class="procedure-options">
                        {{-- Keep your existing .procedure-checkbox-option labels and
                             service_procedure_ids[] checkbox inputs here. --}}
                    </div>

                    <div class="procedure-summary">
                        <span>Selected: <strong id="selectedProcedureCount">0 procedures</strong></span>
                        <span>Total duration: <strong id="selectedProcedureDuration">0 minutes</strong></span>
                        <span>Total price: <strong id="selectedProcedurePrice">₱0.00</strong></span>
                    </div>

                    {{-- Keep your existing date, available time slots, and reason fields --}}
                </section>

                <section class="appointment-section">
                    <h3>Medical Information</h3>
                    {{-- Keep your existing medical condition fields here --}}
                </section>

                <section class="appointment-section">
                    <h3>Signature &amp; Submit</h3>
                    {{-- Keep your existing signature controls and submit button here --}}
                    <button type="submit" class="appointment-submit">
                        Submit Appointment Request
                    </button>
                </section>
            </form>
        </div>
    </div>
</div>


.appointment-modal {
    position: fixed;
    inset: 0;
    z-index: 9999;
    display: none;
    align-items: center;
    justify-content: center;
    padding: 24px;
    background: rgba(25, 10, 19, .72);
    backdrop-filter: blur(5px);
}

.appointment-modal.is-open {
    display: flex;
}

.appointment-modal__dialog {
    display: flex;
    flex-direction: column;
    width: min(100%, 1100px);
    max-height: 92vh;
    overflow: hidden;
    border: 1px solid #f4c5da;
    border-radius: 20px;
    background: #fff;
    box-shadow: 0 24px 70px rgba(50, 10, 30, .25);
}

.appointment-modal__header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    padding: 22px 28px;
    border-bottom: 1px solid #f8dce8;
    background: linear-gradient(110deg, #fff 0%, #fff4f9 100%);
}

.appointment-modal__brand {
    display: block;
    margin-bottom: 6px;
    color: #db2777;
    font-size: 10px;
    font-weight: 800;
    letter-spacing: 1.5px;
}

.appointment-modal__header h2 {
    margin: 0;
    color: #29212a;
    font-size: 24px;
    font-weight: 750;
}

.appointment-modal__header p {
    margin: 6px 0 0;
    color: #786b75;
    font-size: 13px;
}

.appointment-modal__close {
    display: grid;
    flex: 0 0 38px;
    width: 38px;
    height: 38px;
    place-items: center;
    border: 1px solid #f5cddd;
    border-radius: 50%;
    background: #fff5f9;
    color: #be185d;
    font-size: 25px;
    cursor: pointer;
}

.appointment-modal__close:hover {
    background: #fce7f3;
}

.appointment-modal__body {
    overflow-y: auto;
    padding: 24px;
    background: #fff8fb;
}

.appointment-form {
    width: min(100%, 760px);
    margin: 0 auto;
    padding: 24px;
    border: 1px solid #f4c5da;
    border-radius: 16px;
    background: #fff;
}

.appointment-form__intro {
    margin: 0 0 22px;
    color: #6f6470;
    font-size: 13px;
    line-height: 1.6;
}

.appointment-section {
    margin-top: 22px;
    padding-top: 20px;
    border-top: 1px solid #f8e3ec;
}

.appointment-section h3 {
    margin: 0 0 16px;
    color: #a81755;
    font-size: 16px;
    font-weight: 750;
}

.appointment-section label,
.procedure-heading {
    display: block;
    margin: 14px 0 7px;
    color: #342a33;
    font-size: 13px;
    font-weight: 650;
}

.appointment-section label span,
.procedure-heading span {
    color: #e11d48;
}

.appointment-section input:not([type="checkbox"]),
.appointment-section select,
.appointment-section textarea {
    box-sizing: border-box;
    width: 100%;
    min-height: 42px;
    padding: 10px 12px;
    border: 1px solid #ddd2da;
    border-radius: 8px;
    background: #fff;
    color: #29212a;
    font: inherit;
    font-size: 13px;
}

.appointment-section input:focus,
.appointment-section select:focus,
.appointment-section textarea:focus {
    outline: none;
    border-color: #ec4899;
    box-shadow: 0 0 0 3px rgba(236, 72, 153, .12);
}

.procedure-help {
    margin: 0 0 12px;
    color: #827580;
    font-size: 12px;
}

/* Procedure cards: no decorative icons */
.procedure-options {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
    gap: 10px;
}

.procedure-checkbox-option {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 12px;
    border: 1px solid #e8dce3;
    border-radius: 10px;
    background: #fff;
    color: #302630;
    cursor: pointer;
    transition: background .2s, border-color .2s, box-shadow .2s;
}

.procedure-checkbox-option:hover {
    border-color: #f472b6;
    background: #fff8fc;
}

.procedure-checkbox-option img,
.procedure-checkbox-option svg,
.procedure-checkbox-option .procedure-icon {
    display: none !important;
}

.procedure-checkbox-option input[type="checkbox"] {
    appearance: none;
    -webkit-appearance: none;
    width: 19px;
    height: 19px;
    flex: 0 0 19px;
    margin: 0;
    display: inline-grid;
    place-content: center;
    border: 1.5px solid #c9b8c2;
    border-radius: 5px;
    background: #fff;
    cursor: pointer;
}


.procedure-checkbox-option input[type="checkbox"]:checked { border-color: #db2777; background: #db2777;
}
.procedure-checkbox-option input[type="checkbox"]:checked::before {
    content: "✓";
    color: #fff;
    font-size: 14px;
    font-weight: 800;
    line-height: 1;
}


.procedure-checkbox-option:has(input[type="checkbox"]:checked) {
    border-color: #ec4899;
    background: linear-gradient(110deg, #fff1f7, #ffe5f0);
    box-shadow: 0 0 0 1px rgba(236, 72, 153, .12);
}

.procedure-summary {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    gap: 12px;
    margin-top: 16px;
    padding: 14px 16px;
    border: 1px solid #f8cde0;
    border-radius: 11px;
    background: #fff0f7;
    color: #a81755;
    font-size: 12px;
}

.appointment-submit {
    width: 100%;
    margin-top: 20px;
    padding: 13px 18px;
    border: 0;
    border-radius: 9px;
    background: linear-gradient(110deg, #ec4899, #c21867);
    color: #fff;
    font-size: 14px;
    font-weight: 750;
    cursor: pointer;
}

.appointment-submit:hover {
    filter: brightness(.96);
}

@media (max-width: 600px) {
    .appointment-modal {
        padding: 8px;
    }

    .appointment-modal__dialog {
        max-height: 96vh;
        border-radius: 14px;
    }

    .appointment-modal__header,
    .appointment-modal__body {
        padding: 16px;
    }

    .appointment-form {
        padding: 16px;
    }

    .procedure-options {
        grid-template-columns: 1fr;
    }
}
        

* { box-sizing: border-box; }
        body {
            margin: 0;
            padding: 24px;
            font-family: Arial, sans-serif;
            color: #333;
            background: #fff8fb;
        }
        .container {
            max-width: 760px;
            margin: auto;
            padding: 28px;
            background: white;
            border: 1px solid #f5c9dd;
            border-radius: 18px;
        }
        h1 { color: #d63384; margin-top: 0; }
        .intro { color: #666; line-height: 1.5; }
        .grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
        }
        .field { margin-bottom: 16px; }
        label {
            display: block;
            margin-bottom: 7px;
            font-weight: 600;
        }
        input, select, textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font: inherit;
            background: white;
        }
        textarea { min-height: 90px; resize: vertical; }
        .error {
            padding: 12px;
            margin-bottom: 16px;
            border-radius: 8px;
            background: #fff0f0;
            color: #a40000;
        }
        button {
            width: 100%;
            padding: 14px;
            border: 0;
            border-radius: 9px;
            background: #d63384;
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }
        button:hover { background: #b9256e; }
        @media (max-width: 560px) {
            body { padding: 12px; }
            .container { padding: 18px; }
            .grid { grid-template-columns: 1fr; gap: 0; }
        }

        .booking-grid {
            display: grid;
            grid-template-columns: minmax(0, 0.9fr) minmax(0, 1.1fr);
            gap: 20px;
            align-items: start;
        }
        .service-info {
            margin: 8px 0 0;
            color: #777;
            font-size: 13px;
        }
        .guest-time-slots {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 9px;
            min-height: 45px;
        }
        .guest-time-slots .slot-btn {
            width: 100%;
            padding: 11px 8px;
            border: 1px solid #198754;
            border-radius: 7px;
            background: #198754;
            color: #fff;
            font-size: 14px;
            font-weight: 600;
        }
        .guest-time-slots .slot-btn:hover,
        .guest-time-slots .slot-btn.active {
            background: #146c43;
            border-color: #146c43;
        }
        .guest-time-slots .slot-btn:focus-visible {
            outline: 3px solid #8bd5ad;
            outline-offset: 2px;
        }
        .guest-time-slots .slot-btn:disabled {
            background: #e9ecef;
            border-color: #d7dce0;
            color: #737b82;
            cursor: not-allowed;
            opacity: 1;
        }
        .slot-message {
            grid-column: 1 / -1;
            margin: 0;
            padding: 12px;
            border-radius: 8px;
            background: #f7f7f7;
            color: #666;
            font-size: 13px;
        }
        .slot-selection {
            min-height: 18px;
            margin: 9px 0 0;
            color: #198754;
            font-size: 13px;
            font-weight: 600;
        }
        @media (max-width: 560px) {
            .booking-grid { grid-template-columns: 1fr; gap: 0; }
            .guest-time-slots { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        }

    
/* Guest signature pad */
.guest-signature-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin: 10px 0;
}
.guest-signature-actions button {
    border: 0;
    border-radius: 8px;
    padding: 10px 16px;
    cursor: pointer;
    font-weight: 600;
}
#guestAddSignature {
    background: #ec4899;
    color: #fff;
}
#guestClearSignature {
    background: #fce7f3;
    color: #9d174d;
}
.guest-signature-preview {
    min-height: 90px;
    border: 1px solid #e5e7eb;
    border-radius: 10px;
    background: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    padding: 8px;
}
.guest-signature-preview img {
    display: block;
    max-width: 100%;
    width: 100%;
    max-height: 110px;
    object-fit: contain;
}
#guestSignaturePlaceholder {
    color: #9ca3af;
}
.guest-signature-line {
    color: #6b7280;
    font-size: 12px;
    text-align: center;
    margin-top: 5px;
}
#guest-signature-modal {
    display: none;
    position: fixed;
    inset: 0;
    z-index: 99999;
    align-items: center;
    justify-content: center;
    padding: 16px;
}
#guest-signature-modal.active {
    display: flex;
}
#guest-signature-modal .guest-signature-overlay {
    position: absolute;
    inset: 0;
    background: rgba(17, 24, 39, .65);
}
#guest-signature-modal .guest-signature-dialog {
    position: relative;
    width: min(650px, 100%);
    background: #fff;
    border-radius: 16px;
    padding: 20px;
    box-shadow: 0 20px 60px rgba(0,0,0,.25);
}
#guest-signature-modal h3 {
    margin: 0 0 6px;
    color: #9d174d;
}
#guest-signature-modal p {
    margin: 0 0 14px;
    color: #6b7280;
}
.guest-signature-canvas-wrap {
    position: relative;
    height: 220px;
    border: 2px dashed #f9a8d4;
    border-radius: 10px;
    overflow: hidden;
    background: #fff;
}
#guestSignatureCanvas {
    width: 100%;
    height: 100%;
    display: block;
    touch-action: none;
    cursor: crosshair;
}
#guestSignatureCanvasPlaceholder {
    position: absolute;
    inset: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    pointer-events: none;
    color: #d1d5db;
    font-size: 22px;
}
.guest-signature-modal-actions {
    display: flex;
    flex-wrap: wrap;
    justify-content: flex-end;
    gap: 10px;
    margin-top: 16px;
}
.guest-signature-modal-actions button {
    border: 0;
    border-radius: 8px;
    padding: 10px 16px;
    cursor: pointer;
    font-weight: 600;
}
#guestSignatureCancel, #guestSignatureReset {
    background: #f3f4f6;
    color: #374151;
}
#guestSignatureSave {
    background: #ec4899;
    color: #fff;
}
@media (max-width: 560px) {
    #guest-signature-modal .guest-signature-dialog {
        padding: 14px;
    }
    .guest-signature-canvas-wrap {
        height: 190px;
    }
}

</style>
</head>
<body>
<div class="container">
    <h1>Book an Appointment</h1>
    <p class="intro">
        Complete the form below to request a dental appointment.
        You do not need to create an account. Your appointment will be
        pending until the clinic reviews it.
    </p>

    @if ($errors->any())
        <div class="error">
            <strong>Please check the following:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('appointments.guest.store') }}">
        @csrf

        <h3>Patient Information</h3>
        <div class="grid">
            <div class="field">
                <label for="patient_name">Full name *</label>
                <input id="patient_name" name="patient_name"
                       value="{{ old('patient_name') }}" maxlength="255" required>
            </div>
            <div class="field">
                <label for="tel_no">Mobile number</label>
                <input id="tel_no" name="tel_no" type="tel"
                       value="{{ old('tel_no') }}"
                       placeholder="09XXXXXXXXX">
            </div>
            <div class="field">
                <label for="email">Gmail Address</label>
                <input id="email" name="email" type="email"
                       value="{{ old('email') }}"
                       placeholder="example@gmail.com"
                       autocomplete="email"
                       inputmode="email"
                       pattern="[a-zA-Z0-9._%+]+@gmail\.com"
                       title="Please enter a valid Gmail address ending in @gmail.com">
            </div>
            <div class="field">
                <label for="age">Age</label>
                <input id="age" name="age" type="number" min="1"
                       value="{{ old('age') }}">
            </div>
            <div class="field">
                <label for="sex">Sex</label>
                <select id="sex" name="sex">
                    <option value="">Select</option>
                    <option value="Male" @selected(old('sex') === 'Male')>Male</option>
                    <option value="Female" @selected(old('sex') === 'Female')>Female</option>
                </select>
            </div>
            <div class="field">
                <label for="civil_status">Civil status</label>
                <select id="civil_status" name="civil_status">
                    <option value="">Select</option>
                    @foreach (['Single','Married','Widowed','Separated'] as $status)
                        <option value="{{ $status }}"
                            @selected(old('civil_status') === $status)>
                            {{ $status }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="field">
                <label for="occupation">Occupation</label>
                <select id="occupation" name="occupation">
                    <option value="">Select Occupation</option>
                    @foreach ([
                        'Student',
                        'Employed',
                        'Self-Employed',
                        'Business Owner',
                        'Government Employee',
                        'Private Employee',
                        'Unemployed',
                        'Retired',
                        'Other'
                    ] as $occupationOption)
                        <option value="{{ $occupationOption }}"
                            @selected(old('occupation') === $occupationOption)>
                            {{ $occupationOption }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="field">
            <label for="address">Address</label>
            <textarea id="address" name="address">{{ old('address') }}</textarea>
        </div>

        <h3>Appointment Details</h3>
        <div class="field">
            <label for="service_category_id">Service Category *</label>
            <select id="service_category_id" name="service_category_id" required>
                <option value="">Select a category</option>
                @foreach ($serviceCategories as $category)
                    <option value="{{ $category->id }}"
                        @selected((string) old('service_category_id') === (string) $category->id)>
                        {{ $category->category_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="field">
            <label for="service_procedure_id">Dental Procedure *</label>
            <div id="procedure-options" class="procedure-checkbox-list">
    @foreach ($serviceCategories as $category)
        @foreach ($category->procedures as $procedure)
            <label class="procedure-checkbox-option" data-category="{{ $category->id }}">
                <input
                    type="checkbox"
                    name="service_procedure_ids[]"
                    value="{{ $procedure->id }}"
                    data-price="{{ number_format((float) $procedure->price, 2, '.', '') }}"
                    data-duration="{{ (int) ($procedure->duration_minutes ?? 0) }}">
                <span>{{ $procedure->procedure_name }}</span>
            </label>
        @endforeach
    @endforeach
</div>
            <p id="guest-service-info" class="service-info">Select a procedure to see its price and duration.</p>
        </div>

        <div class="booking-grid">
            <div class="field">
                <label for="appointment_date">Appointment Date *</label>
                <input id="appointment_date" name="appointment_date"
                       type="date" min="{{ now()->toDateString() }}"
                       value="{{ old('appointment_date') }}" required>
            </div>

            <div class="field">
                <label>Available Time Slots *</label>
                <div id="guest-time-slots" class="guest-time-slots" aria-live="polite">
                    <p class="slot-message">Select a dental service and date to see available times.</p>
                </div>
                <input type="hidden" id="appointment_time" name="appointment_time"
                       value="{{ old('appointment_time') }}" required>
                <input type="hidden" id="end_time" name="end_time" value="">
                <p id="guest-slot-selection" class="slot-selection">No time selected.</p>
            </div>
        </div>

        <div class="field">
            <label for="reason">Reason for appointment *</label>
            <textarea id="reason" name="reason" required>{{ old('reason') }}</textarea>
        </div>

        <h3>Medical Information</h3>
        @foreach ([
            'heart_condition' => 'Heart condition',
            'allergy' => 'Allergies',
            'diabetes' => 'Diabetes',
            'hypertension' => 'Hypertension',
            'bleeding_tendency' => 'Bleeding tendency',
            'asthma' => 'Asthma'
        ] as $field => $label)
            <div class="field">
                <label>
                    <input style="width:auto" type="checkbox" name="{{ $field }}"
                           value="1" @checked(old($field))>
                    {{ $label }}
                </label>
                <input name="{{ $field }}_details"
                       value="{{ old($field . '_details') }}"
                       placeholder="Details, if applicable">
            </div>
        @endforeach

        <div class="field">
            <label for="other_conditions">Other medical conditions</label>
            <textarea id="other_conditions" name="other_conditions">{{ old('other_conditions') }}</textarea>
        </div>

        <div class="field guest-signature-field">
            <label>Patient / Guardian Signature (optional)</label>

            <div class="guest-signature-actions">
                <button type="button" id="guestAddSignature">Add Signature</button>
                <button type="button" id="guestClearSignature">Clear Signature</button>
            </div>

            <div class="guest-signature-preview" id="guestSignaturePreview">
                <img id="guestSignatureImage" alt="Patient signature preview"
                     style="display:none">
                <span id="guestSignaturePlaceholder">No signature added</span>
            </div>

            <div class="guest-signature-line">
                Patient / Guardian Signature
            </div>

            <input type="hidden" name="patient_signature"
                   id="patient_signature"
                   value="{{ old('patient_signature') }}">
        </div>

        <button type="submit">Submit Appointment Request</button>
    
<div id="guest-signature-modal" aria-hidden="true">
    <div class="guest-signature-overlay" id="guestSignatureOverlay"></div>
    <div class="guest-signature-dialog" role="dialog" aria-modal="true"
         aria-labelledby="guestSignatureTitle">
        <h3 id="guestSignatureTitle">Patient Signature</h3>
        <p>Please sign inside the box below using your finger, stylus, or mouse.</p>

        <div class="guest-signature-canvas-wrap">
            <canvas id="guestSignatureCanvas"></canvas>
            <div id="guestSignatureCanvasPlaceholder">Sign here</div>
        </div>

        <div class="guest-signature-modal-actions">
            <button type="button" id="guestSignatureReset">Clear Pad</button>
            <button type="button" id="guestSignatureCancel">Cancel</button>
            <button type="button" id="guestSignatureSave">Save Signature</button>
        </div>
    </div>
</div>

</form>
</div>

<script id="guest-slot-script">
document.addEventListener('DOMContentLoaded', function () {
    const category = document.getElementById('service_category_id');
    const optionsBox = document.getElementById('procedure-options');
    const procedureOptions = Array.from(
        optionsBox.querySelectorAll('.procedure-checkbox-option')
    );
    const procedureInputs = procedureOptions.map(label => label.querySelector('input'));
    const date = document.getElementById('appointment_date');
    const slotsBox = document.getElementById('guest-time-slots');
    const timeInput = document.getElementById('appointment_time');
    const endInput = document.getElementById('end_time');
    const selectionText = document.getElementById('guest-slot-selection');
    const serviceInfo = document.getElementById('guest-service-info');
    const form = category.closest('form');
    const oldTime = timeInput.value;

    function selectedProcedures() {
        return procedureInputs.filter(input => input.checked);
    }

    function showMessage(message) {
        slotsBox.replaceChildren();
        const p = document.createElement('p');
        p.className = 'slot-message';
        p.textContent = message;
        slotsBox.appendChild(p);
    }

    function clearSelection() {
        timeInput.value = '';
        endInput.value = '';
        selectionText.textContent = 'No time selected.';
        slotsBox.querySelectorAll('.slot-btn.active').forEach(button => {
            button.classList.remove('active');
        });
    }

    function updateProcedureOptions(clearChecked) {
        const categoryId = category.value;
        let visibleCount = 0;

        procedureOptions.forEach(label => {
            const matches = Boolean(categoryId) &&
                label.dataset.category === categoryId;

            label.hidden = !matches;
            label.style.display = matches ? '' : 'none';

            const input = label.querySelector('input');
            input.disabled = !matches;

            if (!matches || clearChecked) {
                input.checked = false;
            }

            if (matches) visibleCount++;
        });

        if (!categoryId) {
            serviceInfo.textContent = 'Select a category to see its procedures.';
        } else if (!visibleCount) {
            serviceInfo.textContent = 'No procedures are currently available in this category.';
        } else {
            updateProcedureInfo();
        }
    }

    function updateProcedureInfo() {
        const selected = selectedProcedures();
        const totalPrice = selected.reduce(
            (sum, input) => sum + Number(input.dataset.price || 0), 0
        );
        const totalDuration = selected.reduce(
            (sum, input) => sum + Number(input.dataset.duration || 0), 0
        );

        if (!selected.length) {
            serviceInfo.textContent = 'Select one or more procedures to see the total price and duration.';
            return;
        }

        serviceInfo.textContent =
            'Selected: ' + selected.length +
            ' · Total price: ₱' + totalPrice.toLocaleString('en-PH', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            }) +
            ' · Total duration: ' + totalDuration + ' minutes';
    }

    async function loadGuestSlots() {
        clearSelection();

        const selected = selectedProcedures();

        if (!category.value || !selected.length) {
            showMessage('Select a category and at least one dental procedure.');
            return;
        }

        if (!date.value) {
            showMessage('Choose an appointment date to see available times.');
            return;
        }

        const duration = selected.reduce(
            (sum, input) => sum + Number(input.dataset.duration || 0), 0
        );

        if (selected.some(input => Number(input.dataset.duration || 0) <= 0)) {
            showMessage('A selected procedure has no valid duration. Please contact the clinic.');
            return;
        }

        showMessage('Loading available time slots…');

        try {
            const url = new URL('/available-slots', window.location.origin);
            url.searchParams.set('date', date.value);
            selected.forEach(input => {
                url.searchParams.append('service_procedure_ids[]', input.value);
            });

            const response = await fetch(url.toString(), {
                headers: { 'Accept': 'application/json' }
            });

            if (!response.ok) {
                throw new Error('Availability request failed.');
            }

            const data = await response.json();
            slotsBox.replaceChildren();

            if (!Array.isArray(data) || data.length === 0) {
                showMessage('No time slots are available for the selected procedures and date.');
                return;
            }

            let oldTimeFound = false;

            data.forEach(function (slot) {
                const button = document.createElement('button');
                button.type = 'button';
                button.className = 'slot-btn';
                button.textContent = slot.time;
                button.disabled = !slot.available;
                button.setAttribute(
                    'aria-label',
                    slot.time + (slot.available ? ', available' : ', unavailable')
                );

                if (!slot.available) {
                    button.title = 'This time is unavailable';
                } else {
                    button.addEventListener('click', function () {
                        slotsBox.querySelectorAll('.slot-btn.active').forEach(
                            active => active.classList.remove('active')
                        );

                        button.classList.add('active');
                        timeInput.value = slot.start;
                        endInput.value = slot.end;
                        selectionText.textContent =
                            'Selected: ' + slot.time + ' · ' +
                            Number(slot.duration || duration) + ' minutes';
                    });

                    if (oldTime && slot.start === oldTime) {
                        oldTimeFound = true;
                        button.classList.add('active');
                        timeInput.value = slot.start;
                        endInput.value = slot.end;
                        selectionText.textContent =
                            'Selected: ' + slot.time + ' · ' +
                            Number(slot.duration || duration) + ' minutes';
                    }
                }

                slotsBox.appendChild(button);
            });

            if (oldTime && !oldTimeFound) {
                clearSelection();
                selectionText.textContent =
                    'Your previous time is no longer available. Please choose another.';
            }
        } catch (error) {
            showMessage('Unable to load time slots. Please refresh and try again.');
            console.error(error);
        }
    }

    category.addEventListener('change', function () {
        updateProcedureOptions(true);
        clearSelection();
        showMessage('Select one or more procedures and a date to see available times.');
    });

    procedureInputs.forEach(input => {
        input.addEventListener('change', function () {
            updateProcedureInfo();
            loadGuestSlots();
        });
    });

    date.addEventListener('change', loadGuestSlots);

    updateProcedureOptions(false);

    form.addEventListener('submit', function (event) {
        const selected = selectedProcedures();

        if (!category.value || !selected.length ||
            !timeInput.value || !endInput.value) {
            event.preventDefault();
            selectionText.textContent =
                'Please select a category, at least one procedure, and an available time slot.';
            slotsBox.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    });

    if (category.value && selectedProcedures().length && date.value) {
        loadGuestSlots();
    } else {
        showMessage('Select a category, one or more procedures, and a date to see available times.');
    }
});
</script>


<script id="guest-signature-script">
document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('guest-signature-modal');
    const canvas = document.getElementById('guestSignatureCanvas');
    const hidden = document.getElementById('patient_signature');
    const preview = document.getElementById('guestSignatureImage');
    const placeholder = document.getElementById('guestSignaturePlaceholder');
    const padPlaceholder = document.getElementById('guestSignatureCanvasPlaceholder');
    const ctx = canvas.getContext('2d');

    let drawing = false;
    let hasInk = false;
    let lastPoint = null;

    function resizeCanvas() {
        const rect = canvas.getBoundingClientRect();
        if (!rect.width || !rect.height) return;

        const ratio = Math.max(window.devicePixelRatio || 1, 1);
        const saved = hasInk ? canvas.toDataURL('image/png') : null;

        canvas.width = Math.round(rect.width * ratio);
        canvas.height = Math.round(rect.height * ratio);
        ctx.setTransform(ratio, 0, 0, ratio, 0, 0);
        ctx.lineWidth = 2.5;
        ctx.lineCap = 'round';
        ctx.lineJoin = 'round';
        ctx.strokeStyle = '#111827';

        if (saved) {
            const image = new Image();
            image.onload = function () {
                ctx.drawImage(image, 0, 0, rect.width, rect.height);
            };
            image.src = saved;
        }
    }

    function openPad() {
        modal.classList.add('active');
        modal.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
        requestAnimationFrame(resizeCanvas);
    }

    function closePad() {
        modal.classList.remove('active');
        modal.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
    }

    function clearPad() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        hasInk = false;
        lastPoint = null;
        padPlaceholder.style.display = 'flex';
    }

    function point(event) {
        const rect = canvas.getBoundingClientRect();
        return { x: event.clientX - rect.left, y: event.clientY - rect.top };
    }

    canvas.addEventListener('pointerdown', function (event) {
        event.preventDefault();
        drawing = true;
        lastPoint = point(event);
        hasInk = true;
        padPlaceholder.style.display = 'none';
        canvas.setPointerCapture(event.pointerId);

        ctx.beginPath();
        ctx.moveTo(lastPoint.x, lastPoint.y);
        ctx.lineTo(lastPoint.x + 0.1, lastPoint.y + 0.1);
        ctx.stroke();
    });

    canvas.addEventListener('pointermove', function (event) {
        if (!drawing) return;
        event.preventDefault();
        const next = point(event);
        ctx.beginPath();
        ctx.moveTo(lastPoint.x, lastPoint.y);
        ctx.lineTo(next.x, next.y);
        ctx.stroke();
        lastPoint = next;
    });

    function stopDrawing() {
        drawing = false;
        lastPoint = null;
    }

    canvas.addEventListener('pointerup', stopDrawing);
    canvas.addEventListener('pointercancel', stopDrawing);
    canvas.addEventListener('lostpointercapture', stopDrawing);

    document.getElementById('guestAddSignature').addEventListener('click', openPad);
    document.getElementById('guestSignatureReset').addEventListener('click', clearPad);
    document.getElementById('guestSignatureCancel').addEventListener('click', closePad);
    document.getElementById('guestSignatureOverlay').addEventListener('click', closePad);

    document.getElementById('guestSignatureSave').addEventListener('click', function () {
        if (!hasInk) {
            alert('Please add your signature first.');
            return;
        }

        // Encode a compact signature copy so it stays within the server's
        // 10,000-character validation limit. Keep the drawing canvas unchanged.
        function makeCompactSignature() {
            const sourceWidth = canvas.width;
            const sourceHeight = canvas.height;
            const scale = Math.min(1, 600 / sourceWidth, 200 / sourceHeight);
            const output = document.createElement('canvas');
            output.width = Math.max(1, Math.round(sourceWidth * scale));
            output.height = Math.max(1, Math.round(sourceHeight * scale));

            const outputContext = output.getContext('2d');
            outputContext.fillStyle = '#ffffff';
            outputContext.fillRect(0, 0, output.width, output.height);
            outputContext.drawImage(canvas, 0, 0, output.width, output.height);

            for (const quality of [0.8, 0.65, 0.5, 0.35, 0.25]) {
                const data = output.toDataURL('image/jpeg', quality);
                if (data.length <= 10000) return data;
            }

            return null;
        }

        const compactSignature = makeCompactSignature();

        if (!compactSignature) {
            alert('The signature is too detailed to save. Please clear it and sign again using simpler strokes.');
            return;
        }

        hidden.value = compactSignature;
        preview.src = hidden.value;
        preview.style.display = 'block';
        placeholder.style.display = 'none';
        closePad();
    });

    document.getElementById('guestClearSignature').addEventListener('click', function () {
        hidden.value = '';
        preview.removeAttribute('src');
        preview.style.display = 'none';
        placeholder.style.display = 'inline';
        clearPad();
    });

    if (hidden.value && hidden.value.startsWith('data:image/')) {
        preview.src = hidden.value;
        preview.style.display = 'block';
        placeholder.style.display = 'none';
    }

    window.addEventListener('resize', function () {
        if (modal.classList.contains('active')) resizeCanvas();
    });
});
</script>

</body>
</html>

