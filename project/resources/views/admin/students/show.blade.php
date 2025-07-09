@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Breadcrumb -->
    <nav class="flex mb-6" aria-label="Breadcrumb">
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
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Student Details</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Header with Actions -->
    <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div class="mb-4 md:mb-0">
                <h1 class="text-3xl font-bold text-gray-800">{{ $student->first_name }} {{ $student->last_name }}</h1>
                <p class="text-gray-600 mt-1">Student ID: {{ $student->student_number }}</p>
                <div class="flex items-center mt-2">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                        @if($student->status == 'Enrolled') bg-green-100 text-green-800
                        @elseif($student->status == 'Pending') bg-yellow-100 text-yellow-800
                        @elseif($student->status == 'Dropped') bg-red-100 text-red-800
                        @elseif($student->status == 'Graduated') bg-blue-100 text-blue-800
                        @else bg-gray-100 text-gray-800 @endif">
                        <i class="fas fa-circle mr-2 text-xs"></i>
                        {{ $student->status }}
                    </span>
                </div>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('admin.students.edit', $student->student_id) }}" 
                   class="inline-flex items-center px-4 py-2 bg-primary text-white rounded-md hover:bg-primary-dark transition-colors duration-200">
                    <i class="fas fa-edit mr-2"></i>
                    Edit Student
                </a>
                <form action="{{ route('admin.students.destroy', $student->student_id) }}" method="POST" 
                      onsubmit="return confirm('Are you sure you want to delete this student?')" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors duration-200">
                        <i class="fas fa-trash mr-2"></i>
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Student Profile Card -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-primary to-primary-dark px-6 py-4">
                    <h3 class="text-lg font-semibold text-white flex items-center">
                        <i class="fas fa-user-circle mr-2"></i>
                        Student Profile
                    </h3>
                </div>
                
                <div class="p-6">
                    <!-- Profile Picture Placeholder -->
                    <div class="text-center mb-6">
                        <div class="w-32 h-32 bg-gray-200 rounded-full mx-auto flex items-center justify-center mb-4">
                            <i class="fas fa-user-graduate text-4xl text-gray-400"></i>
                        </div>
                        <h4 class="text-xl font-semibold text-gray-800">{{ $student->first_name }} {{ $student->last_name }}</h4>
                        <p class="text-gray-600">{{ $student->student_number }}</p>
                    </div>

                    <!-- Personal Information -->
                    <div class="space-y-4">
                        <h5 class="font-semibold text-gray-800 border-b border-gray-200 pb-2">Personal Information</h5>
                        
                        <div class="flex justify-between items-center py-2">
                            <span class="text-gray-600 text-sm">Full Name:</span>
                            <span class="font-medium text-gray-800">{{ $student->first_name }} {{ $student->last_name }}</span>
                        </div>
                        
                        @if($student->admission_id)
                        <div class="flex justify-between items-center py-2">
                            <span class="text-gray-600 text-sm">Admission ID:</span>
                            <span class="font-medium text-gray-800">{{ $student->admission_id }}</span>
                        </div>
                        @endif
                        
                        <div class="flex justify-between items-center py-2">
                            <span class="text-gray-600 text-sm">Birth Date:</span>
                            <span class="font-medium text-gray-800">{{ $student->birthdate ? $student->birthdate->format('F d, Y') : 'Not specified' }}</span>
                        </div>
                        
                        <div class="flex justify-between items-center py-2">
                            <span class="text-gray-600 text-sm">Gender:</span>
                            <span class="font-medium text-gray-800">{{ $student->gender ?? 'Not specified' }}</span>
                        </div>
                    </div>

                    <!-- Contact Information -->
                    <div class="space-y-4 mt-6">
                        <h5 class="font-semibold text-gray-800 border-b border-gray-200 pb-2">Contact Information</h5>
                        
                        <div class="flex justify-between items-center py-2">
                            <span class="text-gray-600 text-sm">Email:</span>
                            <span class="font-medium text-gray-800">{{ $student->email }}</span>
                        </div>
                        
                        <div class="flex justify-between items-center py-2">
                            <span class="text-gray-600 text-sm">Contact:</span>
                            <span class="font-medium text-gray-800">{{ $student->contact_number }}</span>
                        </div>
                        
                        <div class="py-2">
                            <span class="text-gray-600 text-sm block mb-1">Address:</span>
                            <span class="font-medium text-gray-800">{{ $student->address }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Academic Information -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-secondary to-yellow-500 px-6 py-4">
                    <h3 class="text-lg font-semibold text-white flex items-center">
                        <i class="fas fa-graduation-cap mr-2"></i>
                        Academic Information
                    </h3>
                </div>
                
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Program Details -->
                        <div>
                            <h5 class="font-semibold text-gray-800 border-b border-gray-200 pb-2 mb-4">Program Details</h5>
                            <div class="space-y-3">
                                <div class="flex justify-between items-center py-2">
                                    <span class="text-gray-600 text-sm">Program:</span>
                                    <span class="font-medium text-gray-800">{{ $student->program->program_name }}</span>
                                </div>
                                
                                <div class="flex justify-between items-center py-2">
                                    <span class="text-gray-600 text-sm">Department:</span>
                                    <span class="font-medium text-gray-800">{{ $student->program->department->department_name }}</span>
                                </div>
                                
                                <div class="flex justify-between items-center py-2">
                                    <span class="text-gray-600 text-sm">Year Level:</span>
                                    <span class="font-medium text-gray-800">{{ $student->year_level }}</span>
                                </div>
                                
                                <div class="flex justify-between items-center py-2">
                                    <span class="text-gray-600 text-sm">Status:</span>
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                        @if($student->status == 'Enrolled') bg-green-100 text-green-800
                                        @elseif($student->status == 'Pending') bg-yellow-100 text-yellow-800
                                        @elseif($student->status == 'Dropped') bg-red-100 text-red-800
                                        @elseif($student->status == 'Graduated') bg-blue-100 text-blue-800
                                        @else bg-gray-100 text-gray-800 @endif">
                                        {{ $student->status }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Account Information -->
                        <div>
                            <h5 class="font-semibold text-gray-800 border-b border-gray-200 pb-2 mb-4">Account Information</h5>
                            <div class="space-y-3">
                                <div class="flex justify-between items-center py-2">
                                    <span class="text-gray-600 text-sm">Username:</span>
                                    <span class="font-medium text-gray-800">{{ $student->user->name }}</span>
                                </div>
                                
                                <div class="flex justify-between items-center py-2">
                                    <span class="text-gray-600 text-sm">Account Email:</span>
                                    <span class="font-medium text-gray-800">{{ $student->user->email }}</span>
                                </div>
                                
                                <div class="flex justify-between items-center py-2">
                                    <span class="text-gray-600 text-sm">Role:</span>
                                    <span class="font-medium text-gray-800 capitalize">{{ $student->user->role }}</span>
                                </div>
                                
                                <div class="flex justify-between items-center py-2">
                                    <span class="text-gray-600 text-sm">Joined:</span>
                                    <span class="font-medium text-gray-800">{{ $student->user->created_at->format('M d, Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Enrollment History -->
                    <div class="mt-8">
                        <h5 class="font-semibold text-gray-800 border-b border-gray-200 pb-2 mb-4">Enrollment History</h5>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="text-center text-gray-500">
                                <i class="fas fa-calendar-times text-3xl mb-2"></i>
                                <p class="text-sm">No enrollment records found</p>
                                <p class="text-xs text-gray-400 mt-1">This section will show enrollment history when available</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 