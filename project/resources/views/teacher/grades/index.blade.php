@extends('layouts.teacher')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Grades Management</h1>
        <a href="{{ route('teacher.grades.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300 ease-in-out">
            <i class="fas fa-plus mr-2"></i> Add Grade
        </a>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md shadow-sm" role="alert">
            <p class="font-bold">Success</p>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full leading-normal">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th scope="col" class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">
                            Student
                        </th>
                        <th scope="col" class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">
                            Course
                        </th>
                        <th scope="col" class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">
                            Prelim
                        </th>
                        <th scope="col" class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">
                            Midterm
                        </th>
                        <th scope="col" class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">
                            Final
                        </th>
                        <th scope="col" class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">
                            Computed
                        </th>
                        <th scope="col" class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">
                            Remarks
                        </th>
                        <th scope="col" class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @forelse ($grades as $grade)
                        <tr class="hover:bg-gray-100">
                            <td class="px-5 py-4 border-b border-gray-200 text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">{{ $grade->student->first_name }} {{ $grade->student->last_name }}</p>
                            </td>
                            <td class="px-5 py-4 border-b border-gray-200 text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">{{ $grade->course->course_name }}</p>
                            </td>
                            <td class="px-5 py-4 border-b border-gray-200 text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">{{ $grade->prelim_grade ?? 'N/A' }}</p>
                            </td>
                            <td class="px-5 py-4 border-b border-gray-200 text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">{{ $grade->midterm_grade ?? 'N/A' }}</p>
                            </td>
                            <td class="px-5 py-4 border-b border-gray-200 text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">{{ $grade->final_grade ?? 'N/A' }}</p>
                            </td>
                            <td class="px-5 py-4 border-b border-gray-200 text-sm">
                                <p class="text-gray-900 whitespace-no-wrap font-bold">{{ $grade->computed_grade ?? 'N/A' }}</p>
                            </td>
                            <td class="px-5 py-4 border-b border-gray-200 text-sm">
                                <span class="relative inline-block px-3 py-1 font-semibold leading-tight {{ $grade->remarks == 'Passed' ? 'text-green-900' : 'text-red-900' }}">
                                    <span aria-hidden="true" class="absolute inset-0 {{ $grade->remarks == 'Passed' ? 'bg-green-200' : 'bg-red-200' }} opacity-50 rounded-full"></span>
                                    <span class="relative">{{ $grade->remarks ?? 'N/A' }}</span>
                                </span>
                            </td>
                            <td class="px-5 py-4 border-b border-gray-200 text-sm">
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('teacher.grades.edit', $grade->grade_id) }}" class="text-blue-600 hover:text-blue-900 transition duration-300 ease-in-out">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('teacher.grades.destroy', $grade->grade_id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this grade?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 transition duration-300 ease-in-out">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-10 text-gray-500">
                                <p class="text-lg font-semibold">No grades found.</p>
                                <p class="mt-2">Start by adding a new grade.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection 