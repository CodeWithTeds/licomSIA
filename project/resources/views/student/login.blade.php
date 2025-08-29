<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LicomSIA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#2768bc',
                        secondary: '#cccb62',
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-blue-900 to-blue-600 min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full bg-white rounded-xl shadow-2xl overflow-hidden">
        <div class="p-8">
            <div class="text-center mb-8">
                <img src="{{ asset('images/logo.png') }}" alt="LicomSIA Logo" class="h-16 mx-auto mb-2">
                <h1 class="text-2xl font-bold text-gray-800">LicomSIA Login</h1>
                <p class="text-gray-500 text-sm">Access your Libon Community College account</p>
            </div>
            
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif
            
            @if(session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                    <p>{{ session('error') }}</p>
                </div>
            @endif
            
            <form id="loginForm" action="{{ route('login.submit') }}" method="POST" class="space-y-6">
                @csrf
                
                <div class="space-y-4">
                    <div>
                        
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-gray-400"></i>
                            </div>
                            <input id="email" name="email" type="email" required 
                                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg
                                text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2
                                focus:ring-primary focus:border-primary transition duration-150" 
                                placeholder="Email address" value="{{ old('email') }}">
                        </div>
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400"></i>
                            </div>
                            <input id="password" name="password" type="password" required 
                                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg
                                text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2
                                focus:ring-primary focus:border-primary transition duration-150" 
                                placeholder="Password">
                        </div>
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox" 
                            class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                        <label for="remember" class="ml-2 block text-sm text-gray-700">
                            Remember me
                        </label>
                    </div>

                    <div class="text-sm">
                        <a href="{{ route('password.request') }}" class="font-medium text-primary hover:text-blue-800 transition duration-150">
                            Forgot password?
                        </a>
                    </div>
                </div>

                <button type="submit" 
                    class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg
                    text-white bg-primary hover:bg-blue-700 focus:outline-none focus:ring-2
                    focus:ring-offset-2 focus:ring-primary transition duration-150 font-medium">
                    Sign in
                </button>
                
                <div class="text-center text-sm">
                    <span class="text-gray-500">Don't have an account?</span>
                    <a href="{{ route('student.register') }}" class="font-medium text-primary hover:text-blue-800 ml-1 transition duration-150 student-only">
                        Register now
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
       
    </script>
</body>
</html> 