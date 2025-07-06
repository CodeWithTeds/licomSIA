@extends('layouts.admin')

@section('title', 'Edit Course')

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Edit Course</h1>
        <a href="{{ route('courses.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-md text-sm font-medium focus:outline-none focus:ring-2 focus:ring-gray-500">
            <i class="fas fa-arrow-left mr-2"></i>Back to Courses
        </a>
    </div>

    @if ($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
            <p class="font-bold">Please fix the following errors:</p>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white shadow-md rounded-lg p-6">
        <form action="{{ route('courses.update', $course->course_id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Course Name -->
                <div>
                    <label for="course_name" class="block text-sm font-medium text-gray-700 mb-1">Course Name</label>
                    <input type="text" name="course_name" id="course_name" value="{{ old('course_name', $course->course_name) }}" class="form-input block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                </div>

                <!-- Units -->
                <div>
                    <label for="units" class="block text-sm font-medium text-gray-700 mb-1">Units</label>
                    <input type="number" name="units" id="units" value="{{ old('units', $course->units) }}" min="1" class="form-input block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                </div>

                <!-- Program -->
                <div>
                    <label for="program_id" class="block text-sm font-medium text-gray-700 mb-1">Program</label>
                    <select name="program_id" id="program_id" class="form-select block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                        <option value="">Select Program</option>
                        @foreach($programs as $program)
                            <option value="{{ $program->program_id }}" {{ (old('program_id', $course->program_id) == $program->program_id) ? 'selected' : '' }}>
                                {{ $program->program_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Instructor -->
                <div>
                    <label for="instructor_id" class="block text-sm font-medium text-gray-700 mb-1">Instructor</label>
                    <select name="instructor_id" id="instructor_id" class="form-select block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                        <option value="">Select Instructor</option>
                        @foreach($instructors as $instructor)
                            <option value="{{ $instructor->instructor_id }}" {{ (old('instructor_id', $course->instructor_id) == $instructor->instructor_id) ? 'selected' : '' }}>
                                {{ $instructor->last_name }}, {{ $instructor->first_name }} - {{ $instructor->department->name ?? 'N/A' }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Prerequisite -->
                <div>
                    <label for="prerequisite_id" class="block text-sm font-medium text-gray-700 mb-1">Prerequisite</label>
                    <select name="prerequisite_id" id="prerequisite_id" class="form-select block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                        <option value="">Select Prerequisite (Optional)</option>
                        @foreach($prerequisites as $prerequisite)
                            <option value="{{ $prerequisite->course_id }}" {{ (old('prerequisite_id', $course->prerequisite_id) == $prerequisite->course_id) ? 'selected' : '' }}>
                                {{ $prerequisite->course_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mt-6">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <i class="fas fa-save mr-2"></i>Update Course
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 