<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="booking.css">
<title>Appointment Tracker</title>

</head>
<body>

<div class="container">

<h2>Dental Appointment Tracker</h2>

<div class="progress-container">
    <div class="progress" id="progress"></div>

    <div class="step active">
        1
        <span class="step-label">Doctor</span>
    </div>

    <div class="step">
        2
        <span class="step-label">Form</span>
    </div>

    <div class="step">
        3
        <span class="step-label">Pay</span>
    </div>

    <div class="step">
        4
        <span class="step-label">Receipt</span>
    </div>

    <div class="step">
        5
        <span class="step-label">Confirmed</span>
    </div>
</div>

<!-- STEP 1 -->
<div class="form-step active">
    <h3>Choose a Doctor</h3>

    <select>
        <option>Select Doctor</option>
        <option>Dr. John Smith</option>
        <option>Dr. Maria Santos</option>
        <option>Dr. Robert Lee</option>
    </select>

    <div class="btn-group">
        <div></div>
        <button onclick="nextStep()">Next</button>
    </div>
</div>

<!-- STEP 2 -->
<div class="form-step">
    <h3>Patient Information</h3>


        <form method="POST" action="{{ route('appointments.store') }}" class="space-y-5">
            @csrf

            <!-- PATIENT INFO -->
            <div class="grid grid-cols-2 gap-4">

                <div>
                    <label class="text-sm">Full Name</label>
                    <input type="text" name="patient_name"
                        value="{{ old('patient_name') }}"
                        class="w-full p-3 border rounded-lg">
                </div>

                <div>
                    <label class="text-sm">Age</label>
                    <input type="number" name="age"
                        value="{{ old('age') }}"
                        class="w-full p-3 border rounded-lg">
                </div>

                <div>
                    <label class="text-sm">Sex</label>
                    <select name="sex" class="w-full p-3 border rounded-lg">
                        <option value="">Select</option>
                        <option value="Male" {{ old('sex')=='Male'?'selected':'' }}>Male</option>
                        <option value="Female" {{ old('sex')=='Female'?'selected':'' }}>Female</option>
                    </select>
                </div>

                <div>
                    <label class="text-sm">Civil Status</label>
                    <input type="text" name="civil_status"
                        value="{{ old('civil_status') }}"
                        class="w-full p-3 border rounded-lg">
                </div>

                <div>
                    <label class="text-sm">Contact No.</label>
                    <input type="text" name="tel_no"
                        value="{{ old('tel_no') }}"
                        class="w-full p-3 border rounded-lg">
                </div>

                <div>
                    <label class="text-sm">Occupation</label>
                    <input type="text" name="occupation"
                        value="{{ old('occupation') }}"
                        class="w-full p-3 border rounded-lg">
                </div>

            </div>

            <div>
                <label class="text-sm">Address</label>
                <textarea name="address"
                    class="w-full p-3 border rounded-lg">{{ old('address') }}</textarea>
            </div>

            <!-- MEDICAL HISTORY -->
            <div class="border rounded-lg p-5">
                <h3 class="font-semibold text-lg mb-4">Medical History</h3>

                <div class="space-y-4">

                    <!-- HEART -->
                    <div>
                        <label class="flex items-center gap-2">
                            <input type="checkbox" name="heart_condition" value="1"
                                {{ old('heart_condition') ? 'checked' : '' }}>
                            Heart Condition
                        </label>
                        <input type="text" name="heart_condition_details"
                            value="{{ old('heart_condition_details') }}"
                            class="w-full mt-2 p-2 border rounded"
                            placeholder="Details">
                    </div>

                    <!-- ALLERGY -->
                    <div>
                        <label class="flex items-center gap-2">
                            <input type="checkbox" name="allergy" value="1"
                                {{ old('allergy') ? 'checked' : '' }}>
                            Allergy
                        </label>
                        <input type="text" name="allergy_details"
                            value="{{ old('allergy_details') }}"
                            class="w-full mt-2 p-2 border rounded"
                            placeholder="Details">
                    </div>

                    <!-- DIABETES -->
                    <div>
                        <label class="flex items-center gap-2">
                            <input type="checkbox" name="diabetes" value="1"
                                {{ old('diabetes') ? 'checked' : '' }}>
                            Diabetes
                        </label>
                        <input type="text" name="diabetes_details"
                            value="{{ old('diabetes_details') }}"
                            class="w-full mt-2 p-2 border rounded"
                            placeholder="Details">
                    </div>

                    <!-- HYPERTENSION -->
                    <div>
                        <label class="flex items-center gap-2">
                            <input type="checkbox" name="hypertension" value="1"
                                {{ old('hypertension') ? 'checked' : '' }}>
                            Hypertension
                        </label>
                        <input type="text" name="hypertension_details"
                            value="{{ old('hypertension_details') }}"
                            class="w-full mt-2 p-2 border rounded"
                            placeholder="Details">
                    </div>

                    <!-- BLEEDING -->
                    <div>
                        <label class="flex items-center gap-2">
                            <input type="checkbox" name="bleeding_tendency" value="1"
                                {{ old('bleeding_tendency') ? 'checked' : '' }}>
                            Bleeding Tendency
                        </label>
                        <input type="text" name="bleeding_tendency_details"
                            value="{{ old('bleeding_tendency_details') }}"
                            class="w-full mt-2 p-2 border rounded"
                            placeholder="Details">
                    </div>

                    <!-- ASTHMA -->
                    <div>
                        <label class="flex items-center gap-2">
                            <input type="checkbox" name="asthma" value="1"
                                {{ old('asthma') ? 'checked' : '' }}>
                            Asthma
                        </label>
                        <input type="text" name="asthma_details"
                            value="{{ old('asthma_details') }}"
                            class="w-full mt-2 p-2 border rounded"
                            placeholder="Details">
                    </div>

                    <!-- OTHER -->
                    <div>
                        <label class="text-sm">Other Diseases / Treatments</label>
                        <textarea name="other_diseases_treatments"
                            class="w-full p-2 border rounded">{{ old('other_diseases_treatments') }}</textarea>
                    </div>

                </div>
            </div>

            <!-- APPOINTMENT -->
            <div class="grid grid-cols-2 gap-4">
                <input type="date" name="appointment_date"
                    value="{{ old('appointment_date') }}"
                    class="p-3 border rounded-lg">

                <input type="time" name="appointment_time"
                    value="{{ old('appointment_time') }}"
                    class="p-3 border rounded-lg">
            </div>

            <div>
                <textarea name="reason"
                    class="w-full p-3 border rounded-lg"
                    placeholder="Reason for visit">{{ old('reason') }}</textarea>
            </div>

            <button type="submit"
                class="w-full bg-pink-600 text-white py-3 rounded-lg">
                Submit Appointment
            </button>

        </form>

    </div>


    <div class="btn-group">
        <button onclick="prevStep()">Back</button>
        <button onclick="nextStep()">Next</button>
    </div>
</div>

<!-- STEP 3 -->
<div class="form-step">
    <h3>Payment</h3>

    <p>Consultation Fee: <strong>₱500</strong></p>

    <br>

    <select>
        <option>GCash</option>
        <option>PayMaya</option>
        <option>Bank Transfer</option>
    </select>

    <div class="btn-group">
        <button onclick="prevStep()">Back</button>
        <button onclick="nextStep()">I've Paid</button>
    </div>
</div>

<!-- STEP 4 -->
<div class="form-step">
    <h3>Upload Receipt</h3>

    <input type="file">

    <div class="btn-group">
        <button onclick="prevStep()">Back</button>
        <button onclick="nextStep()">Submit Receipt</button>
    </div>
</div>

<!-- STEP 5 -->
<div class="form-step">
    <div class="success">
        <h1>✅ Appointment Confirmed</h1>

        <p>
            Your appointment request has been successfully submitted.
            The clinic will verify your payment and contact you shortly.
        </p>

        <br>

        <strong>Status: Confirmed</strong>
    </div>
</div>

</div>




    <script src="{{ asset('js/booking.js') }}"></script>
</body>
</html>
