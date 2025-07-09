@extends('layouts.student')

@section('content')
<div class="container mx-auto max-w-4xl py-8 px-4">
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Enrollment Details</h1>
            <a href="{{ route('student.dashboard') }}" class="text-primary hover:text-blue-800 flex items-center">
                <i class="fas fa-arrow-left mr-1"></i> Back to Dashboard
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @if(session('info'))
            <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 mb-6" role="alert">
                <p>{{ session('info') }}</p>
            </div>
        @endif

        <!-- Status Card -->
        <div class="mb-6">
            @if($enrollment->status == 'Pending')
                <div class="bg-yellow-50 rounded-lg border border-yellow-200 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <div class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-yellow-100">
                                <i class="fas fa-clock text-yellow-600"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-yellow-800">Enrollment Pending</h3>
                            <div class="mt-1 text-sm text-yellow-700">
                                <p>Your enrollment request is currently being processed. Please check back later for updates.</p>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif($enrollment->status == 'Approved')
                <div class="bg-green-50 rounded-lg border border-green-200 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <div class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-green-100">
                                <i class="fas fa-check text-green-600"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-green-800">Enrollment Approved</h3>
                            <div class="mt-1 text-sm text-green-700">
                                <p>Your enrollment has been approved! Please proceed to the finance office to complete your enrollment process.</p>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif($enrollment->status == 'Rejected')
                <div class="bg-red-50 rounded-lg border border-red-200 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <div class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-red-100">
                                <i class="fas fa-times text-red-600"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-red-800">Enrollment Rejected</h3>
                            <div class="mt-1 text-sm text-red-700">
                                <p>Your enrollment has been rejected. Please contact the registrar's office for more information.</p>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif($enrollment->status == 'Enrolled')
                <div class="bg-blue-50 rounded-lg border border-blue-200 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <div class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-blue-100">
                                <i class="fas fa-user-graduate text-blue-600"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-blue-800">Officially Enrolled</h3>
                            <div class="mt-1 text-sm text-blue-700">
                                <p>You are officially enrolled! Welcome to the new semester. Classes will begin according to the academic calendar.</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <!-- Enrollment Info Card -->
            <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden">
                <div class="bg-gray-50 px-4 py-3 border-b border-gray-200">
                    <h2 class="text-lg font-medium text-gray-800">Enrollment Information</h2>
                </div>
                <div class="p-4">
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600 font-medium">School Year:</span>
                            <span class="text-gray-900">{{ $enrollment->school_year }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600 font-medium">Semester:</span>
                            <span class="text-gray-900">{{ $enrollment->semester }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600 font-medium">Date Enrolled:</span>
                            <span class="text-gray-900">
                                @if($enrollment->date_enrolled instanceof \Carbon\Carbon)
                                    {{ $enrollment->date_enrolled->format('F d, Y') }}
                                @else
                                    {{ \Carbon\Carbon::parse($enrollment->date_enrolled)->format('F d, Y') }}
                                @endif
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600 font-medium">Status:</span>
                            <span class="px-2 py-1 text-xs rounded-full 
                                @if($enrollment->status == 'Approved') bg-green-100 text-green-800
                                @elseif($enrollment->status == 'Pending') bg-yellow-100 text-yellow-800
                                @elseif($enrollment->status == 'Rejected') bg-red-100 text-red-800
                                @elseif($enrollment->status == 'Enrolled') bg-blue-100 text-blue-800
                                @elseif($enrollment->status == 'Dropped') bg-gray-100 text-gray-800
                                @elseif($enrollment->status == 'Graduated') bg-purple-100 text-purple-800
                                @endif">
                                {{ $enrollment->status }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Student Info Card -->
            <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden">
                <div class="bg-gray-50 px-4 py-3 border-b border-gray-200">
                    <h2 class="text-lg font-medium text-gray-800">Student Information</h2>
                </div>
                <div class="p-4">
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600 font-medium">Student Name:</span>
                            <span class="text-gray-900">{{ $enrollment->student->first_name }} {{ $enrollment->student->last_name }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600 font-medium">Student ID:</span>
                            <span class="text-gray-900">{{ $enrollment->student->student_number }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600 font-medium">Program:</span>
                            <span class="text-gray-900">{{ $enrollment->student->program->program_name }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600 font-medium">Year Level:</span>
                            <span class="text-gray-900">{{ $enrollment->student->year_level }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-8">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Enrolled Courses</h3>
            
            @if($enrollment->enrollmentCourses->count() > 0)
                <div class="overflow-x-auto bg-white rounded-lg border border-gray-200 shadow-sm">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Course</th>
                                <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Units</th>
                                <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Year Level</th>
                                <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Schedule</th>
                                <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Midterm</th>
                                <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Finals</th>
                                <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Remarks</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($enrollment->enrollmentCourses as $enrollmentCourse)
                                <tr class="hover:bg-gray-50">
                                    <td class="py-3 px-4 text-sm text-gray-900">{{ $enrollmentCourse->course->course_name }}</td>
                                    <td class="py-3 px-4 text-sm text-gray-900">{{ $enrollmentCourse->course->units }}</td>
                                    <td class="py-3 px-4 text-sm text-gray-900">{{ $enrollmentCourse->course->year_level }}</td>
                                    <td class="py-3 px-4 text-sm text-gray-500">
                                        @if($enrollmentCourse->course->schedules && $enrollmentCourse->course->schedules->count() > 0)
                                            @foreach($enrollmentCourse->course->schedules as $schedule)
                                                <div class="mb-1">
                                                    {{ $schedule->day }} {{ $schedule->time_start }} - {{ $schedule->time_end }}<br>
                                                    Room {{ $schedule->room }}
                                                </div>
                                            @endforeach
                                        @else
                                            <span class="text-gray-400">TBA</span>
                                        @endif
                                    </td>
                                    <td class="py-3 px-4 text-sm text-gray-900">
                                        @if($enrollmentCourse->grade_midterm)
                                            {{ $enrollmentCourse->grade_midterm }}
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </td>
                                    <td class="py-3 px-4 text-sm text-gray-900">
                                        @if($enrollmentCourse->grade_finals)
                                            {{ $enrollmentCourse->grade_finals }}
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </td>
                                    <td class="py-3 px-4 text-sm text-gray-900">
                                        @if($enrollmentCourse->remarks)
                                            {{ $enrollmentCourse->remarks }}
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="bg-gray-50 rounded-lg p-6 text-center border border-gray-200">
                    <p class="text-gray-600">No courses enrolled.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection 