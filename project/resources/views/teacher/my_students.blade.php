@extends('layouts.teacher')

@section('header', 'My Students')

@section('content')
    <div class="mb-4">
        <form method="GET" class="flex gap-4">
            <div class="flex-1">
                <label for="program" class="block text-sm font-medium text-gray-700 mb-1">Program</label>
                <select name="program" id="program" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                    <option value="">All Programs</option>
                    @foreach($programs as $program)
                        <option value="{{ $program->program_id }}" {{ request('program') == $program->program_id ? 'selected' : '' }}>
                            {{ $program->program_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="flex-1">
                <label for="year_level" class="block text-sm font-medium text-gray-700 mb-1">Year Level</label>
                <select name="year_level" id="year_level" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                    <option value="">All Year Levels</option>
                    @foreach([1, 2, 3, 4] as $year)
                        <option value="{{ $year }}" {{ request('year_level') == $year ? 'selected' : '' }}>
                            {{ $year }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="flex items-end">
                <button type="submit" class="px-4 py-2 bg-primary text-white rounded-md hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                    Filter
                </button>
            </div>
        </form>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student Name</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student Number</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Program</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Year Level</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($students as $student)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $student->last_name }}, {{ $student->first_name }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $student->student_number }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $student->program->program_name ?? 'N/A' }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $student->year_level }}</div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                            No students found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4 px-4">
            {{ $students->links() }}
        </div>
    </div>
@endsection