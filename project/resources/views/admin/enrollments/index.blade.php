@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">All Enrollments</h1>
        <a href="{{ route('admin.enrollments.pending') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            View Pending Enrollments
        </a>
    </div>
    
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
    
    <div class="bg-white p-4 rounded-lg shadow mb-6">
        <form action="{{ route('admin.enrollments.index') }}" method="GET" class="flex flex-wrap items-end gap-4">
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
            
            <div class="w-full md:w-auto">
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="status" id="status" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                    <option value="">All Statuses</option>
                    <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Approved" {{ request('status') == 'Approved' ? 'selected' : '' }}>Approved</option>
                    <option value="Rejected" {{ request('status') == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                    <option value="Enrolled" {{ request('status') == 'Enrolled' ? 'selected' : '' }}>Enrolled</option>
                </select>
            </div>
            
            <div>
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                    Filter
                </button>
                @if(request()->anyFilled(['program_id', 'year_level', 'status']))
                    <a href="{{ route('admin.enrollments.index') }}" class="ml-2 text-gray-600 hover:text-gray-900">
                        Clear
                    </a>
                @endif
            </div>
        </form>
    </div>
    
    <div class="bg-white rounded-lg shadow overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Program</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">School Year</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Semester</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($enrollments as $enrollment)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ $enrollment->student->last_name }}, {{ $enrollment->student->first_name }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ $enrollment->student->program->program_name }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ $enrollment->school_year }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ $enrollment->semester }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            @if($enrollment->status === 'Approved') bg-green-100 text-green-800
                            @elseif($enrollment->status === 'Pending') bg-yellow-100 text-yellow-800
                            @elseif($enrollment->status === 'Rejected') bg-red-100 text-red-800
                            @else bg-gray-100 text-gray-800
                            @endif">
                            {{ $enrollment->status }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ $enrollment->date_enrolled->format('M d, Y') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <a href="{{ route('admin.enrollments.show', $enrollment->enrollment_id) }}" class="text-blue-600 hover:text-blue-900">
                            <i class="fas fa-eye"></i> View
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <div class="mt-4">
        {{ $enrollments->links() }}
    </div>
</div>
@endsection 