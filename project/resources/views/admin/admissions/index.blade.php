@extends('layouts.admin')

@section('header', 'Admissions')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Admission Applications</h1>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-white shadow-md rounded-lg overflow-x-auto">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr>
                        <th class="px-3 py-2 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Applicant Name
                        </th>
                        <th class="px-3 py-2 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Program
                        </th>
            
                        <th class="px-3 py-2 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Scholarship
                        </th>
                        <th class="px-3 py-2 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Disability
                        </th>
                        <th class="px-3 py-2 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Status
                        </th>

                        <th class="px-3 py-2 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Submitted At
                        </th>
                        <th class="px-3 py-2 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Actions
                        </th>
                        <th class="px-3 py-2 border-b-2 border-gray-200 bg-gray-100"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($admissions as $admission)
                        <tr>
                            <td class="px-3 py-3 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">{{ $admission->first_name }} {{ $admission->last_name }}</p>
                            </td>
                            <td class="px-3 py-3 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">{{ $admission->program->program_name ?? 'N/A' }}</p>
                            </td>

                            <td class="px-3 py-3 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">{{ $admission->scholarship }}</p>
                            </td>
                          
                             
                            <td class="px-3 py-3 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">{{ $admission->disability }}</p>
                            </td>

                           
                            <td class="px-3 py-3 border-b border-gray-200 bg-white text-sm">
                                <span class="relative inline-block px-2 py-1 font-semibold leading-tight
                                    @if($admission->application_status === 'approved') text-green-900 @elseif($admission->application_status === 'rejected') text-red-900 @else text-yellow-900 @endif">
                                    <span aria-hidden class="absolute inset-0 
                                        @if($admission->application_status === 'approved') bg-green-200 @elseif($admission->application_status === 'rejected') bg-red-200 @else bg-yellow-200 @endif
                                        opacity-50 rounded-full"></span>
                                    <span class="relative">{{ ucfirst($admission->application_status) }}</span>
                                </span>
                            </td>
                            <td class="px-3 py-3 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">{{ $admission->created_at->format('M d, Y') }}</p>
                            </td>
                        
                            <td class="px-3 py-3 border-b border-gray-200 bg-white text-sm text-right whitespace-no-wrap">
                                <a href="{{ route('admin.admissions.show', $admission) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">View</a>
                                @if($admission->application_status === 'Pending')
                                    <form action="{{ route('admin.admissions.approve', $admission) }}" method="POST" class="inline-block">
                                        @csrf
                                        <button type="submit" class="text-green-600 hover:text-green-900">Approve</button>
                                    </form>
                                    <form action="{{ route('admin.admissions.reject', $admission) }}" method="POST" class="inline-block ml-3">
                                        @csrf
                                        <button type="submit" class="text-red-600 hover:text-red-900">Reject</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-3 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                No admission applications found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection 