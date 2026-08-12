<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Shine & Smile Dental | Creating Healthy, Beautiful Smiles</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/booking.css') }}">
</head>
<body class="bg-white text-[#2D2D2D]">


<nav class="fixed top-0 left-0 w-full z-[99999] bg-white/90 backdrop-blur-md shadow-sm">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">

        <!-- Logo + Burger -->
        <div class="relative flex items-center gap-4">

            <div class="text-2xl font-bold text-[#E91E63]">
                Shine & Smile
            </div>
        </div>

       <div class="hidden md:flex items-center gap-8 font-medium mx-auto">

    <a href="{{ route('appointments.homepage') }}"
       class="px-4 py-2 rounded-lg transition
       {{ request()->routeIs('appointments.homepage') ? 'bg-pink-500 text-white' : 'hover:text-[#E91E63]' }}">
        Home
    </a>

    <a href="{{ route('appointments.create') }}"
       class="hover:text-[#E91E63] transition">
        Appointments
    </a>

    <a href="{{ route('appointments.dentists') }}"
       class="hover:text-[#E91E63] transition">
        Dentists
    </a>

    <a href="  {{ route('appointments.message') }}  "
       class="hover:text-[#E91E63] transition">
       Messages
    </a>

    <a href="{{ route('appointments.history') }}"
       class="hover:text-[#E91E63] transition">
        History
    </a>

</div>

        <!-- Notification + Profile -->
    <div class="flex items-center gap-4">

            <button id="notificationBtn" class="notification-btn">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-6 h-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V4a2 2 0 10-4 0v1.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0a3 3 0 11-6 0m6 0H9" />
                    </svg>


            @if($notificationCount > 0)
                <span class="notification-badge">
                    {{ $notificationCount }}
                </span>
            @endif

        </button>

    <!-- Dropdown -->
     <div id="notificationDropdown"
         class="hidden absolute top-full right-12 mt-3 w-80 bg-white rounded-xl shadow-2xl border border-gray-200 z-[999999]">

        <div class="px-4 py-3 border-b font-semibold text-lg">
            Notifications
        </div>

      @forelse($notifications as $notification)

<div class="px-4 py-3 border-b hover:bg-gray-50">

    <div class="flex justify-between items-start">

        <div>

            <div class="font-medium">
                {{ $notification->title }}
            </div>

            <div class="text-sm text-gray-600">
                {{ $notification->message }}
            </div>

            <div class="text-xs text-gray-400 mt-1">
                {{ $notification->created_at->diffForHumans() }}
            </div>

        </div>

        <form method="POST"
              action="{{ route('notifications.destroy', $notification->id) }}">

            @csrf
            @method('DELETE')

            <button type="submit"
                class="text-red-500 hover:text-red-700 text-sm font-bold">
                ✕
            </button>

        </form>

    </div>

</div>

@empty

<div class="p-4 text-gray-500">
    No notifications.
</div>

@endforelse

    </div>

</div>

<!-- Profile Dropdown -->
<div class="relative">

    <button id="profileBtn"
        type="button"
        class="flex items-center gap-2 focus:outline-none">

    <img
    src="{{ Auth::user()->profile_picture
            ? asset('storage/' . Auth::user()->profile_picture)
            : asset('images/default-profile.png') }}"
    alt="Profile"
    class="w-10 h-10 rounded-full border-2 border-pink-500 object-cover">

        <div class="hidden md:block text-left">
            <p class="text-sm font-semibold text-gray-800">
    {{ Auth::user()->name }}
</p>
            <p class="text-xs text-gray-500">
                Patient
            </p>
        </div>

        <svg xmlns="http://www.w3.org/2000/svg"
             class="w-4 h-4 text-gray-500"
             fill="none"
             viewBox="0 0 24 24"
             stroke="currentColor">
            <path stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M19 9l-7 7-7-7" />
        </svg>

    </button>

    <!-- Dropdown Menu -->
   <div id="profileMenu"
     class="hidden absolute right-0 mt-3 w-52 bg-white rounded-xl shadow-xl border border-gray-100 overflow-hidden z-[9999]">

    <!-- Settings -->
    <a href="{{ route('appointments.settings', [ 'return' => url()->current() ]) }}"
    class="flex items-center gap-3 px-2 py-2 text-gray-700 hover:bg-pink-50 hover:text-pink-600 transition">

    <svg xmlns="http://www.w3.org/2000/svg"
        class="w-5 h-5"
        viewBox="0 0 24 24"
        fill="currentColor">

    <path d="M19.14,12.94a7.49,7.49,0,0,0,.05-.94,7.49,7.49,0,0,0-.05-.94l2.03-1.58a.5.5,0,0,0,.12-.64l-1.92-3.32a.5.5,0,0,0-.6-.22l-2.39.96a7.28,7.28,0,0,0-1.63-.94L14.4,2.81A.5.5,0,0,0,13.91,2H10.09a.5.5,0,0,0-.49.81L9.25,5.32a7.28,7.28,0,0,0-1.63.94l-2.39-.96a.5.5,0,0,0-.6.22L2.71,8.84a.5.5,0,0,0,.12.64L4.86,11.06a7.49,7.49,0,0,0-.05.94,7.49,7.49,0,0,0,.05.94L2.83,14.52a.5.5,0,0,0-.12.64l1.92,3.32a.5.5,0,0,0,.6.22l2.39-.96a7.28,7.28,0,0,0,1.63.94l.35,2.51a.5.5,0,0,0,.49.41h3.82a.5.5,0,0,0,.49-.41l.35-2.51a7.28,7.28,0,0,0,1.63-.94l2.39.96a.5.5,0,0,0,.6-.22l1.92-3.32a.5.5,0,0,0-.12-.64ZM12,15.5A3.5,3.5,0,1,1,15.5,12,3.5,3.5,0,0,1,12,15.5Z"/>
</svg>

        <span>Settings</span>
    </a>

    <!-- Logout -->
    <form method="POST" action="{{ route('logout') }}">
        @csrf

        <button type="submit"
                class="w-full text-left flex items-center gap-3 px-2 py-1 text-red-600 hover:bg-red-50 transition">

            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-5 h-5"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M17 16l4-4m0 0l-4-4m4 4H7" />
                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M3 12h4" />
            </svg>

            <span>Logout</span>
        </button>
    </form>

</div>

</div>

        </div>

    </div>
</nav>



