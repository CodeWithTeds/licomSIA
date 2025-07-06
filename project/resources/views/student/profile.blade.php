@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Student Profile</h4>
                </div>
                
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    
                    <div class="row">
                        <div class="col-md-4 mb-4 mb-md-0">
                            <div class="text-center">
                                <div class="bg-light rounded-circle mx-auto d-flex align-items-center justify-content-center mb-3" style="width: 150px; height: 150px;">
                                    <i class="fas fa-user-graduate fa-5x text-secondary"></i>
                                </div>
                                <h4>{{ $student->first_name }} {{ $student->last_name }}</h4>
                                <p class="text-muted">Student ID: {{ $student->admission_id }}</p>
                                
                                <div class="d-flex justify-content-center mb-3">
                                    <span class="badge 
                                        @if ($student->status == 'Enrolled') bg-success 
                                        @elseif ($student->status == 'Pending') bg-warning 
                                        @elseif ($student->status == 'Dropped') bg-danger 
                                        @elseif ($student->status == 'Graduated') bg-info 
                                        @endif px-3 py-2">
                                        {{ $student->status }}
                                    </span>
                                </div>
                                
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h5 class="card-title">Academic Information</h5>
                                        <hr>
                                        <p class="mb-1"><strong>Program:</strong> {{ $student->program->program_name }}</p>
                                        <p class="mb-1"><strong>Department:</strong> {{ $student->program->department->department_name }}</p>
                                        <p class="mb-0"><strong>Year Level:</strong> {{ $student->year_level }}</p>
                                    </div>
                                </div>
                                
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Account Information</h5>
                                        <hr>
                                        <p class="mb-1"><strong>Username:</strong> {{ $student->user->name }}</p>
                                        <p class="mb-1"><strong>Email:</strong> {{ $student->user->email }}</p>
                                        <p class="mb-0">
                                            <strong>Profile Status:</strong> 
                                            @if ($student->profile_complete)
                                                <span class="badge bg-success">Complete</span>
                                            @else
                                                <span class="badge bg-warning">Incomplete</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-8">
                            <h5 class="mb-3">Update Profile Information</h5>
                            
                            <form action="{{ route('student.profile.update') }}" method="POST">
                                @csrf
                                @method('PUT')
                                
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="first_name" class="form-label">First Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name" value="{{ old('first_name', $student->first_name) }}" required>
                                        @error('first_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label for="last_name" class="form-label">Last Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name" value="{{ old('last_name', $student->last_name) }}" required>
                                        @error('last_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="birth_date" class="form-label">Birth Date <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('birth_date') is-invalid @enderror" id="birth_date" name="birth_date" value="{{ old('birth_date', $student->birth_date->format('Y-m-d')) }}" required>
                                    @error('birth_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3" required>{{ old('address', $student->address) }}</textarea>
                                    @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="contact" class="form-label">Contact Number <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('contact') is-invalid @enderror" id="contact" name="contact" value="{{ old('contact', $student->contact) }}" required>
                                    @error('contact')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-1"></i> Update Profile
                                    </button>
                                </div>
                            </form>
                            
                            <hr class="my-4">
                            
                            <h5 class="mb-3">Change Password</h5>
                            <p class="text-muted mb-3">If you want to change your password, please contact the administrator.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 