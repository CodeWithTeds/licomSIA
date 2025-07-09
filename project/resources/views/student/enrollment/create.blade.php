@extends('layouts.student')

@section('content')
<div class="container py-8">
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Enrollment Form</h1>
            <a href="{{ route('student.dashboard') }}" class="text-blue-600 hover:text-blue-800">
                <i class="fas fa-arrow-left mr-1"></i> Back to Dashboard
            </a>
        </div>

        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                <p>{{ session('error') }}</p>
            </div>
        @endif

        <!-- Enrollment Steps -->
        <div class="mb-8">
            <div class="flex items-center justify-between mb-2">
                <div class="flex items-center">
                    <div class="bg-blue-600 text-white w-8 h-8 rounded-full flex items-center justify-center font-bold">1</div>
                    <span class="ml-2 font-medium">Select Courses</span>
                </div>
                <div class="flex-1 mx-4 h-1 bg-gray-200">
                    <div class="bg-blue-600 h-1 w-1/3"></div>
                </div>
                <div class="flex items-center">
                    <div class="bg-gray-200 text-gray-600 w-8 h-8 rounded-full flex items-center justify-center font-bold">2</div>
                    <span class="ml-2 font-medium text-gray-600">Review</span>
                </div>
                <div class="flex-1 mx-4 h-1 bg-gray-200"></div>
                <div class="flex items-center">
                    <div class="bg-gray-200 text-gray-600 w-8 h-8 rounded-full flex items-center justify-center font-bold">3</div>
                    <span class="ml-2 font-medium text-gray-600">Submit</span>
                </div>
            </div>
        </div>

        <div class="bg-blue-50 rounded-lg p-6 mb-8">
            <h2 class="text-xl font-semibold text-blue-800 mb-2">Enrollment Information</h2>
            <p class="text-gray-600 mb-4">
                <strong>Student:</strong> {{ $student->first_name }} {{ $student->last_name }}<br>
                <strong>Program:</strong> {{ $program->program_name }}<br>
                <strong>School Year:</strong> {{ $schoolYear }}<br>
                <strong>Semester:</strong> {{ $semester }}
            </p>
        </div>

        <form action="{{ route('student.enrollment.store') }}" method="POST">
            @csrf
            <input type="hidden" name="school_year" value="{{ $schoolYear }}">
            <input type="hidden" name="semester" value="{{ $semester }}">

            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Available Courses</h3>
                
                @if($courses->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-200">
                            <thead>
                                <tr>
                                    <th class="py-3 px-4 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-b">Select</th>
                                    <th class="py-3 px-4 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-b">Course Name</th>
                                    <th class="py-3 px-4 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-b">Units</th>
                                    <th class="py-3 px-4 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-b">Instructor</th>
                                    <th class="py-3 px-4 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-b">Schedule</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($courses as $course)
                                    <tr class="hover:bg-gray-50">
                                        <td class="py-3 px-4 border-b border-gray-200">
                                            <input type="checkbox" name="courses[]" value="{{ $course->course_id }}" class="rounded text-blue-600 focus:ring-blue-500">
                                        </td>
                                        <td class="py-3 px-4 border-b border-gray-200">{{ $course->course_name }}</td>
                                        <td class="py-3 px-4 border-b border-gray-200">{{ $course->units }}</td>
                                        <td class="py-3 px-4 border-b border-gray-200">
                                            @if($course->instructor)
                                                {{ $course->instructor->first_name }} {{ $course->instructor->last_name }}
                                            @else
                                                TBA
                                            @endif
                                        </td>
                                        <td class="py-3 px-4 border-b border-gray-200">
                                            @if($course->schedules->count() > 0)
                                                @foreach($course->schedules as $schedule)
                                                    <div class="mb-1">
                                                        {{ $schedule->day }} {{ $schedule->time_start->format('h:i A') }} - {{ $schedule->time_end->format('h:i A') }}, Room {{ $schedule->room }}
                                                    </div>
                                                @endforeach
                                            @else
                                                TBA
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-6">
                        <p class="text-sm text-gray-600 mb-4">
                            <i class="fas fa-info-circle text-blue-600 mr-1"></i>
                            Please select the courses you wish to enroll in. Make sure to check the schedule to avoid conflicts.
                        </p>
                    </div>
                @else
                    <div class="bg-gray-50 rounded-lg p-6 text-center">
                        <p class="text-gray-600">No courses available for your program at this time.</p>
                    </div>
                @endif
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded transition-colors">
                    Continue to Review <i class="fas fa-arrow-right ml-1"></i>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 