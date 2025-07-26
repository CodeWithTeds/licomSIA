@extends('layouts.teacher')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">My Weekly Schedule</h1>
        <div class="flex items-center space-x-2">
            <button class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-lg shadow-md transition duration-300 ease-in-out">
                <i class="fas fa-arrow-left"></i>
            </button>
            <span class="text-xl font-semibold text-gray-700">July 2024</span>
            <button class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-lg shadow-md transition duration-300 ease-in-out">
                <i class="fas fa-arrow-right"></i>
            </button>
        </div>
    </div>

    <div class="bg-white shadow-lg rounded-2xl overflow-hidden">
        <div class="grid grid-cols-1 md:grid-cols-7">
            @foreach ($scheduleByDay as $day => $schedules)
                <div class="border-b md:border-b-0 md:border-r border-gray-100 last:border-r-0">
                    <div class="bg-gray-50 text-gray-600 font-bold uppercase text-sm p-4 text-center">
                        {{ $day }}
                    </div>
                    <div class="p-4 space-y-4 min-h-[200px] bg-gray-50/50">
                        @forelse ($schedules as $schedule)
                            <div class="bg-white rounded-lg p-4 shadow-sm border-l-4 border-blue-500 hover:shadow-md transition-shadow duration-300">
                                <p class="font-semibold text-gray-800">{{ $schedule->course->course_name }}</p>
                                <p class="text-sm text-gray-600 mt-1"><i class="fas fa-clock mr-2"></i>{{ $schedule->time_start->format('g:i A') }} - {{ $schedule->time_end->format('g:i A') }}</p>
                                <p class="text-sm text-gray-500 mt-1"><i class="fas fa-map-marker-alt mr-2"></i>{{ $schedule->room }}</p>
                            </div>
                        @empty
                            <div class="flex items-center justify-center h-full">
                                <p class="text-gray-400 text-sm">No classes</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection 