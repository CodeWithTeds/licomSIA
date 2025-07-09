@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <nav class="flex" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-primary">
                    <i class="fas fa-home mr-2"></i>
                    Dashboard
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                    <a href="{{ route('admin.students.index') }}" class="ml-1 text-gray-700 hover:text-primary md:ml-2">Students</a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Student Details</span>
                </div>
            </li>
        </ol>
    </nav>

    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex justify-between items-start mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">{{ $student->first_name }} {{ $student->last_name }}</h2>
                <p class="text-gray-600">{{ $student->student_number }}</p>
            </div>
            <div class="flex space-x-4">
                <a href="{{ route('admin.students.edit', $student->student_id) }}" class="btn btn-primary">
                    <i class="fas fa-edit mr-1"></i> Edit
                </a>
                
                <form action="{{ route('admin.students.destroy', $student->student_id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this student?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash mr-1"></i> Delete
                    </button>
                </form>
            </div>
        </div>
        
        <div class="row">
            <div class="col-xl-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-user-circle me-1"></i>
                        Student Information
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <div class="bg-light rounded-circle mx-auto d-flex align-items-center justify-content-center" style="width: 150px; height: 150px;">
                                <i class="fas fa-user-graduate fa-5x text-secondary"></i>
                            </div>
                            <h3 class="mt-3">{{ $student->first_name }} {{ $student->last_name }}</h3>
                            <p class="text-muted">Student ID: {{ $student->admission_id }}</p>
                            
                            <div class="d-flex justify-content-center">
                                <span class="badge 
                                    @if ($student->status == 'Enrolled') bg-success 
                                    @elseif ($student->status == 'Pending') bg-warning 
                                    @elseif ($student->status == 'Dropped') bg-danger 
                                    @elseif ($student->status == 'Graduated') bg-info 
                                    @endif px-3 py-2">
                                    {{ $student->status }}
                                </span>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <h5 class="border-bottom pb-2">Contact Information</h5>
                            <div class="row mb-2">
                                <div class="col-5 text-muted">Contact Number:</div>
                                <div class="col-7">{{ $student->contact }}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-5 text-muted">Email:</div>
                                <div class="col-7">{{ $student->user->email }}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-5 text-muted">Address:</div>
                                <div class="col-7">{{ $student->address }}</div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <h5 class="border-bottom pb-2">Personal Information</h5>
                            <div class="row mb-2">
                                <div class="col-5 text-muted">Birth Date:</div>
                                <div class="col-7">{{ $student->birth_date->format('F d, Y') }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('admin.students.edit', $student->student_id) }}" class="btn btn-primary">
                            <i class="fas fa-edit me-1"></i> Edit
                        </a>
                        <form action="{{ route('admin.students.destroy', $student->student_id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this student?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash me-1"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-graduation-cap me-1"></i>
                        Academic Information
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h5 class="border-bottom pb-2">Program Details</h5>
                                <div class="row mb-2">
                                    <div class="col-5 text-muted">Program:</div>
                                    <div class="col-7">{{ $student->program->program_name }}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-5 text-muted">Department:</div>
                                    <div class="col-7">{{ $student->program->department->department_name }}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-5 text-muted">Year Level:</div>
                                    <div class="col-7">{{ $student->year_level }}</div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <h5 class="border-bottom pb-2">Account Status</h5>
                                <div class="row mb-2">
                                    <div class="col-5 text-muted">Username:</div>
                                    <div class="col-7">{{ $student->user->name }}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-5 text-muted">Profile Status:</div>
                                    <div class="col-7">
                                        @if ($student->profile_complete)
                                            <span class="badge bg-success">Complete</span>
                                        @else
                                            <span class="badge bg-warning">Incomplete</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-12">
                                <h5 class="border-bottom pb-2">Enrollment History</h5>
                                <p class="text-muted">No enrollment records found.</p>
                                <!-- This section can be expanded to show enrollment history when that functionality is implemented -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 