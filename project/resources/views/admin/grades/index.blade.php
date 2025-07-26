@extends('layouts.admin')

@section('header', 'Grades')

@section('content')
    <div class="bg-white rounded-lg shadow-sm p-6">
        <h3 class="text-lg font-semibold text-dark mb-4">All Grades</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student</th>
                        <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Course</th>
                        <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Instructor</th>
                        <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prelim</th>
                        <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Midterm</th>
                        <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Finals</th>
                        <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Remarks</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($grades as $grade)
                        <tr class="hover:bg-gray-50">
                            <td class="py-3 px-4 text-sm text-gray-900">{{ $grade->student->first_name }} {{ $grade->student->last_name }}</td>
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
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">No grades found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $grades->links() }}
        </div>
    </div>
@endsection 