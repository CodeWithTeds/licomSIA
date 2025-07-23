@extends('layouts.admin')

@section('header', 'Admission Details')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">Admission Details</h1>
            <a href="{{ route('admin.admissions.index') }}" class="text-indigo-600 hover:text-indigo-900">
                <i class="fas fa-arrow-left mr-2"></i>Back to Admissions
            </a>
        </div>

        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h2 class="text-xl font-semibold mb-4 border-b pb-2">Applicant Information</h2>
                    <div class="grid grid-cols-2 gap-4">
                        <p><strong>First Name:</strong></p><p>{{ $admission->first_name }}</p>
                        <p><strong>Last Name:</strong></p><p>{{ $admission->last_name }}</p>
                        <p><strong>Email:</strong></p><p>{{ $admission->email }}</p>
                        <p><strong>Date of Birth:</strong></p><p>{{ $admission->date_of_birth }}</p>
                        <p><strong>Gender:</strong></p><p>{{ $admission->gender }}</p>
                        <p><strong>Phone Number:</strong></p><p>{{ $admission->phone_number }}</p>
                    </div>
                </div>
                <div>
                    <h2 class="text-xl font-semibold mb-4 border-b pb-2">Address Information</h2>
                    <div class="grid grid-cols-2 gap-4">
                        <p><strong>Address:</strong></p><p>{{ $admission->address }}</p>
                        <p><strong>City:</strong></p><p>{{ $admission->city }}</p>
                        <p><strong>State:</strong></p><p>{{ $admission->state }}</p>
                        <p><strong>Zip Code:</strong></p><p>{{ $admission->zip_code }}</p>
                    </div>
                </div>
                <div>
                    <h2 class="text-xl font-semibold mb-4 border-b pb-2">Academic Information</h2>
                    <div class="grid grid-cols-2 gap-4">
                        <p><strong>Program:</strong></p><p>{{ $admission->program->program_name ?? 'N/A' }}</p>
                        <p><strong>Previous School:</strong></p><p>{{ $admission->previous_school_name }}</p>
                        <p><strong>Year of Graduation:</strong></p><p>{{ $admission->previous_school_graduation_year }}</p>
                    </div>
                </div>
                <div>
                    <h2 class="text-xl font-semibold mb-4 border-b pb-2">Application Status</h2>
                    <p class="text-lg font-medium 
                        @if($admission->application_status === 'approved') text-green-600 @elseif($admission->application_status === 'rejected') text-red-600 @else text-yellow-600 @endif">
                        {{ ucfirst($admission->application_status) }}
                    </p>
                </div>
            </div>

            @if($admission->application_status === 'Pending')
                <div class="mt-8 flex justify-end space-x-4">
                    <form action="{{ route('admin.admissions.reject', $admission) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-red-500 text-white px-6 py-2 rounded-md hover:bg-red-600">Reject</button>
                    </form>
                    <form action="{{ route('admin.admissions.approve', $admission) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-green-500 text-white px-6 py-2 rounded-md hover:bg-green-600">Approve</button>
                    </form>
                </div>
            @endif
        </div>
    </div>
@endsection 