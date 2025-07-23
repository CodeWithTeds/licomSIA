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
                    <p class="text-2xl font-bold">245</p>
                </div>
            </div>
            <div class="mt-4">
                <a href="#" class="text-sm text-primary hover:underline">View all students</a>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-secondary">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 mr-4">
                    <i class="fas fa-chalkboard-teacher text-secondary text-xl"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500 uppercase font-semibold">Instructors</p>
                    <p class="text-2xl font-bold">18</p>
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
                    <p class="text-2xl font-bold">36</p>
                </div>
            </div>
            <div class="mt-4">
                <a href="#" class="text-sm text-primary hover:underline">View all courses</a>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-purple-500">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-100 mr-4">
                    <i class="fas fa-graduation-cap text-purple-500 text-xl"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500 uppercase font-semibold">Programs</p>
                    <p class="text-2xl font-bold">12</p>
                </div>
            </div>
            <div class="mt-4">
                <a href="#" class="text-sm text-primary hover:underline">View all programs</a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Recent Activities -->
        <div class="col-span-2 bg-white rounded-lg shadow-sm p-6">
            <h3 class="text-lg font-semibold text-dark mb-4">Recent Activities</h3>
            <div class="overflow-hidden">
                <ul class="divide-y divide-gray-200">
                    <li class="py-3">
                        <div class="flex items-start">
                            <div class="rounded-full bg-blue-100 p-2 mr-3">
                                <i class="fas fa-user-plus text-primary"></i>
                            </div>
                            <div>
                                <p class="text-sm font-semibold">New student registration</p>
                                <p class="text-xs text-gray-500">John Doe registered as a new student</p>
                                <p class="text-xs text-gray-400 mt-1">10 minutes ago</p>
                            </div>
                        </div>
                    </li>
                    <li class="py-3">
                        <div class="flex items-start">
                            <div class="rounded-full bg-green-100 p-2 mr-3">
                                <i class="fas fa-file-alt text-green-500"></i>
                            </div>
                            <div>
                                <p class="text-sm font-semibold">Grade submitted</p>
                                <p class="text-xs text-gray-500">Prof. Smith submitted grades for Mathematics 101</p>
                                <p class="text-xs text-gray-400 mt-1">1 hour ago</p>
                            </div>
                        </div>
                    </li>
                    <li class="py-3">
                        <div class="flex items-start">
                            <div class="rounded-full bg-yellow-100 p-2 mr-3">
                                <i class="fas fa-calendar-plus text-yellow-600"></i>
                            </div>
                            <div>
                                <p class="text-sm font-semibold">Schedule updated</p>
                                <p class="text-xs text-gray-500">Computer Science classes rescheduled for next week</p>
                                <p class="text-xs text-gray-400 mt-1">3 hours ago</p>
                            </div>
                        </div>
                    </li>
                    <li class="py-3">
                        <div class="flex items-start">
                            <div class="rounded-full bg-red-100 p-2 mr-3">
                                <i class="fas fa-exclamation-circle text-red-500"></i>
                            </div>
                            <div>
                                <p class="text-sm font-semibold">System alert</p>
                                <p class="text-xs text-gray-500">Database backup completed successfully</p>
                                <p class="text-xs text-gray-400 mt-1">5 hours ago</p>
                            </div>
                        </div>
                    </li>
                    <li class="py-3">
                        <div class="flex items-start">
                            <div class="rounded-full bg-purple-100 p-2 mr-3">
                                <i class="fas fa-book text-purple-500"></i>
                            </div>
                            <div>
                                <p class="text-sm font-semibold">New course added</p>
                                <p class="text-xs text-gray-500">Advanced Web Development added to curriculum</p>
                                <p class="text-xs text-gray-400 mt-1">Yesterday</p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="mt-4">
                <a href="#" class="text-sm text-primary hover:underline">View all activities</a>
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