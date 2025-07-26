@extends('layouts.teacher')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="max-w-2xl mx-auto bg-white shadow-lg rounded-lg p-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Add New Grade</h1>

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

        <form action="{{ route('teacher.grades.store') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label for="student_id" class="block text-sm font-medium text-gray-700 mb-1">Student</label>
                <select name="student_id" id="student_id" class="block w-full px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out">
                    <option value="">Select a student</option>
                    @foreach ($students as $student)
                        <option value="{{ $student->student_id }}" {{ old('student_id') == $student->student_id ? 'selected' : '' }}>{{ $student->first_name }} {{ $student->last_name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="course_id" class="block text-sm font-medium text-gray-700 mb-1">Course</label>
                <select name="course_id" id="course_id" class="block w-full px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out">
                    <option value="">Select a course</option>
                    @foreach ($courses as $course)
                        <option value="{{ $course->course_id }}" {{ old('course_id') == $course->course_id ? 'selected' : '' }}>{{ $course->course_name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="prelim_grade" class="block text-sm font-medium text-gray-700 mb-1">Prelim Grade</label>
                <input type="number" step="0.01" name="prelim_grade" id="prelim_grade" value="{{ old('prelim_grade') }}" class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out" placeholder="Enter prelim grade">
            </div>
            <div>
                <label for="midterm_grade" class="block text-sm font-medium text-gray-700 mb-1">Midterm Grade</label>
                <input type="number" step="0.01" name="midterm_grade" id="midterm_grade" value="{{ old('midterm_grade') }}" class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out" placeholder="Enter midterm grade">
            </div>
            <div>
                <label for="final_grade" class="block text-sm font-medium text-gray-700 mb-1">Final Grade</label>
                <input type="number" step="0.01" name="final_grade" id="final_grade" value="{{ old('final_grade') }}" class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out" placeholder="Enter final grade">
            </div>
            <div class="flex justify-end pt-4">
                <a href="{{ route('teacher.grades.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-lg mr-2 transition duration-300 ease-in-out">
                    Cancel
                </a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300 ease-in-out">
                    <i class="fas fa-plus mr-2"></i> Add Grade
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 