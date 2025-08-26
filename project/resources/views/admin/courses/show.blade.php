@extends('layouts.admin')

@section('title', 'Course Details')

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Course Details</h1>
        <div class="flex space-x-2">
            <a href="{{ route('admin.courses.edit', $course->course_id) }}" class="bg-amber-600 hover:bg-amber-700 text-white px-4 py-2 rounded-md text-sm font-medium focus:outline-none focus:ring-2 focus:ring-amber-500">
                <i class="fas fa-edit mr-2"></i>Edit
            </a>
            <a href="{{ route('admin.courses.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-md text-sm font-medium focus:outline-none focus:ring-2 focus:ring-gray-500">
                <i class="fas fa-arrow-left mr-2"></i>Back to Courses
            </a>
        </div>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Course Information</h2>
                    <div class="space-y-3">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Course Name</p>
                            <p class="text-base font-medium text-gray-900">{{ $course->course_name }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Units</p>
                            <p class="text-base font-medium text-gray-900">{{ $course->units }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Year Level</p>
                            <p class="text-base font-medium text-gray-900">{{ $course->year_level }} Year</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Program</p>
                            <p class="text-base font-medium text-gray-900">
                                {{ $course->program->program_name ?? 'N/A' }}
                            </p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Department</p>
                            <p class="text-base font-medium text-gray-900">
                                {{ $course->program->department ?? 'N/A' }}
                            </p>
                        </div>
                    </div>
                </div>

                <div>
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Additional Information</h2>
                    <div class="space-y-3">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Instructor</p>
                            <p class="text-base font-medium text-gray-900">
                                @if($course->instructors->isNotEmpty())
                                    {{ $course->instructors->pluck('full_name')->join(', ') }}
                                @else
                                    Not Assigned
                                @endif
                            </p>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Danger Zone -->
            <div class="mt-8 pt-6 border-t border-gray-200">
                <h3 class="text-lg font-semibold text-red-600 mb-4">Danger Zone</h3>
                <form action="{{ route('admin.courses.destroy', $course->course_id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this course? This action cannot be undone.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md text-sm font-medium focus:outline-none focus:ring-2 focus:ring-red-500">
                        <i class="fas fa-trash mr-2"></i>Delete Course
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 