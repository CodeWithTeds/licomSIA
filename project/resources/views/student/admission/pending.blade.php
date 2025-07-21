@extends('layouts.student')

@section('title', 'Admission Pending')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white/60 backdrop-blur-sm rounded-2xl shadow-lg p-8 text-center">
        <div class="w-24 h-24 bg-yellow-100 text-yellow-500 rounded-full flex items-center justify-center mx-auto mb-6">
            <i class="fas fa-hourglass-half text-5xl"></i>
        </div>
        <h1 class="text-4xl font-extrabold text-gray-800">Application Pending</h1>
        <p class="text-gray-600 mt-4 text-lg">
            Thank you for submitting your application! It is currently under review by our admissions team.
        </p>
        <div class="mt-8 bg-gray-50 p-6 rounded-xl border border-gray-200">
            <h2 class="font-semibold text-gray-700 mb-3">What's Next?</h2>
            <p class="text-gray-600">
                You will receive an email notification once your application has been processed. Please allow 5-7 business days for a response. In the meantime, you can check back here for status updates.
            </p>
        </div>
        <div class="mt-8">
            <a href="{{ route('student.dashboard') }}" class="px-6 py-3 bg-primary text-white font-semibold rounded-lg shadow-md hover:bg-primary/90 transition">
                Back to Dashboard
            </a>
        </div>
    </div>
</div>
@endsection 