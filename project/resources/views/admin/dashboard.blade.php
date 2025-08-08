@extends('layouts.admin')

@section('header', 'Dashboard')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <!-- Stats Cards -->
        <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-primary">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 mr-4">
                    <i class="fas fa-users text-primary text-xl"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500 uppercase font-semibold">Students</p>
                    <p class="text-2xl font-bold">{{ $studentCount }}</p>
                </div>
            </div>
            <div class="mt-4">
                <a href="{{ route('admin.students.index') }}" class="text-sm text-primary hover:underline">View all students</a>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-secondary">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 mr-4">
                    <i class="fas fa-chalkboard-teacher text-secondary text-xl"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500 uppercase font-semibold">Instructors</p>
                    <p class="text-2xl font-bold">{{ $instructorCount }}</p>
                </div>
            </div>
            <div class="mt-4">
                <a href="{{ route('admin.instructors.index') }}" class="text-sm text-primary hover:underline">View all instructors</a>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-green-500">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 mr-4">
                    <i class="fas fa-book-open text-green-500 text-xl"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500 uppercase font-semibold">Courses</p>
                    <p class="text-2xl font-bold">{{ $courseCount }}</p>
                </div>
            </div>
            <div class="mt-4">
                <a href="{{ route('admin.courses.index') }}" class="text-sm text-primary hover:underline">View all courses</a>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-purple-500">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-100 mr-4">
                    <i class="fas fa-graduation-cap text-purple-500 text-xl"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500 uppercase font-semibold">Programs</p>
                    <p class="text-2xl font-bold">{{ $programCount }}</p>
                </div>
            </div>
            <div class="mt-4">
                <a href="{{ route('admin.programs.index') }}" class="text-sm text-primary hover:underline">View all programs</a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Recently Enrolled Students -->
        <div class="col-span-2 bg-white rounded-lg shadow-sm p-6">
            <h3 class="text-lg font-semibold text-dark mb-4">Recently Enrolled Students</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student</th>
                            <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Program</th>
                            <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($recentEnrollments as $student)
                            <tr class="hover:bg-gray-50">
                                <td class="py-3 px-4 text-sm text-gray-900">{{ $student->first_name }} {{ $student->last_name }}</td>
                                <td class="py-3 px-4 text-sm text-gray-900">{{ $student->program->program_name }}</td>
                                <td class="py-3 px-4 text-sm text-gray-500">
                                    <a href="{{ route('admin.grades.show', $student) }}" class="text-blue-500 hover:underline">Grades</a>
                                    @if ($student->admission)
                                    <span class="mx-2">|</span>
                                    <a href="{{ route('admin.admissions.show', $student->admission->admission_id) }}" class="text-green-500 hover:underline">Admission</a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center py-4">No recent enrollments.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h3 class="text-lg font-semibold text-dark mb-4">Quick Actions</h3>
            <div class="space-y-3">
                <a href="#" class="flex items-center p-3 bg-blue-50 hover:bg-blue-100 rounded-lg transition">
                    <div class="rounded-full bg-blue-500 text-white p-2 mr-3">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <span class="font-medium">Add New Student</span>
                </a>
                    <a href="{{ route('admin.instructors.create') }}" class="flex items-center p-3 bg-green-50 hover:bg-green-100 rounded-lg transition">
                        <div class="bg-green-100 text-green-600 rounded-full p-2 mr-3">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <div>
                            <h4 class="font-medium">Add Instructor</h4>
            
                        </div>
                    </a>
                <a href="#" class="flex items-center p-3 bg-purple-50 hover:bg-purple-100 rounded-lg transition">
                    <div class="rounded-full bg-purple-500 text-white p-2 mr-3">
                        <i class="fas fa-book"></i>
                    </div>
                    <span class="font-medium">Create New Course</span>
                </a>
                <a href="#" class="flex items-center p-3 bg-yellow-50 hover:bg-yellow-100 rounded-lg transition">
                    <div class="rounded-full bg-yellow-500 text-white p-2 mr-3">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <span class="font-medium">Manage Schedule</span>
                </a>
                <a href="#" class="flex items-center p-3 bg-red-50 hover:bg-red-100 rounded-lg transition">
                    <div class="rounded-full bg-red-500 text-white p-2 mr-3">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <span class="font-medium">Generate Reports</span>
                </a>
            </div>
        </div>
    </div>
@endsection 