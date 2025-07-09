@extends('layouts.student')

@section('content')
<div class="container py-8">
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Enrollment Details</h1>
            <a href="{{ route('student.dashboard') }}" class="text-blue-600 hover:text-blue-800">
                <i class="fas fa-arrow-left mr-1"></i> Back to Dashboard
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <div class="bg-blue-50 rounded-lg p-6 mb-8">
            <h2 class="text-xl font-semibold text-blue-800 mb-4">Enrollment Information</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <p class="text-gray-600">
                        <span class="font-medium">School Year:</span> {{ $enrollment->school_year }}<br>
                        <span class="font-medium">Semester:</span> {{ $enrollment->semester }}<br>
                        <span class="font-medium">Date Enrolled:</span> {{ $enrollment->date_enrolled->format('F d, Y') }}
                    </p>
                </div>
                <div>
                    <p class="text-gray-600">
                        <span class="font-medium">Status:</span> 
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
                    </p>
                </div>
            </div>
        </div>

        <div class="mb-8">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Enrolled Courses</h3>
            
            @if($enrollment->enrollmentCourses->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200">
                        <thead>
                            <tr>
                                <th class="py-3 px-4 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-b">Course</th>
                                <th class="py-3 px-4 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-b">Units</th>
                                <th class="py-3 px-4 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-b">Schedule</th>
                                <th class="py-3 px-4 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-b">Midterm Grade</th>
                                <th class="py-3 px-4 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-b">Final Grade</th>
                                <th class="py-3 px-4 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-b">Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($enrollment->enrollmentCourses as $enrollmentCourse)
                                <tr class="hover:bg-gray-50">
                                    <td class="py-3 px-4 border-b border-gray-200">{{ $enrollmentCourse->course->course_name }}</td>
                                    <td class="py-3 px-4 border-b border-gray-200">{{ $enrollmentCourse->course->units }}</td>
                                    <td class="py-3 px-4 border-b border-gray-200">
                                        @if($enrollmentCourse->course->schedules->count() > 0)
                                            @foreach($enrollmentCourse->course->schedules as $schedule)
                                                <div class="mb-1">
                                                    {{ $schedule->day }} {{ $schedule->time_start->format('h:i A') }} - {{ $schedule->time_end->format('h:i A') }}<br>
                                                    Room {{ $schedule->room }}
                                                </div>
                                            @endforeach
                                        @else
                                            TBA
                                        @endif
                                    </td>
                                    <td class="py-3 px-4 border-b border-gray-200">
                                        @if($enrollmentCourse->grade_midterm)
                                            {{ $enrollmentCourse->grade_midterm }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="py-3 px-4 border-b border-gray-200">
                                        @if($enrollmentCourse->grade_finals)
                                            {{ $enrollmentCourse->grade_finals }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="py-3 px-4 border-b border-gray-200">
                                        @if($enrollmentCourse->remarks)
                                            {{ $enrollmentCourse->remarks }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="bg-gray-50 rounded-lg p-6 text-center">
                    <p class="text-gray-600">No courses enrolled.</p>
                </div>
            @endif
        </div>

        @if($enrollment->status == 'Pending')
            <div class="bg-yellow-50 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-6" role="alert">
                <p class="font-medium">Your enrollment is pending approval.</p>
                <p>Please wait for the administrator to review and approve your enrollment request.</p>
            </div>
        @elseif($enrollment->status == 'Approved')
            <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                <p class="font-medium">Your enrollment has been approved!</p>
                <p>Please proceed to the finance office to complete your enrollment process.</p>
            </div>
        @elseif($enrollment->status == 'Rejected')
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                <p class="font-medium">Your enrollment has been rejected.</p>
                <p>Please contact the registrar's office for more information.</p>
            </div>
        @elseif($enrollment->status == 'Enrolled')
            <div class="bg-blue-50 border-l-4 border-blue-500 text-blue-700 p-4 mb-6" role="alert">
                <p class="font-medium">You are officially enrolled!</p>
                <p>Welcome to the new semester. Classes will begin according to the academic calendar.</p>
            </div>
        @endif
    </div>
</div>
@endsection 