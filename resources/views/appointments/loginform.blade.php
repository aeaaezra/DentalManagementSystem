<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Login | Shine & Smile</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen flex items-center justify-center bg-gray-100">

    <!-- BACK BUTTON -->
    <a href="{{ url('/appointments/welcome') }}"
       class="fixed top-6 left-6 flex items-center gap-2
              text-base font-semibold text-slate-600
              hover:text-#E91E63-500 transition duration-200 group">
        <span class="text-xl transform group-hover:-translate-x-1 transition">←</span>
        Back
    </a>

    <!-- CARD -->
    <div class="max-w-md w-full bg-white rounded-2xl shadow-2xl p-8 border border-gray-100">

        <!-- HEADER -->
        <div class="text-center mb-8">

            <div class="w-20 h-20 bg-[#FFFFFF] rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-10 h-10 text-[#E91E63]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10m-11 9h12a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v11a2 2 0 0 0 2 2z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 15l2 2 4-4" />
                </svg>
            </div>

            <h1 class="text-2xl font-bold text-gray-800 uppercase tracking-tight">
                Appointment Login
            </h1>

            <p class="text-gray-500 mt-2">
                Shine and Smile Dental Clinic
            </p>
        </div>

        <!-- FORM -->
        <form method="POST" action="{{ route('appointment.loginform.post') }}" method="POST" class="space-y-6">
            @csrf

            <!-- EMAIL -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Email Address
                </label>

                <input type="email" name="email" required
                    class="w-full px-4 py-3 rounded-lg border border-gray-300
                           focus:ring-2 focus:ring-[#E91E63] focus:border-[#E91E63] outline-none"
                    placeholder="patient@gmail.com">

                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- PASSWORD -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Password
                </label>

                <div class="relative">

                    <input id="password" type="password" name="password" required
                        class="w-full px-4 py-3 pr-14 rounded-lg border border-gray-300
                               focus:ring-2 focus:ring-[#E91E63] focus:border-[#E91E63] outline-none"
                        placeholder="••••••••">

                    <!-- EYE TOGGLE -->
                    <button type="button"
                        onclick="togglePassword()"
                        class="absolute inset-y-0 right-0 flex items-center px-4">

                        <svg id="eyeOpen" class="w-6 h-6 text-[#E91E63]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7Z" />
                        </svg>

                        <svg id="eyeClosed" class="w-6 h-6 text-[#E91E63] hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3l18 18" />
                        </svg>

                    </button>
                </div>

                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- REMEMBER -->
            <div class="flex items-center justify-between">
                <label class="flex items-center gap-2 text-sm text-gray-600 cursor-pointer">
                    <input type="checkbox" name="remember"
                        class="rounded border-gray-300 text-[#E91E63]">
                    Remember me
                </label>

                <a href="{{ route('password.request') }}"
                   class="text-sm text-[#E91E63] hover:text-[#E]">
                    Forgot password?
                </a>
            </div>

            <!-- SIGN IN BUTTON (FIXED) -->

            <button
                type="submit"
                class=  "w-full bg-[#E91E63] text-white font-bold py-3 rounded-lg
                        hover:bg-[#FCE4EC] transition shadow-lg shadow-blue-200">
                Sign In
            </button>


        </form>

        <p class="text-center text-xs text-gray-400 mt-8 uppercase tracking-widest font-semibold">
            Authorized Personnel Only
        </p>
    </div>

    <!-- SCRIPT -->
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
