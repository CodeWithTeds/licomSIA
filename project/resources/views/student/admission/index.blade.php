@extends('layouts.student')

@section('title', 'Admission Application')

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="bg-white/60 backdrop-blur-sm rounded-2xl shadow-lg p-8">
        
        <div class="text-center mb-10">
            <h1 class="text-4xl font-extrabold text-gray-800">Admission Application</h1>
            <p class="text-gray-600 mt-2">Complete the steps below to submit your application.</p>
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

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 px-4 py-3 rounded-lg relative mb-8" role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
        
        <!-- Progress Stepper -->
        <div class="w-full max-w-2xl mx-auto mb-12">
            <div class="flex items-center">
                <div class="step-item flex-1 text-center relative">
                    <div class="step-node w-10 h-10 bg-primary text-white rounded-full flex items-center justify-center mx-auto text-lg font-bold">1</div>
                    <p class="mt-2 text-sm font-semibold text-primary">Personal Info</p>
                </div>
                <div class="step-line flex-1 h-1 bg-gray-300"></div>
                <div class="step-item flex-1 text-center relative">
                    <div class="step-node w-10 h-10 bg-gray-300 text-gray-600 rounded-full flex items-center justify-center mx-auto text-lg font-bold">2</div>
                    <p class="mt-2 text-sm text-gray-500">Family Background</p>
                </div>
                <div class="step-line flex-1 h-1 bg-gray-300"></div>
                <div class="step-item flex-1 text-center relative">
                    <div class="step-node w-10 h-10 bg-gray-300 text-gray-600 rounded-full flex items-center justify-center mx-auto text-lg font-bold">3</div>
                    <p class="mt-2 text-sm text-gray-500">Academic Info</p>
                </div>
            </div>
        </div>

        <form action="{{ route('admission.store') }}" method="POST">
            @csrf

            <!-- Step 1: Personal Information -->
            <div id="step-1" class="step">
                <div class="bg-white p-8 rounded-xl shadow-md border border-gray-100">
                    <h2 class="text-2xl font-bold mb-6 text-gray-700">Personal Information</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @php
                            $fields = [
                                ['name' => 'first_name', 'label' => 'First Name', 'type' => 'text', 'required' => true, 'span' => 'lg:col-span-1'],
                                ['name' => 'last_name', 'label' => 'Last Name', 'type' => 'text', 'required' => true, 'span' => 'lg:col-span-1'],
                                ['name' => 'middle_name', 'label' => 'Middle Name', 'type' => 'text', 'required' => false, 'span' => 'lg:col-span-1'],
                                ['name' => 'suffix_name', 'label' => 'Suffix', 'type' => 'text', 'required' => false, 'placeholder' => 'e.g., Jr., Sr.', 'span' => 'lg:col-span-1'],
                                ['name' => 'email', 'label' => 'Email Address', 'type' => 'email', 'required' => true, 'span' => 'lg:col-span-2'],
                                ['name' => 'mobile_number', 'label' => 'Mobile Number', 'type' => 'tel', 'required' => true, 'span' => 'lg:col-span-1'],
                                ['name' => 'date_of_birth', 'label' => 'Date of Birth', 'type' => 'date', 'required' => true, 'span' => 'lg:col-span-1'],
                                ['name' => 'age', 'label' => 'Age', 'type' => 'number', 'required' => true, 'span' => 'lg:col-span-1'],
                                ['name' => 'gender', 'label' => 'Gender', 'type' => 'select', 'options' => ['' => 'Select Gender', 'Male' => 'Male', 'Female' => 'Female'], 'required' => true, 'span' => 'lg:col-span-1'],
                                ['name' => 'civil_status', 'label' => 'Civil Status', 'type' => 'text', 'required' => true, 'span' => 'lg:col-span-1'],
                                ['name' => 'citizenship', 'label' => 'Citizenship', 'type' => 'text', 'required' => true, 'span' => 'lg:col-span-1'],
                                ['name' => 'religion', 'label' => 'Religion', 'type' => 'text', 'required' => true, 'span' => 'lg:col-span-1'],
                                ['name' => 'home_address', 'label' => 'Home Address', 'type' => 'text', 'required' => true, 'span' => 'md:col-span-2 lg:col-span-3'],
                                ['name' => 'barangay', 'label' => 'Barangay', 'type' => 'text', 'required' => true, 'span' => 'lg:col-span-1'],
                                ['name' => 'city', 'label' => 'City', 'type' => 'text', 'required' => true, 'span' => 'lg:col-span-1'],
                                ['name' => 'province', 'label' => 'Province', 'type' => 'text', 'required' => true, 'span' => 'lg:col-span-1'],
                                ['name' => 'zipcode', 'label' => 'Zip Code', 'type' => 'text', 'required' => true, 'span' => 'lg:col-span-1'],
                            ];
                        @endphp

                        @foreach($fields as $field)
                        <div class="{{ $field['span'] }}">
                            <label for="{{ $field['name'] }}" class="block text-sm font-medium text-gray-700">{{ $field['label'] }}</label>
                            @if($field['type'] === 'select')
                                <select name="{{ $field['name'] }}" id="{{ $field['name'] }}" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" @if($field['required']) required @endif>
                                    @foreach($field['options'] as $value => $label)
                                        <option value="{{ $value }}">{{ $label }}</option>
                                    @endforeach
                                </select>
                            @else
                                <input type="{{ $field['type'] }}" name="{{ $field['name'] }}" id="{{ $field['name'] }}" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" @if($field['required']) required @endif placeholder="{{ $field['placeholder'] ?? '' }}">
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Step 2: Family Background -->
            <div id="step-2" class="step" style="display: none;">
                <div class="bg-white p-8 rounded-xl shadow-md border border-gray-100">
                    <h2 class="text-2xl font-bold mb-6 text-gray-700">Family Background</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="col-span-1 md:col-span-2">
                            <p class="font-semibold text-gray-600">Father's Information</p>
                            <hr class="my-2">
                        </div>
                        <div>
                            <label for="father_first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                            <input type="text" name="father_first_name" id="father_first_name" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" required>
                        </div>
                        <div>
                            <label for="father_last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                            <input type="text" name="father_last_name" id="father_last_name" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" required>
                        </div>
                        <div>
                            <label for="father_middle_name" class="block text-sm font-medium text-gray-700">Middle Name</label>
                            <input type="text" name="father_middle_name" id="father_middle_name" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                        </div>
                        <div>
                            <label for="father_occupation" class="block text-sm font-medium text-gray-700">Occupation</label>
                            <input type="text" name="father_occupation" id="father_occupation" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" required>
                        </div>

                        <div class="col-span-1 md:col-span-2 pt-6">
                            <p class="font-semibold text-gray-600">Mother's Information</p>
                            <hr class="my-2">
                        </div>
                        <div>
                            <label for="mother_first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                            <input type="text" name="mother_first_name" id="mother_first_name" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" required>
                        </div>
                        <div>
                            <label for="mother_last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                            <input type="text" name="mother_last_name" id="mother_last_name" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" required>
                        </div>
                        <div>
                            <label for="mother_middle_name" class="block text-sm font-medium text-gray-700">Middle Name</label>
                            <input type="text" name="mother_middle_name" id="mother_middle_name" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                        </div>
                        <div>
                            <label for="mother_occupation" class="block text-sm font-medium text-gray-700">Occupation</label>
                            <input type="text" name="mother_occupation" id="mother_occupation" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" required>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Step 3: Academic Information -->
            <div id="step-3" class="step" style="display: none;">
                <div class="bg-white p-8 rounded-xl shadow-md border border-gray-100">
                    <h2 class="text-2xl font-bold mb-6 text-gray-700">Academic Information</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="last_school_attended" class="block text-sm font-medium text-gray-700">Last School Attended</label>
                            <input type="text" name="last_school_attended" id="last_school_attended" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" required>
                        </div>
                        <div>
                            <label for="year_graduated" class="block text-sm font-medium text-gray-700">Year Graduated</label>
                            <input type="text" name="year_graduated" id="year_graduated" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                        </div>
                        <div>
                            <label for="admission_type" class="block text-sm font-medium text-gray-700">Admission Type</label>
                            <select name="admission_type" id="admission_type" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" required>
                                <option value="">Select Type</option>
                                <option value="Freshman">Freshman</option>
                                <option value="Transferee">Transferee</option>
                            </select>
                        </div>
                         <div>
                            <label for="program_applied_for" class="block text-sm font-medium text-gray-700">Program Applied For</label>
                            <select name="program_applied_for" id="program_applied_for" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" required>
                                <option value="">Select Program</option>
                                @if(isset($programs))
                                    @foreach($programs as $program)
                                        <option value="{{ $program->program_name }}">{{ $program->program_name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                         <div>
                            <label for="school_year_applied" class="block text-sm font-medium text-gray-700">School Year Applied</label>
                            <input type="text" name="school_year_applied" id="school_year_applied" placeholder="e.g., 2025-2026" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" required>
                        </div>
                        <div>
                            <label for="course_preferences" class="block text-sm font-medium text-gray-700">Course Preferences</label>
                            <input type="text" name="course_preferences" id="course_preferences" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" required>
                        </div>
                         <div>
                            <label for="expected_date_of_grad" class="block text-sm font-medium text-gray-700">Expected Date of Graduation</label>
                            <input type="text" name="expected_date_of_grad" id="expected_date_of_grad" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                        </div>
                         <div>
                            <label for="scholarship" class="block text-sm font-medium text-gray-700">Scholarship (if any)</label>
                            <input type="text" name="scholarship" id="scholarship" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                        </div>
                         <div class="md:col-span-2">
                            <label for="disability" class="block text-sm font-medium text-gray-700">Disability (if any)</label>
                            <textarea name="disability" id="disability" rows="3" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50"></textarea>
                        </div>
                         <div class="md:col-span-2">
                            <label for="upload_requirements" class="block text-sm font-medium text-gray-700">Upload Requirements</label>
                            <input type="file" name="upload_requirements" id="upload_requirements" class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none focus:ring-primary focus:border-primary">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Navigation Buttons -->
            <div class="flex justify-between mt-10">
                <button type="button" id="prev-btn" class="px-6 py-3 bg-gray-300 text-gray-800 font-semibold rounded-lg hover:bg-gray-400 transition" style="display: none;">Previous</button>
                <button type="button" id="next-btn" class="px-6 py-3 bg-primary text-white font-semibold rounded-lg shadow-md hover:bg-primary/90 transition ml-auto">Next Step</button>
                <button type="submit" id="submit-btn" class="px-6 py-3 bg-green-500 text-white font-semibold rounded-lg shadow-md hover:bg-green-600 transition" style="display: none;">Submit Application</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const steps = document.querySelectorAll('.step');
    const prevBtn = document.getElementById('prev-btn');
    const nextBtn = document.getElementById('next-btn');
    const submitBtn = document.getElementById('submit-btn');
    
    const stepItems = document.querySelectorAll('.step-item');
    let currentStep = 0;

    function updateStepper() {
        stepItems.forEach((item, index) => {
            const node = item.querySelector('.step-node');
            const text = item.querySelector('p');
            const line = item.previousElementSibling;

            if (index < currentStep) {
                // Completed step
                node.classList.remove('bg-gray-300', 'text-gray-600', 'bg-primary', 'text-white');
                node.classList.add('bg-green-500', 'text-white');
                node.innerHTML = '<i class="fas fa-check"></i>';
                text.classList.remove('text-gray-500');
                text.classList.add('font-semibold', 'text-primary');
                if (line && line.classList.contains('step-line')) line.classList.add('bg-primary');
            } else if (index === currentStep) {
                // Active step
                node.classList.remove('bg-gray-300', 'text-gray-600', 'bg-green-500');
                node.classList.add('bg-primary', 'text-white');
                node.innerHTML = `${index + 1}`;
                text.classList.remove('text-gray-500');
                text.classList.add('font-semibold', 'text-primary');
                if (line && line.classList.contains('step-line')) line.classList.remove('bg-primary');
            } else {
                // Future step
                node.classList.remove('bg-primary', 'text-white', 'bg-green-500');
                node.classList.add('bg-gray-300', 'text-gray-600');
                node.innerHTML = `${index + 1}`;
                text.classList.remove('font-semibold', 'text-primary');
                text.classList.add('text-gray-500');
                if (line && line.classList.contains('step-line')) line.classList.remove('bg-primary');
            }
        });
    }

    function showStep(stepIndex) {
        steps.forEach((step, index) => {
            step.style.display = index === stepIndex ? 'block' : 'none';
        });

        updateStepper();

        prevBtn.style.display = stepIndex === 0 ? 'none' : 'inline-block';
        nextBtn.style.display = stepIndex === steps.length - 1 ? 'none' : 'inline-block';
        submitBtn.style.display = stepIndex === steps.length - 1 ? 'inline-block' : 'none';
        
        if (stepIndex === steps.length - 1) {
            nextBtn.style.display = 'none';
        } else {
            nextBtn.style.display = 'inline-block';
        }
    }

    nextBtn.addEventListener('click', function () {
        if (currentStep < steps.length - 1) {
            currentStep++;
            showStep(currentStep);
        }
    });

    prevBtn.addEventListener('click', function () {
        if (currentStep > 0) {
            currentStep--;
            showStep(currentStep);
        }
    });

    showStep(currentStep);
});
</script>
@endpush
