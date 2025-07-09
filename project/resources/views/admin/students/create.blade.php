@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 text-2xl font-semibold text-gray-800">Add New Student</h1>
    <nav class="flex" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-primary">
                    <i class="fas fa-home mr-2"></i>
                    Dashboard
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                    <a href="{{ route('admin.students.index') }}" class="ml-1 text-gray-700 hover:text-primary md:ml-2">Students</a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Add Student</span>
                </div>
            </li>
        </ol>
    </nav>
    
    <div class="bg-white rounded-lg shadow-md p-6">
        <form action="{{ route('admin.students.store') }}" method="POST">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <h4 class="text-lg font-medium text-gray-700 mb-4">Personal Information</h4>
                    
                    <div class="mb-4">
                        <label for="admission_id" class="block text-sm font-medium text-gray-700 mb-1">Admission ID <span class="text-red-600">*</span></label>
                        <input type="number" class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 @error('admission_id') border-red-500 @enderror" id="admission_id" name="admission_id" value="{{ old('admission_id') }}" required>
                        @error('admission_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">First Name <span class="text-red-600">*</span></label>
                        <input type="text" class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 @error('first_name') border-red-500 @enderror" id="first_name" name="first_name" value="{{ old('first_name') }}" required>
                        @error('first_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">Last Name <span class="text-red-600">*</span></label>
                        <input type="text" class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 @error('last_name') border-red-500 @enderror" id="last_name" name="last_name" value="{{ old('last_name') }}" required>
                        @error('last_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="birth_date" class="block text-sm font-medium text-gray-700 mb-1">Birth Date <span class="text-red-600">*</span></label>
                        <input type="date" class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 @error('birth_date') border-red-500 @enderror" id="birth_date" name="birth_date" value="{{ old('birth_date') }}" required>
                        @error('birth_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address <span class="text-red-600">*</span></label>
                        <textarea class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 @error('address') border-red-500 @enderror" id="address" name="address" rows="3" required>{{ old('address') }}</textarea>
                        @error('address')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="contact" class="block text-sm font-medium text-gray-700 mb-1">Contact Number <span class="text-red-600">*</span></label>
                        <input type="text" class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 @error('contact') border-red-500 @enderror" id="contact" name="contact" value="{{ old('contact') }}" required>
                        @error('contact')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div>
                    <h4 class="text-lg font-medium text-gray-700 mb-4">Academic Information</h4>
                    
                    <div class="mb-4">
                        <label for="program_id" class="block text-sm font-medium text-gray-700 mb-1">Program <span class="text-red-600">*</span></label>
                        <select class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 @error('program_id') border-red-500 @enderror" id="program_id" name="program_id" required>
                            <option value="">Select Program</option>
                            @foreach ($programs as $program)
                                <option value="{{ $program->program_id }}" {{ old('program_id') == $program->program_id ? 'selected' : '' }}>
                                    {{ $program->program_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('program_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="year_level" class="block text-sm font-medium text-gray-700 mb-1">Year Level <span class="text-red-600">*</span></label>
                        <select class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 @error('year_level') border-red-500 @enderror" id="year_level" name="year_level" required>
                            <option value="">Select Year Level</option>
                            <option value="1" {{ old('year_level') == 1 ? 'selected' : '' }}>1st Year</option>
                            <option value="2" {{ old('year_level') == 2 ? 'selected' : '' }}>2nd Year</option>
                            <option value="3" {{ old('year_level') == 3 ? 'selected' : '' }}>3rd Year</option>
                            <option value="4" {{ old('year_level') == 4 ? 'selected' : '' }}>4th Year</option>
                            <option value="5" {{ old('year_level') == 5 ? 'selected' : '' }}>5th Year</option>
                        </select>
                        @error('year_level')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <h4 class="text-lg font-medium text-gray-700 mb-4 mt-6">Account Information</h4>
                    
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email <span class="text-red-600">*</span></label>
                        <input type="email" class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 @error('email') border-red-500 @enderror" id="email" name="email" value="{{ old('email') }}" required>
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password <span class="text-red-600">*</span></label>
                        <input type="password" class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 @error('password') border-red-500 @enderror" id="password" name="password" required>
                        <p class="mt-1 text-xs text-gray-500">Password must be at least 8 characters long.</p>
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="flex justify-end space-x-3">
                <a href="{{ route('admin.students.index') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition-colors">Cancel</a>
                <button type="submit" class="px-4 py-2 bg-primary text-white rounded-md hover:bg-primary-dark transition-colors">Create Student</button>
            </div>
        </form>
    </div>
</div>
@endsection 