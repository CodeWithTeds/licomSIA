@extends('layouts.admin')

@section('header', 'Instructor Details')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Instructor Details</h1>
        <a href="{{ route('admin.instructors.index') }}" class="flex items-center text-primary hover:text-primary-dark">
            <i class="fas fa-arrow-left mr-1"></i> Back to Instructors
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <div class="p-6">
            <div class="flex justify-between items-start">
                <div>
                    <h2 class="text-2xl font-semibold text-dark mb-2">{{ $instructor->first_name }} {{ $instructor->last_name }}</h2>
                    <p class="text-gray-600">{{ $instructor->position->name }} - {{ $instructor->department->name }}</p>
                </div>
                <div class="flex space-x-4 mb-6">
                    <a href="{{ route('admin.instructors.edit', $instructor->instructor_id) }}" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
                        <i class="fas fa-edit mr-1"></i> Edit
                    </a>
                    
                    <form id="delete-form" action="{{ route('admin.instructors.destroy', $instructor->instructor_id) }}" method="POST" class="hidden">
                        @csrf
                        @method('DELETE')
                    </form>
                    <button onclick="if(confirm('Are you sure you want to delete this instructor?')) document.getElementById('delete-form').submit();" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">
                        <i class="fas fa-trash mr-1"></i> Delete
                    </button>
                </div>
            </div>

            <hr class="my-6 border-gray-200">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-lg font-semibold text-dark mb-4">Instructor Information</h3>
                    <div class="space-y-4">
                        <div>
                            <span class="block text-sm font-medium text-gray-500">Full Name</span>
                            <span class="block text-base">{{ $instructor->first_name }} {{ $instructor->last_name }}</span>
                        </div>
                        <div>
                            <span class="block text-sm font-medium text-gray-500">Department</span>
                            <span class="block text-base">{{ $instructor->department->name }}</span>
                        </div>
                        <div>
                            <span class="block text-sm font-medium text-gray-500">Position</span>
                            <span class="block text-base">{{ $instructor->position->name }}</span>
                        </div>
                        <div>
                            <span class="block text-sm font-medium text-gray-500">Instructor ID</span>
                            <span class="block text-base">{{ $instructor->instructor_id }}</span>
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-dark mb-4">Assigned Courses</h3>
                    @if($instructor->courses->count() > 0)
                        <ul class="space-y-3">
                            @foreach($instructor->courses as $course)
                                <li class="bg-gray-50 p-3 rounded-md">
                                    <span class="block font-medium">{{ $course->course_name }}</span>
                                    <span class="block text-sm text-gray-500">{{ $course->units }} units</span>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-500">No courses assigned to this instructor yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection 