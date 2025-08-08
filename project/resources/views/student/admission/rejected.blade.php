@extends('layouts.student')

@section('title', 'Admission Status')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white/70 backdrop-blur-sm rounded-2xl shadow-lg p-8 text-center">
        
        <div class="mb-8">
            <i class="fas fa-times-circle text-red-500 text-7xl"></i>
        </div>

        <h1 class="text-4xl font-extrabold text-gray-800 mb-4">Regarding Your Application</h1>
        
        <p class="text-gray-600 text-lg mb-6">
            We regret to inform you that your application for the <strong>{{ $admission->program_applied_for }}</strong> program could not be approved at this time.
        </p>

        <div class="bg-yellow-50 border-l-4 border-yellow-400 text-yellow-700 p-4 rounded-lg mb-8">
            <p>
                This decision does not reflect your potential, and we encourage you to consider applying again in the future.
            </p>
        </div>

        <div class="text-left bg-gray-50 rounded-lg p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Have Questions?</h2>
            <p class="text-gray-600">
                If you have any questions regarding this decision, please feel free to contact our admissions office at:
            </p>
            <ul class="list-none mt-4 space-y-2">
                <li><i class="fas fa-envelope mr-2 text-primary"></i> <a href="mailto:admissions@licomsia.edu" class="text-primary hover:underline">admissions@licomsia.edu</a></li>
                <li><i class="fas fa-phone mr-2 text-primary"></i> (123) 456-7890</li>
            </ul>
        </div>
        
        <div class="mt-10">
            <a href="{{ route('landing') }}" class="px-8 py-4 bg-gray-600 text-white font-semibold rounded-lg shadow-md hover:bg-gray-700 transition">
                Back to Homepage
            </a>
        </div>
    </div>
</div>
@endsection 