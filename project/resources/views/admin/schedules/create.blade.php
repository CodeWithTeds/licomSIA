@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">Create Schedule</h1>
        <a href="{{ route('admin.schedules.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
            <i class="fas fa-arrow-left mr-2"></i>Back to Schedules
        </a>
    </div>
    
    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif
    
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <form action="{{ route('admin.schedules.store') }}" method="POST" class="p-6">
            @csrf
            
            <div class="mb-4">
                <label for="course_id" class="block text-sm font-medium text-gray-700 mb-1">Course</label>
                <select name="course_id" id="course_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 @error('course_id') border-red-500 @enderror">
                    <option value="">Select a course</option>
                    @foreach($courses as $course)
                        <option value="{{ $course->course_id }}" {{ old('course_id') == $course->course_id ? 'selected' : '' }}>
                            {{ $course->course_name }} ({{ $course->program->program_name }})
                        </option>
                    @endforeach
                </select>
                @error('course_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="day" class="block text-sm font-medium text-gray-700 mb-1">Day</label>
                <select name="day" id="day" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 @error('day') border-red-500 @enderror">
                    <option value="">Select a day</option>
                    @foreach($days as $day)
                        <option value="{{ $day }}" {{ old('day') == $day ? 'selected' : '' }}>{{ $day }}</option>
                    @endforeach
                </select>
                @error('day')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="time_start" class="block text-sm font-medium text-gray-700 mb-1">Start Time</label>
                    <input type="time" name="time_start" id="time_start" value="{{ old('time_start') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 @error('time_start') border-red-500 @enderror">
                    @error('time_start')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="time_end" class="block text-sm font-medium text-gray-700 mb-1">End Time</label>
                    <input type="time" name="time_end" id="time_end" value="{{ old('time_end') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 @error('time_end') border-red-500 @enderror">
                    @error('time_end')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <div class="mb-6">
                <label for="room" class="block text-sm font-medium text-gray-700 mb-1">Room</label>
                <input type="text" name="room" id="room" value="{{ old('room') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 @error('room') border-red-500 @enderror" placeholder="e.g. Room 101">
                @error('room')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="flex items-center justify-end">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    <i class="fas fa-save mr-2"></i>Save Schedule
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 