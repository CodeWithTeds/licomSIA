@extends('layouts.admin')

@section('title', 'Students')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 text-2xl font-semibold text-gray-800">Students</h1>
    <nav class="flex mb-4" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('admin.dashboard') }}" class="text-gray-700 hover:text-primary">Dashboard</a>
            </li>
            <li class="flex items-center">
                <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                <span class="ml-1 text-gray-500">Students</span>
            </li>
        </ol>
    </nav>
    
    <div class="flex flex-col space-y-4 mb-6">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-800">Students</h1>
            <a href="{{ route('admin.students.create') }}" class="bg-primary hover:bg-primary-dark text-white px-4 py-2 rounded-md text-sm flex items-center transition duration-150">
                <i class="fas fa-plus mr-2"></i> Add Student
            </a>
        </div>

        <form method="GET" class="bg-white p-4 rounded-lg shadow-sm flex flex-wrap gap-4 items-end">
            <div class="flex-1 min-w-[200px]">
                <label for="program" class="block text-sm font-medium text-gray-700 mb-1">Program</label>
                <select name="program" id="program" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                    <option value="">All Programs</option>
                    @foreach($programs as $program)
                        <option value="{{ $program->program_id }}" {{ request('program') == $program->program_id ? 'selected' : '' }}>
                            {{ $program->program_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex-1 min-w-[200px]">
                <label for="course" class="block text-sm font-medium text-gray-700 mb-1">Course</label>
                <select name="course" id="course" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                    <option value="">All Courses</option>
                    @foreach($courses as $course)
                        <option value="{{ $course->course_id }}" {{ request('course') == $course->course_id ? 'selected' : '' }}>
                            {{ $course->course_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex-1 min-w-[200px]">
                <label for="year_level" class="block text-sm font-medium text-gray-700 mb-1">Year Level</label>
                <select name="year_level" id="year_level" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                    <option value="">All Year Levels</option>
                    @for($i = 1; $i <= 4; $i++)
                        <option value="{{ $i }}" {{ request('year_level') == $i ? 'selected' : '' }}>Year {{ $i }}</option>
                    @endfor
                </select>
            </div>

            <div class="flex-none">
                <button type="submit" class="bg-primary hover:bg-primary-dark text-white px-4 py-2 rounded-md text-sm transition duration-150">
                    <i class="fas fa-filter mr-2"></i> Filter
                </button>
                @if(request()->anyFilled(['program', 'course', 'year_level']))
                    <a href="{{ route('admin.students.index') }}" class="ml-2 text-gray-600 hover:text-gray-900">
                        <i class="fas fa-times"></i> Clear
                    </a>
                @endif
            </div>
        </form>
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
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Program</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Year Level</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($students as $student)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $student->student_number }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $student->first_name }} {{ $student->last_name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $student->program->program_name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $student->year_level }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $student->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs rounded-full 
                                    @if($student->status == 'Enrolled') bg-green-100 text-green-800
                                    @elseif($student->status == 'Pending') bg-yellow-100 text-yellow-800
                                    @elseif($student->status == 'Dropped') bg-red-100 text-red-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ $student->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <a href="{{ route('admin.students.show', $student->student_id) }}" class="text-blue-600 hover:text-blue-900">
                                    <i class="fas fa-eye"></i> View
                                </a>
                                <a href="{{ route('admin.students.edit', $student->student_id) }}" class="text-indigo-600 hover:text-indigo-900 ml-3">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('admin.students.destroy', $student->student_id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this student?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 ml-3">
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
        {{ $students->links() }}
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#studentsTable').DataTable({
            paging: false,
            info: false,
        });
    });
</script>
@endsection