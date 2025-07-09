@extends('layouts.admin')

@section('header', 'Instructors')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Instructors</h1>
        <a href="{{ route('admin.instructors.create') }}" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark transition">
            <i class="fas fa-plus mr-1"></i> Add Instructor
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Department</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Position</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($instructors as $instructor)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $instructor->instructor_id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $instructor->first_name }} {{ $instructor->last_name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $instructor->department->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $instructor->position->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $instructor->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <a href="{{ route('admin.instructors.show', $instructor->instructor_id) }}" class="text-primary hover:text-primary-dark">
                                    <i class="fas fa-eye"></i> View
                                </a>
                                <a href="{{ route('admin.instructors.edit', $instructor->instructor_id) }}" class="text-blue-500 hover:text-blue-700 ml-3">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('admin.instructors.destroy', $instructor->instructor_id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this instructor?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 ml-3">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        {{ $instructors->links() }}
    </div>
@endsection 