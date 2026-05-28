<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dental Supply Login | Shine & Smile</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex items-center justify-center bg-gray-100">

    <div class="max-w-md w-full bg-white rounded-2xl shadow-2xl p-8 border border-gray-100">
        <div class="text-center mb-8">
            <div class="w-20 h-20 bg-[#ffe4ec] rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-10 h-10 text-[#db2777]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 15v2m-6 4h12a2 2 0 0 0 2-2v-6a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2zm10-10V7a4 4 0 0 0-8 0v4h8" />
                </svg>
            </div>

            <h1 class="text-2xl font-bold text-gray-800 uppercase tracking-tight">Dental Supply Login</h1>
            <p class="text-gray-500 mt-2">Shine and Smile Dental Clinic</p>
        </div>

        @if (session('status'))
            <div class="mb-4 text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <div>
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                    Email Address
                </label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    autocomplete="username"
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#db2777] focus:border-[#db2777] outline-none transition"
                    placeholder="admin@shineandsmile.com"
                >
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                    Password
                </label>

                <div class="relative">
                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        class="w-full px-4 py-3 pr-14 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#db2777] focus:border-[#db2777] outline-none transition"
                        placeholder="••••••••"
                    >

                    <button
                        type="button"
                        onclick="togglePassword()"
                        class="absolute inset-y-0 right-0 flex items-center px-4 text-[#db2777]"
                    >
                        <svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7Z" />
                        </svg>

                        <svg id="eyeClosed" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3l18 18" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10.584 10.587a2 2 0 0 0 2.829 2.828" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.88 5.09A9.953 9.953 0 0 1 12 5c4.478 0 8.268 2.943 9.542 7a9.97 9.97 0 0 1-4.132 5.411M6.228 6.227A9.956 9.956 0 0 0 2.458 12c1.274 4.057 5.064 7 9.542 7a9.95 9.95 0 0 0 5.197-1.46" />
                        </svg>
                    </button>
                </div>

                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <label for="remember_me" class="flex items-center gap-2 text-sm text-gray-600 cursor-pointer">
                    <input
                        id="remember_me"
                        type="checkbox"
                        name="remember"
                        class="rounded border-gray-300 text-[#db2777] shadow-sm focus:ring-[#db2777]"
                    >
                    <span>Remember me</span>
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-[#db2777] hover:text-[#c02269]">
                        Forgot password?
                    </a>
                @endif
            </div>

            <div class="space-y-3 pt-2">
                <button
                    type="submit"
                    class="w-full bg-[#db2777] text-white font-bold py-3 rounded-lg hover:bg-[#c02269] transition shadow-lg shadow-pink-200"
                >
                    Sign In
                </button>

                <div class="relative py-2">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-200"></div>
                    </div>
                    <div class="relative flex justify-center text-xs uppercase">
                        <span class="bg-white px-2 text-gray-400 font-medium">New to Shine & Smile?</span>
                    </div>
                </div>

                @if (Route::has('register'))
                    <a
                        href="{{ route('register') }}"
                        class="block w-full text-center border-2 border-[#db2777] text-[#db2777] font-bold py-3 rounded-lg hover:bg-[#fff0f5] transition"
                    >
                        Create New Account
                    </a>
                @endif
            </div>
        </form>

        <p class="text-center text-xs text-gray-400 mt-8 uppercase tracking-widest font-semibold">
            Authorized Personnel Only
        </p>
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
