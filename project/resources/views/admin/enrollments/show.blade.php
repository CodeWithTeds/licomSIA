@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Enrollment Details</h1>
        <a href="{{ route('admin.enrollments.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
            Back to Enrollments
        </a>
    </div>
    
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
    
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <!-- Student Information -->
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Student Information</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <p class="text-sm font-medium text-gray-500">Name</p>
                    <p class="text-sm text-gray-900">{{ $enrollment->student->first_name }} {{ $enrollment->student->last_name }}</p>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Student Number</p>
                    <p class="text-sm text-gray-900">{{ $enrollment->student->student_number }}</p>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Program</p>
                    <p class="text-sm text-gray-900">{{ $enrollment->student->program->program_name }}</p>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Year Level</p>
                    <p class="text-sm text-gray-900">
                        @if($enrollment->year_level)
                            @if($enrollment->year_level == 1)
                                First Year
                            @elseif($enrollment->year_level == 2)
                                Second Year
                            @elseif($enrollment->year_level == 3)
                                Third Year
                            @elseif($enrollment->year_level == 4)
                                Fourth Year
                            @else
                                {{ $enrollment->year_level }}
                            @endif
                        @else
                            {{ $enrollment->student->year_level ?? 'Not specified' }}
                        @endif
                    </p>
                </div>
            </div>
        </div>
        
        <!-- Enrollment Information -->
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Enrollment Information</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <p class="text-sm font-medium text-gray-500">School Year</p>
                    <p class="text-sm text-gray-900">{{ $enrollment->school_year }}</p>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Semester</p>
                    <p class="text-sm text-gray-900">{{ $enrollment->semester }}</p>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Date Enrolled</p>
                    <p class="text-sm text-gray-900">{{ $enrollment->date_enrolled->format('M d, Y') }}</p>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Status</p>
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                        @if($enrollment->status === 'Approved') bg-green-100 text-green-800
                        @elseif($enrollment->status === 'Pending') bg-yellow-100 text-yellow-800
                        @elseif($enrollment->status === 'Rejected') bg-red-100 text-red-800
                        @else bg-gray-100 text-gray-800
                        @endif">
                        {{ $enrollment->status }}
                    </span>
                </div>
            </div>
        </div>
        
        <!-- Enrolled Courses -->
        <div class="px-6 py-4">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Enrolled Courses</h2>
            @if($enrollment->enrollmentCourses->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Course Code</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Course Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Units</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($enrollment->enrollmentCourses as $enrollmentCourse)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $enrollmentCourse->course->course_code ?? 'N/A' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $enrollmentCourse->course->course_name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $enrollmentCourse->course->units }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-gray-500">No courses enrolled.</p>
            @endif
        </div>
        
        <!-- Actions -->
        @if($enrollment->status === 'Pending')
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
            <div class="flex space-x-3">
                <form action="{{ route('admin.enrollments.approve', $enrollment->enrollment_id) }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        <i class="fas fa-check mr-2"></i>Approve Enrollment
                    </button>
                </form>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection 