@extends('layouts.student')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="max-w-2xl mx-auto bg-white shadow-lg rounded-lg p-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Submit Evaluation</h1>

        @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-md shadow-sm" role="alert">
                <p class="font-bold">Error</p>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('student.evaluations.store') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label for="instructor_id" class="block text-sm font-medium text-gray-700 mb-1">Instructor</label>
                <select name="instructor_id" id="instructor_id" class="block w-full px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out">
                    <option value="">Select an instructor</option>
                    @foreach ($instructors as $instructor)
                        <option value="{{ $instructor->instructor_id }}" {{ old('instructor_id') == $instructor->instructor_id ? 'selected' : '' }}>{{ $instructor->first_name }} {{ $instructor->last_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="semester" class="block text-sm font-medium text-gray-700 mb-1">Semester</label>
                    <select name="semester" id="semester" class="block w-full px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out">
                        <option value="1st" {{ old('semester') == '1st' ? 'selected' : '' }}>1st</option>
                        <option value="2nd" {{ old('semester') == '2nd' ? 'selected' : '' }}>2nd</option>
                        <option value="Summer" {{ old('semester') == 'Summer' ? 'selected' : '' }}>Summer</option>
                    </select>
                </div>
                <div>
                    <label for="school_year" class="block text-sm font-medium text-gray-700 mb-1">School Year</label>
                    <input type="text" name="school_year" id="school_year" value="{{ old('school_year') }}" class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out" placeholder="e.g., 2023-2024">
                </div>
            </div>
            <div>
                <label for="rating" class="block text-sm font-medium text-gray-700 mb-1">Rating</label>
                <div class="flex items-center space-x-2">
                    @for ($i = 1; $i <= 5; $i++)
                        <label class="flex items-center space-x-1 cursor-pointer">
                            <input type="radio" name="rating" value="{{ $i }}" class="form-radio h-5 w-5 text-blue-600" {{ old('rating') == $i ? 'checked' : '' }}>
                            <span class="text-gray-700">{{ $i }}</span>
                        </label>
                    @endfor
                </div>
            </div>
            <div>
                <label for="comments" class="block text-sm font-medium text-gray-700 mb-1">Comments</label>
                <textarea name="comments" id="comments" rows="4" class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out" placeholder="Enter your comments here...">{{ old('comments') }}</textarea>
            </div>
            <div class="flex justify-end pt-4">
                <a href="{{ route('student.evaluations.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-lg mr-2 transition duration-300 ease-in-out">
                    Cancel
                </a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300 ease-in-out">
                    <i class="fas fa-paper-plane mr-2"></i> Submit Evaluation
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 