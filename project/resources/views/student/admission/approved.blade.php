@extends('layouts.student')

@section('title', 'Admission Approved')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white/70 backdrop-blur-sm rounded-2xl shadow-lg p-8 text-center">
        
        <div class="mb-8">
            <i class="fas fa-check-circle text-green-500 text-7xl animate-pulse"></i>
        </div>

        <h1 class="text-4xl font-extrabold text-gray-800 mb-4">Congratulations, {{ $admission->first_name }}!</h1>
        
        <p class="text-gray-600 text-lg mb-6">
            Your application for the <strong>{{ $admission->program->program_name }}</strong> program has been approved!
        </p>

        <div class="bg-blue-50 border-2 border-dashed border-blue-200 rounded-lg p-6 mb-8">
            <p class="text-gray-700 mb-2">Your official student number is:</p>
            <p class="text-3xl font-bold text-primary tracking-widest">{{ $admission->student->student_number }}</p>
        </div>

        <div class="text-left bg-gray-50 rounded-lg p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">What's Next?</h2>
            <ul class="list-disc list-inside space-y-3 text-gray-600">
               
                <li>
                    <strong>Complete Enrollment:</strong> Proceed to the enrollment section to officially enroll for the upcoming semester.
                </li>
                <li>
                    <strong>Prepare Your Documents:</strong> Make sure you have all the necessary original documents ready for submission.
                </li>
            </ul>
        </div>
        
        <div class="mt-10">
            <a href="{{ route('student.dashboard') }}" class="px-8 py-4 bg-primary text-white font-semibold rounded-lg shadow-md hover:bg-primary/90 transition-transform transform hover:scale-105">
                Go to Dashboard
            </a>
        </div>
    </div>
</div>
@endsection 