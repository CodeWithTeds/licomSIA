@extends('layouts.admin')

@section('header', 'Instructors')

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <h2 class="text-2xl font-semibold text-dark">Manage Instructors</h2>
        <a href="{{ route('instructors.create') }}" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark transition">
            <i class="fas fa-plus mr-2"></i> Add New Instructor
        </a>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Name</th>
                            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Department</th>
                            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Position</th>
                            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($instructors as $instructor)
                            <tr class="hover:bg-gray-50">
                                <td class="py-3 px-4">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-500">
                                            <i class="fas fa-user"></i>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $instructor->first_name }} {{ $instructor->last_name }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3 px-4 text-sm text-gray-500">{{ $instructor->department->name }}</td>
                                <td class="py-3 px-4 text-sm text-gray-500">{{ $instructor->position->name }}</td>
                                <td class="py-3 px-4 text-sm font-medium">
                                    <div class="flex space-x-3">
                                        <a href="{{ route('instructors.show', $instructor->instructor_id) }}" class="text-primary hover:text-primary-dark">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('instructors.edit', $instructor->instructor_id) }}" class="text-blue-500 hover:text-blue-700">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('instructors.destroy', $instructor->instructor_id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this instructor?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-6 px-4 text-center text-gray-500">No instructors found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection 