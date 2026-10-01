<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auth System</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            background: #ffffff; /* ✅ FIXED WHITE BACKGROUND */
        }

        .card {
            background: #ffffff;
            border: 1px solid #f1f5f9;
        }

        input:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(219, 39, 119, 0.2);
            border-color: #db2777;
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center p-4">



 <a href="{{ url('/') }}"
       class="fixed top-6 left-6 flex items-center gap-2
              text-base font-semibold text-slate-600
              hover:text-pink-500 transition duration-200 group">
        <span class="text-xl transform group-hover:-translate-x-1 transition">←</span>
        Back
    </a>

<div class="card w-full max-w-md rounded-2xl shadow-xl p-8">

    <!-- REGISTER -->
    <div>
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-gray-800">Create Account</h2>
            <p class="text-gray-500 mt-2">Join our system</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf

            <!-- NAME -->
            <div>
                <label class="text-sm font-medium">Full Name</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                    class="w-full px-4 py-3 rounded-lg border mt-1">
                @error('name')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- EMAIL -->
            <div>
                <label class="text-sm font-medium">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                    class="w-full px-4 py-3 rounded-lg border mt-1">
                @error('email')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- PASSWORD -->
            <div>
                <label class="text-sm font-medium">Password</label>
                <input type="password" name="password" required
                    class="w-full px-4 py-3 rounded-lg border mt-1">
                @error('password')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- CONFIRM PASSWORD -->
            <div>
                <label class="text-sm font-medium">Confirm Password</label>
                <input type="password" name="password_confirmation" required
                    class="w-full px-4 py-3 rounded-lg border mt-1">
            </div>

            <!-- BUTTON -->
            <button type="submit"
                class="w-full bg-pink-600 text-white py-3 rounded-lg font-bold hover:bg-pink-700">
                Register
            </button>

            <!-- LOGIN LINK -->
            <p class="text-center text-sm">
                Already have an account?
                <a href="{{ route('login') }}" class="text-pink-600 font-bold">Login</a>
            </p>
        </form>
    </div>

</div>

</body>
</html>
