<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Google Authentication</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-pink-50 flex justify-center items-center min-h-screen">

<div class="bg-white w-[450px] rounded-xl shadow-xl p-8">

    <h1 class="text-2xl font-bold text-pink-600 mb-2">
        Two-Factor Authentication
    </h1>

    <p class="text-gray-600 mb-6">
        Enter the 6-digit code from your Google Authenticator app.
    </p>

    <form action="{{ route('2fa.login.verify') }}" method="POST">

        @csrf

        <input
            type="text"
            name="otp"
            maxlength="6"
            autocomplete="one-time-code"
            placeholder="Enter 6-digit code"
            value="{{ old('otp') }}"
            class="w-full border rounded-lg p-3 @error('otp') border-red-500 @enderror">

        @error('otp')
            <div class="mt-3 bg-red-100 border border-red-300 text-red-700 rounded-lg p-3">
                {{ $message }}
            </div>
        @enderror

        <button
            type="submit"
            class="bg-pink-500 hover:bg-pink-600 text-white w-full py-3 rounded-lg mt-5">

            Verify Code

        </button>

    </form>

</div>

</body>
</html>
