@extends('layouts.student')

@section('title', 'My Grades')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">My Grades</h1>
    
    <div class="mb-6 bg-white p-4 shadow-md rounded-lg">
        <form action="{{ route('student.grades') }}" method="GET" class="flex flex-wrap gap-4">
            <div class="w-full md:w-auto">
                <label for="program_id" class="block text-sm font-medium text-gray-700 mb-1">Program</label>
                <select name="program_id" id="program_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                    <option value="">All Programs</option>
                    @foreach($programs as $program)
                        <option value="{{ $program->program_id }}" {{ request('program_id') == $program->program_id ? 'selected' : '' }}>
                            {{ $program->program_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="w-full md:w-auto">
                <label for="course_id" class="block text-sm font-medium text-gray-700 mb-1">Course</label>
                <select name="course_id" id="course_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                    <option value="">All Courses</option>
                    @foreach($courses as $course)
                        <option value="{{ $course->course_id }}" {{ request('course_id') == $course->course_id ? 'selected' : '' }}>
                            {{ $course->course_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="w-full md:w-auto">
                <label for="year_level" class="block text-sm font-medium text-gray-700 mb-1">Year Level</label>
                <select name="year_level" id="year_level" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                    <option value="">All Years</option>
                    @for($i = 1; $i <= 4; $i++)
                        <option value="{{ $i }}" {{ request('year_level') == $i ? 'selected' : '' }}>
                            Year {{ $i }}
                        </option>
                    @endfor
                </select>
            </div>
            
            <div class="flex items-end">
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                    Filter
                </button>
                @if(request()->anyFilled(['program_id', 'course_id', 'year_level']))
                    <a href="{{ route('student.grades') }}" class="ml-2 text-gray-600 hover:text-gray-900 self-center">
                        Clear
                    </a>
                @endif
            </div>
        </form>
    </div>

    @forelse ($grades as $schoolYear => $gradesByYear)
        <div class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">{{ $schoolYear }}</h2>
            @foreach ($gradesByYear->groupBy('semester') as $semester => $gradesBySemester)
                <div class="mb-6 bg-white shadow-lg rounded-lg overflow-hidden">
                    <div class="bg-gray-800 text-white font-bold uppercase p-4">
                        {{ $semester }} Semester
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full leading-normal">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Course</th>
                                    <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Instructor</th>
                                    <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prelim</th>
                                    <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Midterm</th>
                                    <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Finals</th>
                                    <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Remarks</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($gradesBySemester as $grade)
                                    <tr class="hover:bg-gray-50">
                                        <td class="py-3 px-4 text-sm text-gray-900">{{ $grade->course->course_name }}</td>
                                        <td class="py-3 px-4 text-sm text-gray-900">{{ $grade->instructor->first_name }} {{ $grade->instructor->last_name }}</td>
                                        <td class="py-3 px-4 text-sm text-gray-900">{{ $grade->prelim_grade ?? '-' }}</td>
                                        <td class="py-3 px-4 text-sm text-gray-900">{{ $grade->midterm_grade ?? '-' }}</td>
                                        <td class="py-3 px-4 text-sm text-gray-900">{{ $grade->final_grade ?? '-' }}</td>
                                        <td class="py-3 px-4 text-sm text-gray-900">
                                            <span class="px-2 py-1 text-xs rounded-full 
                                                @if($grade && $grade->remarks == 'Passed') bg-green-100 text-green-800
                                                @elseif($grade && $grade->remarks == 'Failed') bg-red-100 text-red-800
                                                @else bg-gray-100 text-gray-800
                                                @endif">
                                                {{ $grade->remarks ?? '-' }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach
        </div>
    @empty
        <div class="bg-blue-50 rounded-lg border border-blue-200 p-6 text-center">
            <h3 class="text-lg font-medium text-blue-800">No Grades Found</h3>
            <p class="mt-2 text-sm text-blue-700">It looks like you don't have any grades recorded yet.</p>
        </div>
    @endforelse

    <div class="flex justify-end mt-6">
        <a href="{{ route('student.dashboard') }}" class="text-primary hover:text-primary-dark font-medium">
            &larr; Back to Dashboard
        </a>
    </div>
</div>
@endsection 