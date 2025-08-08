@extends('layouts.student')

@section('title', 'Admission Application')

@section('content')
<div class="bg-gradient-to-br from-gray-50 to-gray-100 p-4 sm:p-8 rounded-2xl shadow-lg">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-4xl font-bold text-gray-800 mb-2 text-center">Admission Application</h1>
        <p class="text-center text-gray-600 mb-8">Please fill out the form carefully and accurately.</p>
    
        <!-- Progress Bar -->
        <div class="mb-8">
            <div class="w-full bg-gray-200 rounded-full h-2.5">
                <div class="bg-primary h-2.5 rounded-full transition-all duration-500" style="width: 0%" id="progress-bar"></div>
            </div>
            <div class="flex justify-between text-xs text-gray-600 mt-2 font-medium">
                <span id="step-personal" class="w-1/4 text-center">Personal Info</span>
                <span id="step-family" class="w-1/4 text-center">Family Info</span>
                <span id="step-academic" class="w-1/4 text-center">Academic Info</span>
                <span id="step-upload" class="w-1/4 text-center">Upload Documents</span>
                <span id="step-review" class="w-1/4 text-center">Review</span>
            </div>
        </div>

    @if($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded-lg relative mb-8" role="alert">
            <strong class="font-bold">Oops! Please fix the following errors:</strong>
            <ul class="mt-2 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

        <form action="{{ route('student.admission.store') }}" method="POST" id="admissionForm" enctype="multipart/form-data">
        @csrf
            <!-- Step 1: Personal Information -->
            <div id="step1" class="form-step">
                <div class="bg-white p-6 rounded-lg shadow-md">
                                        <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-3">Personal Information</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label for="mobile_number" class="block text-sm font-medium text-gray-700">Mobile Number</label>
                            <input type="text" name="mobile_number" id="mobile_number" value="{{ old('mobile_number', $student->contact_number) }}" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" required>
                        </div>
                        <div>
                            <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                            <select name="gender" id="gender" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" required>
                                <option value="">Select Gender</option>
                                <option value="Male" {{ old('gender', $student->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ old('gender', $student->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                                <option value="Other" {{ old('gender', $student->gender) == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>
                        <div>
                            <label for="date_of_birth" class="block text-sm font-medium text-gray-700">Date of Birth</label>
                            <input type="date" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth', $student->birthdate) }}" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" required>
                        </div>
                        <input type="hidden" name="first_name" value="{{ $student->first_name }}">
                        <input type="hidden" name="last_name" value="{{ $student->last_name }}">
                        <input type="hidden" name="middle_name" value="{{ $student->middle_name }}">
                        <input type="hidden" name="email" value="{{ $student->user->email }}">
                        <div>
                            <label for="civil_status" class="block text-sm font-medium text-gray-700">Civil Status</label>
                            <input type="text" name="civil_status" id="civil_status" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" required>
                        </div>
                        <div>
                            <label for="citizenship" class="block text-sm font-medium text-gray-700">Citizenship</label>
                            <input type="text" name="citizenship" id="citizenship" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" required>
                        </div>
                        <div>
                            <label for="religion" class="block text-sm font-medium text-gray-700">Religion</label>
                            <input type="text" name="religion" id="religion" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" required>
                        </div>
                        <div>
                            <label for="age" class="block text-sm font-medium text-gray-700">Age</label>
                            <input type="number" name="age" id="age" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" required>
                        </div>
                        <div>
                            <label for="suffix_name" class="block text-sm font-medium text-gray-700">Suffix (if any)</label>
                            <input type="text" name="suffix_name" id="suffix_name" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                        </div>
                    </div>

                    <h3 class="text-xl font-bold text-gray-700 mt-8 mb-4">Home Address</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                         <div>
                            <label for="home_address" class="block text-sm font-medium text-gray-700">Street Address</label>
                            <input type="text" name="home_address" id="home_address" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" required>
                        </div>
                        <div>
                            <label for="barangay" class="block text-sm font-medium text-gray-700">Barangay</label>
                            <input type="text" name="barangay" id="barangay" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" required>
                        </div>
                        <div>
                            <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                            <input type="text" name="city" id="city" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" required>
                        </div>
                        <div>
                            <label for="province" class="block text-sm font-medium text-gray-700">Province</label>
                            <input type="text" name="province" id="province" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" required>
                        </div>
                        <div>
                            <label for="zipcode" class="block text-sm font-medium text-gray-700">Zipcode</label>
                            <input type="text" name="zipcode" id="zipcode" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" required>
                        </div>
                        <div>
                            <label for="disability" class="block text-sm font-medium text-gray-700">Disability (if any)</label>
                            <input type="text" name="disability" id="disability" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
            </div>
        </div>

                    <div class="flex justify-end mt-8">
                        <button type="button" class="next-step px-6 py-3 bg-primary text-white font-semibold rounded-lg shadow-md hover:bg-primary/90 transition-all duration-300 transform hover:scale-105">
                            Next: Family Information <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Step 2: Family Background -->
            <div id="step2" class="form-step hidden">
                 <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-3">Family Background</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="father_first_name" class="block text-sm font-medium text-gray-700">Father's First Name</label>
                            <input type="text" name="father_first_name" id="father_first_name" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" required>
            </div>
            <div>
                <label for="father_last_name" class="block text-sm font-medium text-gray-700">Father's Last Name</label>
                            <input type="text" name="father_last_name" id="father_last_name" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" required>
                        </div>
                        <div>
                            <label for="father_middle_name" class="block text-sm font-medium text-gray-700">Father's Middle Name</label>
                            <input type="text" name="father_middle_name" id="father_middle_name" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
            </div>
             <div>
                <label for="father_occupation" class="block text-sm font-medium text-gray-700">Father's Occupation</label>
                            <input type="text" name="father_occupation" id="father_occupation" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" required>
            </div>
            <div>
                <label for="mother_first_name" class="block text-sm font-medium text-gray-700">Mother's First Name</label>
                            <input type="text" name="mother_first_name" id="mother_first_name" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" required>
            </div>
            <div>
                <label for="mother_last_name" class="block text-sm font-medium text-gray-700">Mother's Last Name</label>
                            <input type="text" name="mother_last_name" id="mother_last_name" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" required>
                        </div>
                        <div>
                            <label for="mother_middle_name" class="block text-sm font-medium text-gray-700">Mother's Middle Name</label>
                            <input type="text" name="mother_middle_name" id="mother_middle_name" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
            </div>
             <div>
                <label for="mother_occupation" class="block text-sm font-medium text-gray-700">Mother's Occupation</label>
                            <input type="text" name="mother_occupation" id="mother_occupation" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" required>
            </div>
        </div>
        
                    <div class="flex justify-between mt-8">
                        <button type="button" class="prev-step px-6 py-3 bg-gray-300 text-gray-700 font-semibold rounded-lg shadow-md hover:bg-gray-400 transition-all duration-300 transform hover:scale-105">
                             <i class="fas fa-arrow-left mr-2"></i> Back: Personal Information
                        </button>
                        <button type="button" class="next-step px-6 py-3 bg-primary text-white font-semibold rounded-lg shadow-md hover:bg-primary/90 transition-all duration-300 transform hover:scale-105">
                            Next: Academic Information <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Step 3: Academic Information -->
            <div id="step3" class="form-step hidden">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-3">Academic Information</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="program_id" class="block text-sm font-medium text-gray-700">Program</label>
                            <select name="program_id" id="program_id" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" required>
                                <option value="">Select a program</option>
                                @foreach($programs as $program)
                                    <option value="{{ $program->program_id }}">{{ $program->program_name }}</option>
                                @endforeach
                            </select>
                            <input type="hidden" name="program_applied_for" id="program_applied_for">
            </div>
            <div>
                <label for="last_school_attended" class="block text-sm font-medium text-gray-700">Last School Attended</label>
                            <input type="text" name="last_school_attended" id="last_school_attended" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" required>
            </div>
            <div>
                <label for="year_graduated" class="block text-sm font-medium text-gray-700">Year Graduated</label>
                            <input type="text" name="year_graduated" id="year_graduated" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
            </div>
             <div>
                <label for="school_year_applied" class="block text-sm font-medium text-gray-700">School Year Applied</label>
                            <input type="text" name="school_year_applied" id="school_year_applied" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" placeholder="e.g. 2024-2025" required>
                        </div>
                        <div>
                            <label for="course_preferences" class="block text-sm font-medium text-gray-700">Course Preferences</label>
                            <input type="text" name="course_preferences" id="course_preferences" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" required>
                        </div>
                        <div>
                            <label for="admission_type" class="block text-sm font-medium text-gray-700">Admission Type</label>
                            <select name="admission_type" id="admission_type" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" required>
                                <option value="">Select admission type</option>
                                <option value="Freshman">Freshman</option>
                                <option value="Transferee">Transferee</option>
                                <option value="Returnee">Returnee</option>
                            </select>
                        </div>
                        <div>
                            <label for="scholarship" class="block text-sm font-medium text-gray-700">Scholarship (if any)</label>
                            <input type="text" name="scholarship" id="scholarship" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                        </div>
                        <div>
                            <label for="expected_date_of_grad" class="block text-sm font-medium text-gray-700">Expected Date of Graduation</label>
                            <input type="text" name="expected_date_of_grad" id="expected_date_of_grad" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                        </div>
                    </div>

                    <div class="flex justify-between mt-8">
                         <button type="button" class="prev-step px-6 py-3 bg-gray-300 text-gray-700 font-semibold rounded-lg shadow-md hover:bg-gray-400 transition-all duration-300 transform hover:scale-105">
                             <i class="fas fa-arrow-left mr-2"></i> Back: Family Information
                        </button>
                        <button type="button" class="next-step px-6 py-3 bg-primary text-white font-semibold rounded-lg shadow-md hover:bg-primary/90 transition-all duration-300 transform hover:scale-105">
                            Next: Upload Documents <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Step 4: Upload Requirements -->
            <div id="step4" class="form-step hidden">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-3">Upload Requirements</h2>
                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <label for="upload_requirements" class="block text-sm font-medium text-gray-700">Upload Your Documents</label>
                            <div class="mt-2 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="upload_requirements" class="relative cursor-pointer bg-white rounded-md font-medium text-primary hover:text-primary-dark focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-primary">
                                            <span>Upload a file</span>
                                            <input id="upload_requirements" name="upload_requirements" type="file" class="sr-only">
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-xs text-gray-500">PNG, JPG, PDF up to 10MB</p>
                                </div>
                            </div>
                        </div>
                    </div>
                     <div class="flex justify-between mt-8">
                        <button type="button" class="prev-step px-6 py-3 bg-gray-300 text-gray-700 font-semibold rounded-lg shadow-md hover:bg-gray-400 transition-all duration-300 transform hover:scale-105">
                           <i class="fas fa-arrow-left mr-2"></i> Back: Academic Information
                        </button>
                        <button type="button" id="review-button" class="px-6 py-3 bg-primary text-white font-semibold rounded-lg shadow-md hover:bg-primary/90 transition-all duration-300 transform hover:scale-105">
                            Review Application <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Step 5: Review and Submit -->
            <div id="step5" class="form-step hidden">
                 <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-3">Review Your Application</h2>
                    
                    <div class="space-y-8">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-700 mb-2 flex items-center"><i class="fas fa-user mr-2 text-primary"></i>Personal Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-gray-50 p-4 rounded-lg shadow-inner">
                                <div class="flex flex-col">
                                    <span class="text-sm text-gray-500">Name</span>
                                    <span class="font-medium text-gray-800">{{ $student->first_name }} {{ $student->middle_name }} {{ $student->last_name }}</span>
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-sm text-gray-500">Email</span>
                                    <span class="font-medium text-gray-800">{{ $student->user->email }}</span>
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-sm text-gray-500">Civil Status</span>
                                    <span class="font-medium text-gray-800" id="review-civil-status"></span>
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-sm text-gray-500">Religion</span>
                                    <span class="font-medium text-gray-800" id="review-religion"></span>
                                </div>
                                <div class="flex flex-col col-span-2">
                                    <span class="text-sm text-gray-500">Address</span>
                                    <span class="font-medium text-gray-800" id="review-address"></span>
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <h3 class="text-lg font-semibold text-gray-700 mb-2 flex items-center"><i class="fas fa-users mr-2 text-primary"></i>Family Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-gray-50 p-4 rounded-lg shadow-inner">
                                <div class="flex flex-col">
                                    <span class="text-sm text-gray-500">Father's Name</span>
                                    <span class="font-medium text-gray-800" id="review-father-name"></span>
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-sm text-gray-500">Father's Occupation</span>
                                    <span class="font-medium text-gray-800" id="review-father-occupation"></span>
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-sm text-gray-500">Mother's Name</span>
                                    <span class="font-medium text-gray-800" id="review-mother-name"></span>
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-sm text-gray-500">Mother's Occupation</span>
                                    <span class="font-medium text-gray-800" id="review-mother-occupation"></span>
                                </div>
            </div>
        </div>

                        <div>
                             <h3 class="text-lg font-semibold text-gray-700 mb-2 flex items-center"><i class="fas fa-graduation-cap mr-2 text-primary"></i>Academic Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-gray-50 p-4 rounded-lg shadow-inner">
                                <div class="flex flex-col">
                                    <span class="text-sm text-gray-500">Program Applied For</span>
                                    <span class="font-medium text-gray-800" id="review-program"></span>
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-sm text-gray-500">Last School Attended</span>
                                    <span class="font-medium text-gray-800" id="review-last-school"></span>
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-sm text-gray-500">School Year Applied</span>
                                    <span class="font-medium text-gray-800" id="review-school-year"></span>
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-sm text-gray-500">Admission Type</span>
                                    <span class="font-medium text-gray-800" id="review-admission-type"></span>
                                </div>
                            </div>
                        </div>
                         <div>
                             <h3 class="text-lg font-semibold text-gray-700 mb-2 flex items-center"><i class="fas fa-file-upload mr-2 text-primary"></i>Uploaded Document</h3>
                             <div class="bg-gray-50 p-4 rounded-lg shadow-inner">
                                 <p id="review-upload-file" class="text-sm text-gray-800 font-medium">No file selected.</p>
                             </div>
                        </div>
                    </div>

                    <div class="flex justify-between mt-8">
                        <button type="button" class="prev-step px-6 py-3 bg-gray-300 text-gray-700 font-semibold rounded-lg shadow-md hover:bg-gray-400 transition-all duration-300 transform hover:scale-105">
                             <i class="fas fa-arrow-left mr-2"></i> Back: Upload Documents
                        </button>
                        <button type="submit" class="px-6 py-3 bg-green-600 text-white font-semibold rounded-lg shadow-md hover:bg-green-700 transition-all duration-300 transform hover:scale-105">
                            <i class="fas fa-check-circle mr-2"></i> Submit Application
            </button>
                    </div>
                </div>
        </div>
    </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('admissionForm');
        const progressBar = document.getElementById('progress-bar');
        const steps = document.querySelectorAll('.form-step');
        const nextButtons = document.querySelectorAll('.next-step');
        const prevButtons = document.querySelectorAll('.prev-step');
        const reviewButton = document.getElementById('review-button');
        const stepLabels = ['step-personal', 'step-family', 'step-academic', 'step-upload', 'step-review'];
        let currentStep = 0;
        
        function showStep(stepIndex) {
            steps.forEach((step, index) => {
                step.classList.toggle('hidden', index !== stepIndex);
            });
            
            stepLabels.forEach((labelId, index) => {
                const label = document.getElementById(labelId);
                if(label) {
                    if (index < stepIndex) {
                        label.classList.add('text-primary', 'font-bold');
                    } else if (index === stepIndex) {
                        label.classList.add('font-bold');
                        label.classList.remove('text-primary');
                    } else {
                        label.classList.remove('font-bold', 'text-primary');
                    }
                }
            });
            
            const stepProgress = (stepIndex / (steps.length - 1)) * 100;
            progressBar.style.width = stepProgress + '%';
            
            currentStep = stepIndex;
        }
        
        nextButtons.forEach(button => {
            button.addEventListener('click', function() {
                const currentStepFields = steps[currentStep].querySelectorAll('input[required], select[required]');
                let isValid = true;
                
                currentStepFields.forEach(field => {
                    if (!field.value.trim()) {
                        isValid = false;
                        field.classList.add('border-red-500');
                        field.classList.remove('border-gray-300');
                    } else {
                        field.classList.remove('border-red-500');
                        field.classList.add('border-gray-300');
                    }
                });
                
                if (isValid) {
                    showStep(currentStep + 1);
                } else {
                    alert('Please fill in all required fields before proceeding.');
                }
            });
        });
        
        prevButtons.forEach(button => {
            button.addEventListener('click', function() {
                showStep(currentStep - 1);
            });
        });
        
        reviewButton.addEventListener('click', function() {
            const currentStepFields = steps[currentStep].querySelectorAll('input[required], select[required]');
            let isValid = true;
            
            currentStepFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    field.classList.add('border-red-500');
                } else {
                    field.classList.remove('border-red-500');
                }
            });
            
            if (isValid) {
                document.getElementById('review-civil-status').textContent = document.getElementById('civil_status').value;
                document.getElementById('review-religion').textContent = document.getElementById('religion').value;
                document.getElementById('review-address').textContent = 
                    `${document.getElementById('home_address').value}, ${document.getElementById('barangay').value}, ${document.getElementById('city').value}, ${document.getElementById('province').value}`;
                
                const fatherName = 
                    `${document.getElementById('father_first_name').value} ${document.getElementById('father_middle_name').value || ''} ${document.getElementById('father_last_name').value}`;
                document.getElementById('review-father-name').textContent = fatherName.trim();
                document.getElementById('review-father-occupation').textContent = document.getElementById('father_occupation').value;
                
                const motherName = 
                     `${document.getElementById('mother_first_name').value} ${document.getElementById('mother_middle_name').value || ''} ${document.getElementById('mother_last_name').value}`;
                document.getElementById('review-mother-name').textContent = motherName.trim();
                document.getElementById('review-mother-occupation').textContent = document.getElementById('mother_occupation').value;
                
                const programSelect = document.getElementById('program_id');
                document.getElementById('review-program').textContent = programSelect.options[programSelect.selectedIndex].text;
                document.getElementById('review-last-school').textContent = document.getElementById('last_school_attended').value;
                document.getElementById('review-school-year').textContent = document.getElementById('school_year_applied').value;
                
                const admissionTypeSelect = document.getElementById('admission_type');
                document.getElementById('review-admission-type').textContent = admissionTypeSelect.options[admissionTypeSelect.selectedIndex].text;
                
                const uploadInput = document.getElementById('upload_requirements');
                if (uploadInput.files.length > 0) {
                    document.getElementById('review-upload-file').textContent = uploadInput.files[0].name;
                } else {
                    document.getElementById('review-upload-file').textContent = 'No file selected.';
                }
                
                showStep(currentStep + 1);
            } else {
                alert('Please fill in all required fields before proceeding.');
            }
        });
        
        document.getElementById('program_id').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            document.getElementById('program_applied_for').value = selectedOption.text;
        });

        // Set initial value for program_applied_for if a program is selected
        const programSelect = document.getElementById('program_id');
        if (programSelect.selectedIndex > 0) {
            const selectedOption = programSelect.options[programSelect.selectedIndex];
            document.getElementById('program_applied_for').value = selectedOption.text;
        }

        const uploadInput = document.getElementById('upload_requirements');
        const fileLabel = uploadInput.closest('.flex').querySelector('span');
        uploadInput.addEventListener('change', () => {
            if (uploadInput.files.length > 0) {
                 fileLabel.textContent = uploadInput.files[0].name;
            } else {
                 fileLabel.textContent = 'Upload a file';
            }
        })
        
        showStep(0);
    });
</script>
@endsection 