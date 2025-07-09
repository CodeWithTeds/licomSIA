@extends('layouts.admin')

@section('title', 'Program Details')

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Program Details</h1>
        <div class="flex space-x-2">
            <a href="{{ route('admin.programs.edit', $program->program_id) }}" class="bg-amber-600 hover:bg-amber-700 text-white px-4 py-2 rounded-md text-sm font-medium focus:outline-none focus:ring-2 focus:ring-amber-500">
                <i class="fas fa-edit mr-2"></i>Edit
            </a>
            <a href="{{ route('admin.programs.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-md text-sm font-medium focus:outline-none focus:ring-2 focus:ring-gray-500">
                <i class="fas fa-arrow-left mr-2"></i>Back to Programs
            </a>
        </div>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Program Information</h2>
                    <div class="space-y-3">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Program Name</p>
                            <p class="text-base font-medium text-gray-900">{{ $program->program_name }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Department</p>
                            <p class="text-base font-medium text-gray-900">{{ $program->department->name ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Number of Courses</p>
                            <p class="text-base font-medium text-gray-900">{{ $program->courses->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Courses in this program -->
            <div class="mt-8 pt-6 border-t border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Courses in this Program</h2>
                @if($program->courses->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Course Name</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Units</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Instructor</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($program->courses as $course)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $course->course_name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $course->units }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            @if($course->instructor)
                                                {{ $course->instructor->last_name }}, {{ $course->instructor->first_name }}
                                            @else
                                                Not Assigned
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('courses.show', $course->course_id) }}" class="text-blue-600 hover:text-blue-900">
                                            <i class="fas fa-eye mr-1"></i>View
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-gray-500">No courses found in this program.</p>
                @endif
            </div>

            <!-- Danger Zone -->
            <div class="mt-8 pt-6 border-t border-gray-200">
                <h3 class="text-lg font-semibold text-red-600 mb-4">Danger Zone</h3>
                <form action="{{ route('admin.programs.destroy', $program->program_id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this program? This action cannot be undone. All courses in this program will also be deleted.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md text-sm font-medium focus:outline-none focus:ring-2 focus:ring-red-500">
                        <i class="fas fa-trash mr-2"></i>Delete Program
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 