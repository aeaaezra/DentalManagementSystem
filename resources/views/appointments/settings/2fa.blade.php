<!DOCTYPE html>
<html>
<head>
    <title>Google Authenticator</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body class="bg-pink-50 flex justify-center items-center min-h-screen">

<div class="bg-white shadow-xl rounded-xl p-8 w-[500px]">

    <h2 class="text-2xl font-bold text-pink-600 mb-5">

        Google Authenticator Setup

    </h2>

    <p class="mb-3">

        Scan this QR Code using the
        <strong>Google Authenticator</strong>
        app.

    </p>

    <div class="flex justify-center">

        {!! QrCode::size(250)->generate($qrCodeUrl) !!}

    </div>

    <div class="mt-5">

        <label class="font-semibold">

            Manual Setup Key

        </label>

        <input
            class="border w-full rounded-lg p-2 mt-2"
            readonly
            value="{{ $secret }}">

    </div>
<form action="{{ route('settings.2fa.verify') }}" method="POST">
    @csrf

    <input
        type="text"
        name="otp"
        value="{{ old('otp') }}"
        maxlength="6"
        autocomplete="one-time-code"
        placeholder="Enter the 6-digit code"
        class="border w-full rounded-lg p-3 mt-5 @error('otp') border-red-500 @enderror">

    @error('otp')
        <div class="mt-2 rounded-lg bg-red-100 border border-red-300 text-red-700 p-3">
            {{ $message }}
        </div>
    @enderror

    <button
        type="submit"
        id="enableBtn"
        class="bg-pink-500 hover:bg-pink-600 text-white w-full py-3 rounded-lg mt-4">

        Enable 2FA

    </button>
</form>



</div>
<script>
document.querySelector("form").addEventListener("submit", function () {

    const btn = document.getElementById("enableBtn");

    btn.disabled = true;
    btn.innerHTML = "Verifying...";

});
</script>
</body>
</html>
