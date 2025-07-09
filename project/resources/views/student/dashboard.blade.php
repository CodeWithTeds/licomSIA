@extends('layouts.student')

@section('content')
<div class="container py-8">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Student Dashboard</h1>
        
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                <p>{{ session('error') }}</p>
            </div>
        @endif
        
        <div class="bg-blue-50 rounded-lg p-6 mb-8">
            <h2 class="text-xl font-semibold text-blue-800 mb-2">Welcome, {{ $student->first_name }}!</h2>
            <p class="text-gray-600">
                Student Number: <span class="font-medium">{{ $student->student_number }}</span><br>
                Program: <span class="font-medium">{{ $student->program->program_name }}</span>
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm hover:shadow-md transition-shadow">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Enrollment</h3>
                <p class="text-gray-600 mb-4">Enroll in courses for the current semester. Select your preferred courses and submit your enrollment request.</p>
                <a href="{{ route('student.enrollment.create') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded transition-colors">
                    Enroll Now
                </a>
            </div>
            
            <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm hover:shadow-md transition-shadow">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Profile</h3>
                <p class="text-gray-600 mb-4">View and update your personal information. Keep your contact details up to date.</p>
                <a href="{{ route('student.profile') }}" class="inline-block bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded transition-colors">
                    View Profile
                </a>
            </div>
        </div>
        
        <div class="mb-8">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Your Enrollments</h2>
            
            @if($enrollments->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200">
                        <thead>
                            <tr>
                                <th class="py-3 px-4 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-b">School Year</th>
                                <th class="py-3 px-4 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-b">Semester</th>
                                <th class="py-3 px-4 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-b">Date Enrolled</th>
                                <th class="py-3 px-4 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-b">Status</th>
                                <th class="py-3 px-4 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-b">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($enrollments as $enrollment)
                                <tr class="hover:bg-gray-50">
                                    <td class="py-3 px-4 border-b border-gray-200">{{ $enrollment->school_year }}</td>
                                    <td class="py-3 px-4 border-b border-gray-200">{{ $enrollment->semester }}</td>
                                    <td class="py-3 px-4 border-b border-gray-200">{{ $enrollment->date_enrolled->format('M d, Y') }}</td>
                                    <td class="py-3 px-4 border-b border-gray-200">
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
                                    </td>
                                    <td class="py-3 px-4 border-b border-gray-200">
                                        <a href="{{ route('student.enrollment.show', $enrollment) }}" class="text-blue-600 hover:text-blue-800">View Details</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="bg-gray-50 rounded-lg p-6 text-center">
                    <p class="text-gray-600">You don't have any enrollments yet.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection 