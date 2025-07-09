@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="mb-6">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-primary transition-colors">
                        <i class="fas fa-home mr-2"></i>
                        Dashboard
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                        <a href="{{ route('admin.students.index') }}" class="ml-1 text-gray-700 hover:text-primary transition-colors md:ml-2">Students</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Edit Student</span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>

    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Edit Student</h1>
            <p class="text-gray-600 mt-1">Update student information</p>
        </div>

        <form action="{{ route('admin.students.update', $student->student_id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Personal Information -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-user-circle mr-2 text-primary"></i>
                        Personal Information
                    </h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label for="admission_id" class="block text-sm font-medium text-gray-700 mb-1">Admission ID</label>
                            <input type="number" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-primary focus:border-primary transition-colors @error('admission_id') border-red-500 @enderror" 
                                   id="admission_id" 
                                   name="admission_id" 
                                   value="{{ old('admission_id', $student->admission_id) }}"
                                   placeholder="Enter admission ID">
                            @error('admission_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">First Name <span class="text-red-500">*</span></label>
                            <input type="text" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-primary focus:border-primary transition-colors @error('first_name') border-red-500 @enderror" 
                                   id="first_name" 
                                   name="first_name" 
                                   value="{{ old('first_name', $student->first_name) }}" 
                                   required>
                            @error('first_name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">Last Name <span class="text-red-500">*</span></label>
                            <input type="text" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-primary focus:border-primary transition-colors @error('last_name') border-red-500 @enderror" 
                                   id="last_name" 
                                   name="last_name" 
                                   value="{{ old('last_name', $student->last_name) }}" 
                                   required>
                            @error('last_name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="birthdate" class="block text-sm font-medium text-gray-700 mb-1">Birth Date <span class="text-red-500">*</span></label>
                            <input type="date" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-primary focus:border-primary transition-colors @error('birthdate') border-red-500 @enderror" 
                                   id="birthdate" 
                                   name="birthdate" 
                                   value="{{ old('birthdate', $student->birthdate ? $student->birthdate->format('Y-m-d') : '') }}" 
                                   required>
                            @error('birthdate')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address <span class="text-red-500">*</span></label>
                            <textarea class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-primary focus:border-primary transition-colors @error('address') border-red-500 @enderror" 
                                      id="address" 
                                      name="address" 
                                      rows="3" 
                                      required>{{ old('address', $student->address) }}</textarea>
                            @error('address')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="contact_number" class="block text-sm font-medium text-gray-700 mb-1">Contact Number <span class="text-red-500">*</span></label>
                            <input type="text" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-primary focus:border-primary transition-colors @error('contact_number') border-red-500 @enderror" 
                                   id="contact_number" 
                                   name="contact_number" 
                                   value="{{ old('contact_number', $student->contact_number) }}" 
                                   required>
                            @error('contact_number')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <!-- Academic Information -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-graduation-cap mr-2 text-primary"></i>
                        Academic Information
                    </h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label for="program_id" class="block text-sm font-medium text-gray-700 mb-1">Program <span class="text-red-500">*</span></label>
                            <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-primary focus:border-primary transition-colors @error('program_id') border-red-500 @enderror" 
                                    id="program_id" 
                                    name="program_id" 
                                    required>
                                <option value="">Select Program</option>
                                @foreach ($programs as $program)
                                    <option value="{{ $program->program_id }}" {{ old('program_id', $student->program_id) == $program->program_id ? 'selected' : '' }}>
                                        {{ $program->program_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('program_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="year_level" class="block text-sm font-medium text-gray-700 mb-1">Year Level <span class="text-red-500">*</span></label>
                            <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-primary focus:border-primary transition-colors @error('year_level') border-red-500 @enderror" 
                                    id="year_level" 
                                    name="year_level" 
                                    required>
                                <option value="">Select Year Level</option>
                                <option value="1" {{ old('year_level', $student->year_level) == 1 ? 'selected' : '' }}>1st Year</option>
                                <option value="2" {{ old('year_level', $student->year_level) == 2 ? 'selected' : '' }}>2nd Year</option>
                                <option value="3" {{ old('year_level', $student->year_level) == 3 ? 'selected' : '' }}>3rd Year</option>
                                <option value="4" {{ old('year_level', $student->year_level) == 4 ? 'selected' : '' }}>4th Year</option>
                                <option value="5" {{ old('year_level', $student->year_level) == 5 ? 'selected' : '' }}>5th Year</option>
                            </select>
                            @error('year_level')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status <span class="text-red-500">*</span></label>
                            <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-primary focus:border-primary transition-colors @error('status') border-red-500 @enderror" 
                                    id="status" 
                                    name="status" 
                                    required>
                                <option value="Pending" {{ old('status', $student->status) == 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Enrolled" {{ old('status', $student->status) == 'Enrolled' ? 'selected' : '' }}>Enrolled</option>
                                <option value="Dropped" {{ old('status', $student->status) == 'Dropped' ? 'selected' : '' }}>Dropped</option>
                                <option value="Graduated" {{ old('status', $student->status) == 'Graduated' ? 'selected' : '' }}>Graduated</option>
                            </select>
                            @error('status')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email <span class="text-red-500">*</span></label>
                            <input type="email" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-primary focus:border-primary transition-colors @error('email') border-red-500 @enderror" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email', $student->email) }}" 
                                   required>
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Action Buttons -->
            <div class="flex justify-end space-x-3 mt-8 pt-6 border-t border-gray-200">
                <a href="{{ route('admin.students.index') }}" 
                   class="px-6 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition-colors duration-200 flex items-center">
                    <i class="fas fa-times mr-2"></i>
                    Cancel
                </a>
                <button type="submit" 
                        class="px-6 py-2 bg-primary text-white rounded-md hover:bg-primary-dark transition-colors duration-200 flex items-center">
                    <i class="fas fa-save mr-2"></i>
                    Update Student
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 