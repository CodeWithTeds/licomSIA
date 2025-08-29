@extends('layouts.admin')

@section('title', "Dean's List Report")

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Dean's List Report</h1>
        <a href="{{ route('admin.dashboard') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-md text-sm font-medium focus:outline-none focus:ring-2 focus:ring-gray-500">
            <i class="fas fa-arrow-left mr-2"></i>Back to Dashboard
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b">
                <h2 class="text-lg font-semibold text-gray-900">Passed (>= 75)</h2>
                <p class="text-sm text-gray-500">Dean's List threshold: 92%</p>
            </div>
            <div class="p-4 overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Program</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Average</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dean's List</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($passed as $item)
                        <tr>
                            <td class="px-4 py-2">{{ $item->student->first_name }} {{ $item->student->last_name }}</td>
                            <td class="px-4 py-2">{{ $item->student->program->program_name ?? 'N/A' }}</td>
                            <td class="px-4 py-2">{{ $item->average !== null ? number_format($item->average, 2) : 'N/A' }}</td>
                            <td class="px-4 py-2">
                                @if($item->isDeansList)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Yes</span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">No</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-4 py-4 text-center text-sm text-gray-500">No passed students found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b">
                <h2 class="text-lg font-semibold text-gray-900">Failed (< 75)</h2>
                <p class="text-sm text-gray-500">Students below passing average.</p>
            </div>
            <div class="p-4 overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Program</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Average</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($failed as $item)
                        <tr>
                            <td class="px-4 py-2">{{ $item->student->first_name }} {{ $item->student->last_name }}</td>
                            <td class="px-4 py-2">{{ $item->student->program->program_name ?? 'N/A' }}</td>
                            <td class="px-4 py-2">{{ $item->average !== null ? number_format($item->average, 2) : 'N/A' }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-4 py-4 text-center text-sm text-gray-500">No failed students found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection


