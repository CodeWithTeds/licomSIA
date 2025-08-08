@extends('layouts.student')

@section('title', 'Admission Status')

@section('content')
<div class="bg-white p-8 rounded-lg shadow-md">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Admission Status</h1>

    @if ($admission)
        <div class="mb-6">
            @if($admission->application_status == 'Pending')
                <div class="bg-yellow-50 rounded-lg border border-yellow-200 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <div class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-yellow-100">
                                <i class="fas fa-clock text-yellow-600"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-yellow-800">Admission Pending</h3>
                            <div class="mt-1 text-sm text-yellow-700">
                                <p>Your admission application is currently under review. Please check back later for updates.</p>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif($admission->application_status == 'approved')
                <div class="bg-green-50 rounded-lg border border-green-200 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <div class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-green-100">
                                <i class="fas fa-check text-green-600"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-green-800">Admission Approved</h3>
                            <div class="mt-1 text-sm text-green-700">
                                <p>Congratulations! Your admission has been approved. You can now proceed with enrollment.</p>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif($admission->application_status == 'rejected')
                <div class="bg-red-50 rounded-lg border border-red-200 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <div class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-red-100">
                                <i class="fas fa-times text-red-600"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-red-800">Admission Rejected</h3>
                            <div class="mt-1 text-sm text-red-700">
                                <p>We regret to inform you that your admission has been rejected. Please contact the admissions office for more information.</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Admission Info -->
            <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden">
                <div class="bg-gray-50 px-4 py-3 border-b border-gray-200">
                    <h2 class="text-lg font-medium text-gray-800">Admission Information</h2>
                </div>
                <div class="p-4 space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-600 font-medium">Application Date:</span>
                        <span class="text-gray-900">{{ $admission->created_at->format('F d, Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600 font-medium">Program:</span>
                        <span class="text-gray-900">{{ $admission->program_applied_for }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600 font-medium">Status:</span>
                        <span class="px-2 py-1 text-xs rounded-full 
                            @if($admission->application_status == 'approved') bg-green-100 text-green-800
                            @elseif($admission->application_status == 'Pending') bg-yellow-100 text-yellow-800
                            @elseif($admission->application_status == 'rejected') bg-red-100 text-red-800
                            @endif">
                            {{ $admission->application_status }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Student Info -->
            <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden">
                <div class="bg-gray-50 px-4 py-3 border-b border-gray-200">
                    <h2 class="text-lg font-medium text-gray-800">Your Information</h2>
                </div>
                <div class="p-4 space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-600 font-medium">Name:</span>
                        <span class="text-gray-900">{{ $student->first_name }} {{ $student->last_name }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600 font-medium">Email:</span>
                        <span class="text-gray-900">{{ $student->email }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600 font-medium">Contact Number:</span>
                        <span class="text-gray-900">{{ $student->contact_number }}</span>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="bg-blue-50 rounded-lg border border-blue-200 p-6 text-center">
            <h3 class="text-lg font-medium text-blue-800">No Admission Record Found</h3>
            <p class="mt-2 text-sm text-blue-700">It looks like you haven't started an admission application yet.</p>
            <div class="mt-6">
                <a href="{{ route('student.admission.create') }}" class="px-6 py-3 bg-primary text-white font-semibold rounded-lg shadow-md hover:bg-primary/90 transition">
                    Start Your Application Now
                </a>
            </div>
        </div>
    @endif

    <div class="flex justify-end mt-6">
        <a href="{{ route('student.dashboard') }}" class="text-primary hover:text-primary-dark font-medium">
            &larr; Back to Dashboard
        </a>
    </div>
</div>
@endsection
