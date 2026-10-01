<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shine and Smile Online Dental Clinic</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            background: linear-gradient(135deg, #ffcce6 0%, #ffffff 100%);
            min-height: 100vh;
        }

        .login-card {
            border: 1px solid #ffb3d9;
            box-shadow: 0 4px 6px -1px rgba(255, 102, 178, 0.2);
        }
    </style>
</head>

<body class="flex items-center justify-center p-4">

<div class="max-w-4xl w-full bg-white rounded-2xl p-8 md:p-12 login-card flex flex-col md:flex-row gap-12 items-center">

    <!-- Left Side -->
    <div class="flex flex-col items-center text-center w-full md:w-1/2">

        <div class="w-full aspect-square border-4 border-dashed border-pink-200 rounded-lg flex flex-col items-center justify-center mb-6 text-pink-400 bg-pink-50">

        <img
            src="{{ asset('images/logo.jpg') }}"
            alt="Shine and Smile Logo"
            class="w-100 h-100 object-contain">



    </div>

        <h1 class="text-2xl font-bold text-pink-500">
            Welcome to Shine and Smile Online Dental Clinic
        </h1>

    </div>

    <!-- Right Side -->
    <div class="w-full md:w-1/2">

        <h2 class="text-3xl font-semibold text-pink-400 mb-2">
            Sign in to your account
        </h2>

        <p class="text-gray-500 mb-6">
            Welcome back, please enter your details.
        </p>

        {{-- Success Message --}}
        @if(session('success'))
            <div class="mb-4 p-3 rounded-lg bg-green-100 border border-green-300 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="mb-4 p-3 rounded-lg bg-red-100 border border-red-300 text-red-700">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form
            action="{{ route('login') }}"
            method="POST"
            class="space-y-4"
        >

            @csrf

            <!-- Email -->
            <div>

                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Email Address
                </label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    class="w-full p-3 border border-pink-200 rounded-md focus:ring-2 focus:ring-pink-400 focus:outline-none">

            </div>

            <!-- Password -->
           <div>
    <label class="block text-sm font-medium text-gray-700 mb-1">
        Password
    </label>

    <div class="relative">
        <input
            type="password"
            id="password"
            name="password"
            required
            class="w-full p-3 pr-12 border border-pink-200 rounded-md focus:ring-2 focus:ring-pink-400 focus:outline-none">

        <button
            type="button"
            onclick="togglePassword()"
            class="absolute inset-y-0 right-3 flex items-center text-gray-500 hover:text-pink-500">

            <!-- Eye SVG -->
            <svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg"
                class="w-5 h-5"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2">

                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943
                    9.542 7c-1.274 4.057-5.065 7-9.542
                    7S3.732 16.057 2.458 12z"/>

                <circle cx="12" cy="12" r="3"/>
            </svg>

            <!-- Eye Slash SVG -->
            <svg id="eyeClosed" xmlns="http://www.w3.org/2000/svg"
                class="w-5 h-5 hidden"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2">

                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M3 3l18 18"/>

                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M10.58 10.58A2 2 0 0012 14a2 2 0 001.42-.58"/>

                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9.88 5.09A9.77 9.77 0 0112 5c4.48
                    0 8.27 2.94 9.54 7a9.96 9.96 0 01-4.29
                    5.19M6.1 6.1A9.96 9.96 0 002.46
                    12a9.96 9.96 0 003.42 4.74"/>
            </svg>

        </button>
    </div>
</div>

            <!-- Remember -->
            <div class="flex items-center justify-between">

                <label class="flex items-center text-sm text-gray-600">

                    <input
                        type="checkbox"
                        name="remember"
                        class="mr-2 accent-pink-500">

                    Remember Me

                </label>

                @if (Route::has('password.request'))
                    <a
                        href="{{ route('password.request') }}"
                        class="text-sm text-pink-500 hover:underline">
                        Forgot Password?
                    </a>
                @endif

            </div>

            <!-- Login Button -->
            <button
                type="submit"
                class="w-full bg-pink-500 hover:bg-pink-600 transition text-white font-semibold py-3 rounded-full">

                Login

            </button>

        </form>

        <!-- Divider -->
        <div class="flex items-center my-6">

            <div class="flex-1 border-t border-gray-200"></div>

            <span class="px-3 text-gray-400 text-sm">
                OR
            </span>

            <div class="flex-1 border-t border-gray-200"></div>

        </div>

        <!-- Admin Login -->
        <div class="text-center">

            <a
                href="{{ route('filament.admin.auth.login') }}"
                class="text-pink-500 hover:text-pink-600 font-semibold hover:underline">

                Sign in as Administrator

            </a>

        </div>

    </div>

</div>

<script>
function togglePassword() {
    const password = document.getElementById('password');
    const eyeOpen = document.getElementById('eyeOpen');
    const eyeClosed = document.getElementById('eyeClosed');

    if (password.type === 'password') {
        password.type = 'text';
        eyeOpen.classList.add('hidden');
        eyeClosed.classList.remove('hidden');
    } else {
        password.type = 'password';
        eyeOpen.classList.remove('hidden');
        eyeClosed.classList.add('hidden');
    }
}
</script>
</body>
</html>