<div class="booking-container">
  @if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        <ul>
            @foreach ($errors->all() as $error)
                <li>• {{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
   <h2>Dental Appointment Tracker</h2>

<div class="tracker">

    <!-- STEP 1 -->
    <div class="tracker-step active" id="tracker-step-1">
        <div class="circle">1</div>
        <span>Form</span>
    </div>

    <!-- STEP 2 -->
    <div class="tracker-step" id="tracker-step-2">
        <div class="circle">2</div>
        <span>Summary</span>
    </div>

    <!-- STEP 3 -->
    <div class="tracker-step" id="tracker-step-3">
        <div class="circle">3</div>
        <span>Confirmed</span>
    </div>

</div>

    <form method="POST"
          action="{{ route('appointments.store') }}"
          enctype="multipart/form-data">

        @csrf



        <!-- STEP 1 -->
    <div class="form-step active" id="step1">

    <!-- PATIENT INFORMATION -->
    <div class="section-card">

        <h3 class="section-title">
            Patient Information
        </h3>

        <div class="form-grid">

            <div class="form-group">
                <label>Full Name</label>
                <input type="text"
                       name="patient_name"
                       value="{{ old('patient_name') }}"
                       required>
            </div>

            <div class="form-group">
                <label>Age</label>
                <input type="number"
                       name="age"
                       value="{{ old('age') }}">
            </div>

            <div class="form-group">
                <label>Sex</label>
                <select name="sex">
                    <option value="">Select</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>

            <div class="form-group">
                <label>Civil Status</label>
                <input type="text"
                       name="civil_status"
                       value="{{ old('civil_status') }}">
            </div>

            <div class="form-group">
                <label>Contact Number</label>
                <input type="text"
                       name="tel_no"
                       value="{{ old('tel_no') }}">
            </div>

            <div class="form-group">
                <label>Occupation</label>
                <input type="text"
                       name="occupation"
                       value="{{ old('occupation') }}">
            </div>

        </div>

        <div class="form-group">
            <label>Address</label>
            <textarea name="address">{{ old('address') }}</textarea>
        </div>

    </div>

    <!-- MEDICAL HISTORY -->
    <div class="section-card">

        <h3 class="section-title">
            Medical History
        </h3>

        <div class="medical-grid">

            <div class="medical-item">
                <label class="checkbox-label">
                    <input type="checkbox" name="heart_condition" value="1">
                    Heart Condition
                </label>

                <input type="text"
                       name="heart_condition_details"
                       placeholder="Provide details">
            </div>

            <div class="medical-item">
                <label class="checkbox-label">
                    <input type="checkbox" name="allergy" value="1">
                    Allergy
                </label>

                <input type="text"
                       name="allergy_details"
                       placeholder="Provide details">
            </div>

            <div class="medical-item">
                <label class="checkbox-label">
                    <input type="checkbox" name="diabetes" value="1">
                    Diabetes
                </label>

                <input type="text"
                       name="diabetes_details"
                       placeholder="Provide details">
            </div>

            <div class="medical-item">
                <label class="checkbox-label">
                    <input type="checkbox" name="hypertension" value="1">
                    Hypertension
                </label>

                <input type="text"
                       name="hypertension_details"
                       placeholder="Provide details">
            </div>

            <div class="medical-item">
                <label class="checkbox-label">
                    <input type="checkbox" name="bleeding_tendency" value="1">
                    Bleeding Tendency
                </label>

                <input type="text"
                       name="bleeding_tendency_details"
                       placeholder="Provide details">
            </div>

            <div class="medical-item">
                <label class="checkbox-label">
                    <input type="checkbox" name="asthma" value="1">
                    Asthma
                </label>

                <input type="text"
                       name="asthma_details"
                       placeholder="Provide details">
            </div>

        </div>

        <div class="form-group">
            <label>Other Diseases / Treatments</label>
            <textarea name="other_conditions"></textarea>
        </div>

    </div>


  <div class="section-card">
    <h3 class="section-title">Odontogram</h3>

    <div class="odontogram-wrapper">

        <!-- Vertical Divider -->
        <div class="center-line vertical"></div>

        <!-- Horizontal Divider -->
        <div class="center-line horizontal"></div>

        <!-- Top Direction -->
        <div class="jaw-direction top">
            <div class="direction left">
                <span>RIGHT</span>
                <div class="jaw-line"></div>
            </div>

            <div class="direction right">
                <div class="jaw-line"></div>
                <span>LEFT</span>
            </div>
        </div>

        <!-- Upper Permanent Numbers -->
       <!-- Upper Primary Numbers -->
<div class="tooth-row primary-number-row">

    <span>55</span>
    <span>54</span>
    <span>53</span>
    <span>52</span>
    <span>51</span>

    <div class="gap-large"></div>

    <span>61</span>
    <span>62</span>
    <span>63</span>
    <span>64</span>
    <span>65</span>

</div>

<!-- Upper Primary Teeth -->
<div class="tooth-row primary-row">

    <div class="tooth" data-tooth="55"></div>
    <div class="tooth" data-tooth="54"></div>
    <div class="tooth" data-tooth="53"></div>
    <div class="tooth" data-tooth="52"></div>
    <div class="tooth" data-tooth="51"></div>

    <div class="gap-large"></div>

    <div class="tooth" data-tooth="61"></div>
    <div class="tooth" data-tooth="62"></div>
    <div class="tooth" data-tooth="63"></div>
    <div class="tooth" data-tooth="64"></div>
    <div class="tooth" data-tooth="65"></div>

</div>


      <!-- Lower Primary Teeth -->
<div class="tooth-row primary-row">

    <div class="tooth" data-tooth="85"></div>
    <div class="tooth" data-tooth="84"></div>
    <div class="tooth" data-tooth="83"></div>
    <div class="tooth" data-tooth="82"></div>
    <div class="tooth" data-tooth="81"></div>

    <div class="gap-large"></div>

    <div class="tooth" data-tooth="71"></div>
    <div class="tooth" data-tooth="72"></div>
    <div class="tooth" data-tooth="73"></div>
    <div class="tooth" data-tooth="74"></div>
    <div class="tooth" data-tooth="75"></div>

</div>

<!-- Lower Primary Numbers -->
<div class="tooth-row primary-number-row">

    <span>85</span>
    <span>84</span>
    <span>83</span>
    <span>82</span>
    <span>81</span>

    <div class="gap-large"></div>

    <span>71</span>
    <span>72</span>
    <span>73</span>
    <span>74</span>
    <span>75</span>

</div>

        <!-- Bottom Direction -->
        <div class="jaw-direction bottom">
            <div class="direction left">
                <span>RIGHT</span>
                <div class="jaw-line"></div>
            </div>

            <div class="direction right">
                <div class="jaw-line"></div>
                <span>LEFT</span>
            </div>
        </div>

    </div>
</div>

    <!-- APPOINTMENT DETAILS -->

    <div class="section-card" >

        <h3 class="section-title">
            Appointment Details
        </h3>

        <div class="form-group">
            <label for="service_id">Dental Service</label>

            <select name="service_id" id="service_id" required>
                <option value="">Select Service</option>

                @foreach($services as $service)
                    <option value="{{ $service->id }}">
                        {{ $service->service_name }}
                        (₱{{ number_format($service->price, 2) }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-grid">

            <div class="form-group">
                <label>Appointment Date</label>
                <input type="date" id="date"
                    name="appointment_date"
                    onchange="loadSlots(this.value)"
                    required>
            </div>

            <div class="form-group">
                <label>Available Time Slots</label>
                <div id="slots" class="slots-container">
                    <small>Select a date first</small>
                </div>
            </div>

            <!-- Hidden inputs -->
            <input type="hidden" name="appointment_time" id="start_time">
            <input type="hidden" name="end_time" id="end_time">

        </div>

        <div class="form-group">
            <label>Reason for Visit</label>
            <textarea name="reason"></textarea>
        </div>

    </div>

    <div class="btn-group">
   <button type="button"
        class="btn-prev"
        onclick="prevStep()">

    <span class="arrow">
        <svg xmlns="http://www.w3.org/2000/svg"
             width="20"
             height="20"
             viewBox="0 0 24 24"
             fill="none"
             stroke="currentColor"
             stroke-width="3"
             stroke-linecap="round"
             stroke-linejoin="round">
            <polyline points="15 18 9 12 15 6"></polyline>
        </svg>
    </span>

    <span>Previous</span>

</button>
<button type="button"
        class="btn-next"
        onclick="nextStep()">

    <span>Next</span>

    <span class="arrow">
        <svg xmlns="http://www.w3.org/2000/svg"
             width="20"
             height="20"
             viewBox="0 0 24 24"
             fill="none"
             stroke="currentColor"
             stroke-width="3"
             stroke-linecap="round"
             stroke-linejoin="round">

            <polyline points="9 18 15 12 9 6"></polyline>

        </svg>
    </span>

</button>
    </div>


</div>

<!-- ============================= -->
<!-- STEP 2: APPOINTMENT SUMMARY -->
<!-- ============================= -->

<div class="form-step" id="step2">

    <!-- Summary Header -->
    <div class="summary-header">
        <div class="summary-header-icon">
            ✓
        </div>

        <div>
            <h2>Review Your Appointment</h2>
            <p>
                Please check all the information below before saving your appointment.
            </p>
        </div>
    </div>


    <!-- ============================= -->
    <!-- PATIENT INFORMATION -->
    <!-- ============================= -->

    <div class="summary-card">

        <div class="summary-card-header">
            <div>
                <span class="summary-number">01</span>
                <div>
                    <h3>Patient Information</h3>
                    <p>Personal information provided</p>
                </div>
            </div>

            <button type="button"
                    class="summary-edit"
                    onclick="previousStep()">
                Edit
            </button>
        </div>


        <div class="summary-grid">

            <div class="summary-item">
                <span>Full Name</span>
                <strong id="summary_patient_name">—</strong>
            </div>

            <div class="summary-item">
                <span>Age</span>
                <strong id="summary_age">—</strong>
            </div>

            <div class="summary-item">
                <span>Sex</span>
                <strong id="summary_sex">—</strong>
            </div>

            <div class="summary-item">
                <span>Civil Status</span>
                <strong id="summary_civil_status">—</strong>
            </div>

            <div class="summary-item">
                <span>Contact Number</span>
                <strong id="summary_tel_no">—</strong>
            </div>

            <div class="summary-item">
                <span>Occupation</span>
                <strong id="summary_occupation">—</strong>
            </div>

            <div class="summary-item full">
                <span>Address</span>
                <strong id="summary_address">—</strong>
            </div>

        </div>

    </div>


    <!-- ============================= -->
    <!-- MEDICAL HISTORY -->
    <!-- ============================= -->

    <div class="summary-card">

        <div class="summary-card-header">

            <div>
                <span class="summary-number">02</span>

                <div>
                    <h3>Medical History</h3>
                    <p>Health information provided</p>
                </div>
            </div>

            <button type="button"
                    class="summary-edit"
                    onclick="previousStep()">
                Edit
            </button>

        </div>


        <div class="medical-summary-grid">

            <div class="medical-summary-item">
                <span>Heart Condition</span>
                <strong id="summary_heart_condition">No</strong>
            </div>

            <div class="medical-summary-item">
                <span>Allergy</span>
                <strong id="summary_allergy">No</strong>
            </div>

            <div class="medical-summary-item">
                <span>Diabetes</span>
                <strong id="summary_diabetes">No</strong>
            </div>

            <div class="medical-summary-item">
                <span>Hypertension</span>
                <strong id="summary_hypertension">No</strong>
            </div>

            <div class="medical-summary-item">
                <span>Bleeding Tendency</span>
                <strong id="summary_bleeding_tendency">No</strong>
            </div>

            <div class="medical-summary-item">
                <span>Asthma</span>
                <strong id="summary_asthma">No</strong>
            </div>

        </div>


        <div class="summary-large-item">

            <span>Other Diseases / Treatments</span>

            <strong id="summary_other_conditions">
                None
            </strong>

        </div>

    </div>


    <!-- ============================= -->
    <!-- DENTAL INFORMATION -->
    <!-- ============================= -->

    <div class="summary-card">

        <div class="summary-card-header">

            <div>
                <span class="summary-number">03</span>

                <div>
                    <h3>Dental Information</h3>
                    <p>Selected teeth and dental information</p>
                </div>
            </div>

            <button type="button"
                    class="summary-edit"
                    onclick="previousStep()">
                Edit
            </button>

        </div>


        <div class="summary-large-item">

            <span>Selected Teeth</span>

            <div id="summary_teeth"
                 class="teeth-summary">

                No teeth selected

            </div>

        </div>

    </div>


    <!-- ============================= -->
    <!-- APPOINTMENT DETAILS -->
    <!-- ============================= -->

    <div class="summary-card appointment-summary-card">

        <div class="summary-card-header">

            <div>
                <span class="summary-number">04</span>

                <div>
                    <h3>Appointment Details</h3>
                    <p>Your selected dental appointment</p>
                </div>
            </div>

            <button type="button"
                    class="summary-edit"
                    onclick="previousStep()">
                Edit
            </button>

        </div>


        <div class="appointment-highlight">

            <div class="appointment-icon">
    <svg xmlns="http://www.w3.org/2000/svg"
         width="22"
         height="22"
         viewBox="0 0 24 24"
         fill="none"
         stroke="currentColor"
         stroke-width="2"
         stroke-linecap="round"
         stroke-linejoin="round">

        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
        <line x1="16" y1="2" x2="16" y2="6"></line>
        <line x1="8" y1="2" x2="8" y2="6"></line>
        <line x1="3" y1="10" x2="21" y2="10"></line>

    </svg>
</div>

            <div>
                <span>Appointment Date</span>

                <strong id="summary_date">
                    —
                </strong>
            </div>

        </div>


        <div class="appointment-highlight">

          <div class="appointment-icon">
    <svg xmlns="http://www.w3.org/2000/svg"
         width="22"
         height="22"
         viewBox="0 0 24 24"
         fill="none"
         stroke="currentColor"
         stroke-width="2"
         stroke-linecap="round"
         stroke-linejoin="round">

        <circle cx="12" cy="12" r="9"></circle>
        <polyline points="12 7 12 12 15 15"></polyline>

    </svg>
</div>

            <div>
                <span>Appointment Time</span>

                <strong id="summary_time">
                    —
                </strong>
            </div>

        </div>


        <div class="summary-grid">

            <div class="summary-item full">

                <span>Dental Service</span>

                <strong id="summary_service">
                    —
                </strong>

            </div>


            <div class="summary-item full">

                <span>Reason for Visit</span>

                <strong id="summary_reason">
                    —
                </strong>

            </div>

        </div>

    </div>


    <!-- ============================= -->
    <!-- FINAL REVIEW NOTICE -->
    <!-- ============================= -->

    <div class="final-review-box">

        <div class="final-review-icon">
            !
        </div>

        <div>

            <h4>Final Review</h4>

            <p>
                Please review your information carefully.
                This summary is provided to help prevent errors
                in your appointment details.
            </p>

            <p>
                If you find anything incorrect, click
                <strong>Previous</strong> to edit your information.
            </p>

        </div>

    </div>


    <!-- ============================= -->
    <!-- SUMMARY BUTTONS -->
    <!-- ============================= -->

 <div class="summary-buttons">

    <button type="button"
            class="btn-previous"
            onclick="previousStep()">

        <span class="arrow">
            <svg xmlns="http://www.w3.org/2000/svg"
                 width="20"
                 height="20"
                 viewBox="0 0 24 24"
                 fill="none"
                 stroke="currentColor"
                 stroke-width="3"
                 stroke-linecap="round"
                 stroke-linejoin="round">
                <polyline points="15 18 9 12 15 6"></polyline>
            </svg>
        </span>

        <span>Previous</span>

    </button>


    <button type="submit"
            class="btn-save">

        <span>
            Save Appointment
        </span>

        <span class="save-icon">
            ✓
        </span>

    </button>

</div>
</div>

<!-- ============================= -->
<!-- STEP 3 - CONFIRMED -->
<!-- ============================= -->

<div class="form-step" id="step3">

    <div class="confirmed-container">

        <!-- SUCCESS ICON -->
        <div class="confirmed-icon">

            <svg xmlns="http://www.w3.org/2000/svg"
                 width="45"
                 height="45"
                 viewBox="0 0 24 24"
                 fill="none"
                 stroke="currentColor"
                 stroke-width="2.5"
                 stroke-linecap="round"
                 stroke-linejoin="round">

                <path d="M20 6L9 17l-5-5"></path>

            </svg>

        </div>


        <!-- THANK YOU -->
        <h1>
            Thank You for Booking Our Services!
        </h1>


        <!-- SAVED MESSAGE -->
        <p class="confirmed-message">
            Your appointment was successfully saved.
        </p>


        <p class="confirmed-description">
            We have received your appointment request.
            Please keep your appointment details for your reference.
        </p>


        <!-- STATUS -->
        <div class="confirmed-status">

            <div class="status-icon">

                <svg xmlns="http://www.w3.org/2000/svg"
                     width="20"
                     height="20"
                     viewBox="0 0 24 24"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="2.5"
                     stroke-linecap="round"
                     stroke-linejoin="round">

                    <path d="M20 6L9 17l-5-5"></path>

                </svg>

            </div>

            <div>
                <span>Appointment Status</span>
                <strong>Saved Successfully</strong>
            </div>

        </div>


        <!-- APPOINTMENT INFORMATION -->
        <div class="confirmed-details">

            <h3>
                Appointment Details
            </h3>


            <div class="confirmed-detail-row">

                <span>
                    Appointment Date
                </span>

                <strong id="confirmed_date">
                    —
                </strong>

            </div>


            <div class="confirmed-detail-row">

                <span>
                    Appointment Time
                </span>

                <strong id="confirmed_time">
                    —
                </strong>

            </div>


            <div class="confirmed-detail-row">

                <span>
                    Dental Service
                </span>

                <strong id="confirmed_service">
                    —
                </strong>

            </div>

        </div>


        <!-- NEXT STEP MESSAGE -->
        <div class="confirmed-notice">

            <div class="notice-icon">

                <svg xmlns="http://www.w3.org/2000/svg"
                     width="20"
                     height="20"
                     viewBox="0 0 24 24"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="2"
                     stroke-linecap="round"
                     stroke-linejoin="round">

                    <circle cx="12"
                            cy="12"
                            r="10">
                    </circle>

                    <line x1="12"
                          y1="16"
                          x2="12"
                          y2="12">
                    </line>

                    <line x1="12"
                          y1="8"
                          x2="12.01"
                          y2="8">
                    </line>

                </svg>

            </div>

            <p>
                Please arrive on time for your appointment.
                If you need to make any changes, you can check
                your appointment history.
            </p>

        </div>


        <!-- ACTION BUTTONS -->
        <div class="confirmed-actions">

            <button type="button"
                    class="btn-confirmed-print"
                    onclick="window.print()">

                <svg xmlns="http://www.w3.org/2000/svg"
                     width="19"
                     height="19"
                     viewBox="0 0 24 24"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="2"
                     stroke-linecap="round"
                     stroke-linejoin="round">

                    <polyline points="6 9 6 2 18 2 18 9"></polyline>

                    <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path>

                    <rect x="6"
                          y="14"
                          width="12"
                          height="8">
                    </rect>

                </svg>

                Print Appointment

            </button>


            <a href="{{ route('appointments.history') }}"
               class="btn-confirmed-history">

                <svg xmlns="http://www.w3.org/2000/svg"
                     width="19"
                     height="19"
                     viewBox="0 0 24 24"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="2"
                     stroke-linecap="round"
                     stroke-linejoin="round">

                    <path d="M3 12a9 9 0 1 0 3-6.7"></path>

                    <polyline points="3 4 3 10 9 10"></polyline>

                    <polyline points="12 7 12 12 15 15"></polyline>

                </svg>

                Appointment History

            </a>

        </div>

    </div>

</div>




</div>


</div>




    <script src="{{ asset('js/booking.js') }}"></script>
</body>
</html>
