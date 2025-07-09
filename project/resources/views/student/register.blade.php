<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration - LicomSIA</title>
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
<body class="bg-gradient-to-br from-blue-900 to-blue-600 min-h-screen py-8 px-4">
    <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-2xl overflow-hidden">
        <div class="p-8">
            <div class="text-center mb-8">
                <img src="{{ asset('images/logo.png') }}" alt="LicomSIA Logo" class="h-16 mx-auto mb-2">
                <h1 class="text-2xl font-bold text-gray-800">Create Student Account</h1>
                <p class="text-gray-500 text-sm">Join the Libon Community College</p>
            </div>
            
            @if(session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                    <p>{{ session('error') }}</p>
                </div>
            @endif
            
            <form action="{{ route('student.register.submit') }}" method="POST" class="space-y-8">
                @csrf
                
                <!-- Personal Information -->
                <div class="bg-gray-50 p-6 rounded-lg border border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-user-circle text-primary mr-2"></i>
                        Personal Information
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                            <input id="first_name" name="first_name" type="text" required 
                                class="block w-full px-3 py-2 border border-gray-300 
                                rounded-lg text-gray-900 focus:outline-none focus:ring-2
                                focus:ring-primary focus:border-primary transition duration-150" 
                                placeholder="John" value="{{ old('first_name') }}">
                            @error('first_name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                            <input id="last_name" name="last_name" type="text" required 
                                class="block w-full px-3 py-2 border border-gray-300 
                                rounded-lg text-gray-900 focus:outline-none focus:ring-2
                                focus:ring-primary focus:border-primary transition duration-150" 
                                placeholder="Doe" value="{{ old('last_name') }}">
                            @error('last_name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-4">
                        <label for="gender" class="block text-sm font-medium text-gray-700 mb-1">Gender</label>
                        <select id="gender" name="gender" required 
                            class="block w-full px-3 py-2 border border-gray-300 
                            rounded-lg text-gray-900 focus:outline-none focus:ring-2
                            focus:ring-primary focus:border-primary transition duration-150">
                            <option value="">Select gender</option>
                            <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                            <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('gender')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <label for="birth_date" class="block text-sm font-medium text-gray-700 mb-1">Birth Date</label>
                        <input id="birth_date" name="birth_date" type="date" required 
                            class="block w-full px-3 py-2 border border-gray-300 
                            rounded-lg text-gray-900 focus:outline-none focus:ring-2
                            focus:ring-primary focus:border-primary transition duration-150" 
                            value="{{ old('birth_date') }}">
                        @error('birth_date')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mt-4">
                        <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                        <textarea id="address" name="address" required 
                            class="block w-full px-3 py-2 border border-gray-300 
                            rounded-lg text-gray-900 focus:outline-none focus:ring-2
                            focus:ring-primary focus:border-primary transition duration-150" 
                            placeholder="Your complete address" rows="2">{{ old('address') }}</textarea>
                        @error('address')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mt-4">
                        <label for="contact" class="block text-sm font-medium text-gray-700 mb-1">Contact Number</label>
                        <input id="contact" name="contact" type="text" required 
                            class="block w-full px-3 py-2 border border-gray-300 
                            rounded-lg text-gray-900 focus:outline-none focus:ring-2
                            focus:ring-primary focus:border-primary transition duration-150" 
                            placeholder="09XXXXXXXXX" value="{{ old('contact') }}">
                        @error('contact')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Academic Information -->
                <div class="bg-gray-50 p-6 rounded-lg border border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-graduation-cap text-primary mr-2"></i>
                        Academic Information
                    </h3>
                    
                    <div>
                        <label for="program_id" class="block text-sm font-medium text-gray-700 mb-1">Program</label>
                        <select id="program_id" name="program_id" required 
                            class="block w-full px-3 py-2 border border-gray-300 
                            rounded-lg text-gray-900 focus:outline-none focus:ring-2
                            focus:ring-primary focus:border-primary transition duration-150">
                            <option value="">Select a program</option>
                            @foreach($programs as $program)
                                <option value="{{ $program->program_id }}" {{ old('program_id') == $program->program_id ? 'selected' : '' }}>
                                    {{ $program->program_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('program_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mt-4">
                        <label for="year_level" class="block text-sm font-medium text-gray-700 mb-1">Year Level</label>
                        <select id="year_level" name="year_level" required 
                            class="block w-full px-3 py-2 border border-gray-300 
                            rounded-lg text-gray-900 focus:outline-none focus:ring-2
                            focus:ring-primary focus:border-primary transition duration-150">
                            <option value="">Select year level</option>
                            <option value="1" {{ old('year_level') == '1' ? 'selected' : '' }}>First Year</option>
                            <option value="2" {{ old('year_level') == '2' ? 'selected' : '' }}>Second Year</option>
                            <option value="3" {{ old('year_level') == '3' ? 'selected' : '' }}>Third Year</option>
                            <option value="4" {{ old('year_level') == '4' ? 'selected' : '' }}>Fourth Year</option>
                        </select>
                        @error('year_level')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <!-- Account Setup -->
                <div class="bg-gray-50 p-6 rounded-lg border border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-user-lock text-primary mr-2"></i>
                        Account Setup
                    </h3>
                    
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-gray-400"></i>
                            </div>
                            <input id="email" name="email" type="email" autocomplete="email" required 
                                class="block w-full pl-10 pr-3 py-2 border border-gray-300 
                                rounded-lg text-gray-900 focus:outline-none focus:ring-2
                                focus:ring-primary focus:border-primary transition duration-150" 
                                placeholder="you@example.com" value="{{ old('email') }}">
                        </div>
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mt-4">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400"></i>
                            </div>
                            <input id="password" name="password" type="password" autocomplete="new-password" required 
                                class="block w-full pl-10 pr-3 py-2 border border-gray-300 
                                rounded-lg text-gray-900 focus:outline-none focus:ring-2
                                focus:ring-primary focus:border-primary transition duration-150" 
                                placeholder="••••••••">
                        </div>
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mt-4">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400"></i>
                            </div>
                            <input id="password_confirmation" name="password_confirmation" type="password" required 
                                class="block w-full pl-10 pr-3 py-2 border border-gray-300 
                                rounded-lg text-gray-900 focus:outline-none focus:ring-2
                                focus:ring-primary focus:border-primary transition duration-150" 
                                placeholder="••••••••">
                        </div>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div class="text-sm">
                        <span class="text-gray-500">Already have an account?</span>
                        <a href="{{ route('student.login') }}" class="font-medium text-primary hover:text-blue-800 ml-1 transition duration-150">
                            Sign in
                        </a>
                    </div>
                    
                    <button type="submit" 
                        class="w-full sm:w-auto flex justify-center py-2 px-8 border border-transparent 
                        text-sm font-medium rounded-lg text-white bg-primary hover:bg-blue-700 
                        focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition duration-150">
                        Register
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html> 