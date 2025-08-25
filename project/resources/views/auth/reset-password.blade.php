<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex items-center justify-center bg-gray-100 p-4">
    <div class="max-w-md w-full bg-white rounded-xl shadow p-6">
        <h1 class="text-2xl font-bold mb-2">Reset your password</h1>
        <p class="text-gray-600 mb-4">Enter a new password for your account.</p>

        <form method="POST" action="{{ route('password.store') }}" class="space-y-4">
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div>
                <label class="block text-sm font-medium">Email</label>
                <input type="email" name="email" value="{{ old('email', $request->email) }}" required class="mt-1 w-full border rounded p-2">
                @error('email')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium">Password</label>
                <input type="password" name="password" required class="mt-1 w-full border rounded p-2">
                @error('password')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium">Confirm Password</label>
                <input type="password" name="password_confirmation" required class="mt-1 w-full border rounded p-2">
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white rounded p-2 hover:bg-blue-700">Reset Password</button>
        </form>

        <div class="text-center mt-4">
            <a href="{{ route('student.login') }}" class="text-blue-600 hover:underline">Back to Login</a>
        </div>
    </div>
 </body>
</html>


