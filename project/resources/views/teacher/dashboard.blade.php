@extends('layouts.teacher')

@section('header', 'Teacher Dashboard')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Classes Card -->
        <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-primary">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 mr-4">
                    <i class="fas fa-chalkboard text-primary text-xl"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500 uppercase font-semibold">My Classes</p>
                    <p class="text-2xl font-bold">{{ $classCount }}</p>
                </div>
            </div>
            <div class="mt-4">
                <a href="{{ route('teacher.my_courses') }}" class="text-sm text-primary hover:underline">View Classes</a>
            </div>
        </div>

        <!-- Students Card -->
        <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-secondary">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 mr-4">
                    <i class="fas fa-user-graduate text-secondary text-xl"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500 uppercase font-semibold">Total Students</p>
                    <p class="text-2xl font-bold">{{ $studentCount }}</p>
                </div>
            </div>
            <div class="mt-4">
                <a href="{{ route('teacher.my_students') }}" class="text-sm text-primary hover:underline">View Students</a>
            </div>
        </div>
    </div>

    <div class="mt-8">
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h3 class="text-lg font-semibold text-dark mb-4">Today's Schedule</h3>
            <div class="space-y-4">
                @forelse($schedule as $item)
                    <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                        <div class="mr-4">
                            <p class="text-lg font-bold text-primary">{{ \Carbon\Carbon::parse($item->start_time)->format('h:i') }}</p>
                            <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($item->start_time)->format('A') }}</p>
                        </div>
                        <div class="border-l-2 border-primary pl-4">
                            <p class="font-semibold">{{ $item->course->course_name }}</p>
                            <p class="text-sm text-gray-600">Room {{ $item->room }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500">No classes scheduled for today.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection 