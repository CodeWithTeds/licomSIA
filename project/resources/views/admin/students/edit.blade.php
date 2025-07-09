@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Edit Student</h1>
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
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Edit Student</span>
                </div>
            </li>
        </ol>
    </nav>

    <div class="bg-white rounded-lg shadow-md p-6">
        <form action="{{ route('admin.students.update', $student->student_id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <h4>Personal Information</h4>
                    
                    <div class="mb-3">
                        <label for="admission_id" class="form-label">Admission ID <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('admission_id') is-invalid @enderror" id="admission_id" name="admission_id" value="{{ old('admission_id', $student->admission_id) }}" required>
                        @error('admission_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="first_name" class="form-label">First Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name" value="{{ old('first_name', $student->first_name) }}" required>
                        @error('first_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name" value="{{ old('last_name', $student->last_name) }}" required>
                        @error('last_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
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
                </div>
                
                <div class="col-md-6">
                    <h4>Academic Information</h4>
                    
                    <div class="mb-3">
                        <label for="program_id" class="form-label">Program <span class="text-danger">*</span></label>
                        <select class="form-select @error('program_id') is-invalid @enderror" id="program_id" name="program_id" required>
                            <option value="">Select Program</option>
                            @foreach ($programs as $program)
                                <option value="{{ $program->program_id }}" {{ old('program_id', $student->program_id) == $program->program_id ? 'selected' : '' }}>
                                    {{ $program->program_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('program_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="year_level" class="form-label">Year Level <span class="text-danger">*</span></label>
                        <select class="form-select @error('year_level') is-invalid @enderror" id="year_level" name="year_level" required>
                            <option value="">Select Year Level</option>
                            <option value="1" {{ old('year_level', $student->year_level) == 1 ? 'selected' : '' }}>1st Year</option>
                            <option value="2" {{ old('year_level', $student->year_level) == 2 ? 'selected' : '' }}>2nd Year</option>
                            <option value="3" {{ old('year_level', $student->year_level) == 3 ? 'selected' : '' }}>3rd Year</option>
                            <option value="4" {{ old('year_level', $student->year_level) == 4 ? 'selected' : '' }}>4th Year</option>
                            <option value="5" {{ old('year_level', $student->year_level) == 5 ? 'selected' : '' }}>5th Year</option>
                        </select>
                        @error('year_level')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                            <option value="Pending" {{ old('status', $student->status) == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Enrolled" {{ old('status', $student->status) == 'Enrolled' ? 'selected' : '' }}>Enrolled</option>
                            <option value="Dropped" {{ old('status', $student->status) == 'Dropped' ? 'selected' : '' }}>Dropped</option>
                            <option value="Graduated" {{ old('status', $student->status) == 'Graduated' ? 'selected' : '' }}>Graduated</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="d-flex justify-content-end">
                <a href="{{ route('admin.students.index') }}" class="btn btn-secondary me-2">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Student</button>
            </div>
        </form>
    </div>
</div>
@endsection 