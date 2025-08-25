<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex items-center justify-center bg-gray-100 p-4">
    <div class="max-w-md w-full bg-white rounded-xl shadow p-6">
        <h1 class="text-2xl font-bold mb-2">Forgot your password?</h1>
        <p class="text-gray-600 mb-4">Enter your email and we'll send you a password reset link.</p>

        @if (session('status'))
            <div class="bg-green-100 border border-green-300 text-green-800 p-3 rounded mb-4">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required class="mt-1 w-full border rounded p-2">
                @error('email')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white rounded p-2 hover:bg-blue-700">Email Password Reset Link</button>
        </form>

        <div class="text-center mt-4">
            <a href="{{ route('student.login') }}" class="text-blue-600 hover:underline">Back to Login</a>
        </div>
    </div>
 </body>
</html>


