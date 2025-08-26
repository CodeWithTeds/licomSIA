@extends('layouts.student')

@section('content')
<div class="container mx-auto max-w-4xl py-8 px-4">
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Course Enrollment</h1>
            <a href="{{ route('student.dashboard') }}" class="text-blue-600 hover:text-blue-800">
                <i class="fas fa-arrow-left mr-1"></i> Back to Dashboard
            </a>
        </div>

        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                <p>{{ session('error') }}</p>
            </div>
        @endif

        <!-- Multi-step Progress Bar -->
        <div class="mb-10 px-4">
            <div class="flex items-center justify-between mb-2">
                <div class="w-full flex items-center">
                    <!-- Step 1 -->
                    <div class="relative">
                        <div id="step-1-circle" class="bg-primary text-white w-10 h-10 rounded-full flex items-center justify-center font-bold text-lg z-10 relative">
                            1
                        </div>
                        <div class="absolute top-0 mt-12 w-32 text-center -ml-10">
                            <span id="step-1-text" class="text-sm font-medium text-primary">Personal Info</span>
                        </div>
                    </div>
                    
                    <!-- Line between Step 1 and 2 -->
                    <div class="flex-1 h-1 mx-4 bg-gray-300">
                        <div id="line-1-2" class="h-1 bg-gray-300 w-0 transition-all duration-500"></div>
                    </div>
                    
                    <!-- Step 2 -->
                    <div class="relative">
                        <div id="step-2-circle" class="bg-gray-300 text-gray-600 w-10 h-10 rounded-full flex items-center justify-center font-bold text-lg">
                            2
                        </div>
                        <div class="absolute top-0 mt-12 w-32 text-center -ml-10">
                            <span id="step-2-text" class="text-sm font-medium text-gray-500">Course Selection</span>
                        </div>
                    </div>
                    
                    <!-- Line between Step 2 and 3 -->
                    <div class="flex-1 h-1 mx-4 bg-gray-300">
                        <div id="line-2-3" class="h-1 bg-gray-300 w-0 transition-all duration-500"></div>
                    </div>
                    
                    <!-- Step 3 -->
                    <div class="relative">
                        <div id="step-3-circle" class="bg-gray-300 text-gray-600 w-10 h-10 rounded-full flex items-center justify-center font-bold text-lg">
                            3
                        </div>
                        <div class="absolute top-0 mt-12 w-32 text-center -ml-10">
                            <span id="step-3-text" class="text-sm font-medium text-gray-500">Review & Submit</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <form id="enrollment-form" action="{{ route('student.enrollment.store') }}" method="POST">
            @csrf
            <input type="hidden" name="school_year" value="{{ $schoolYear }}">
            <input type="hidden" name="semester" value="{{ $semester }}">
            <input type="hidden" name="status" value="Pending">
            <input type="hidden" name="date_enrolled" value="{{ date('Y-m-d') }}">

            <!-- Step 1: Personal Information -->
            <div id="step-1" class="step-content">
                <div class="bg-blue-50 rounded-lg p-6 mb-8">
                    <h2 class="text-xl font-semibold text-blue-800 mb-4">Enrollment Information</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <p class="text-gray-600 mb-1">
                                <span class="font-medium text-gray-700">Student Name:</span> {{ $student->first_name }} {{ $student->last_name }}
                            </p>
                            <p class="text-gray-600 mb-1">
                                <span class="font-medium text-gray-700">Student ID:</span> {{ $student->student_number ?? 'Not assigned yet' }}
                            </p>
                            <p class="text-gray-600 mb-1">
                                <span class="font-medium text-gray-700">Program:</span> {{ $program->program_name }}
                            </p>
                        </div>
                        <div>
                            <p class="text-gray-600 mb-1">
                                <span class="font-medium text-gray-700">School Year:</span> {{ $schoolYear }}
                            </p>
                            <p class="text-gray-600 mb-1">
                                <span class="font-medium text-gray-700">Semester:</span> {{ $semester }}
                            </p>
                            <p class="text-gray-600 mb-1">
                                <span class="font-medium text-gray-700">Date:</span> {{ date('F d, Y') }}
                            </p>
                        </div>
                    </div>
                    
                    <div class="mt-6">
                        <label for="year_level" class="block text-sm font-medium text-gray-700 mb-1">Year Level</label>
                        <select name="year_level" id="year_level" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md" required>
                            <option value="">Select Year Level</option>
                            <option value="1">First Year</option>
                            <option value="2">Second Year</option>
                            <option value="3">Third Year</option>
                            <option value="4">Fourth Year</option>
                        </select>
                    </div>
                    
                    <div class="mt-4 p-4 bg-yellow-50 border-l-4 border-yellow-400 rounded">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-info-circle text-yellow-400"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-yellow-700">
                                    Your enrollment will be set to <strong>Pending</strong> status until approved by the registrar.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="flex justify-end">
                    <button type="button" id="next-to-step-2" class="bg-primary hover:bg-primary-dark text-white font-medium py-2 px-6 rounded transition-colors">
                        Continue to Course Selection <i class="fas fa-arrow-right ml-1"></i>
                    </button>
                </div>
            </div>

            <!-- Step 2: Course Selection -->
            <div id="step-2" class="step-content hidden">
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Available Courses</h3>
                    
                    @if($courses->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white border border-gray-200">
                                <thead>
                                    <tr>
                                        <th class="py-3 px-4 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-b">Select</th>
                                        <th class="py-3 px-4 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-b">Course Name</th>
                                        <th class="py-3 px-4 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-b">Units</th>
                                        <th class="py-3 px-4 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-b">Year Level</th>
                                        <th class="py-3 px-4 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-b">Instructor</th>
                                        <th class="py-3 px-4 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-b">Schedule</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($courses as $course)
                                        <tr class="hover:bg-gray-50">
                                            <td class="py-3 px-4 border-b border-gray-200">
                                                <input type="checkbox" name="courses[]" value="{{ $course->course_id }}" class="rounded text-primary focus:ring-primary">
                                            </td>
                                            <td class="py-3 px-4 border-b border-gray-200">{{ $course->course_name }}</td>
                                            <td class="py-3 px-4 border-b border-gray-200">{{ $course->units }}</td>
                                            <td class="py-3 px-4 border-b border-gray-200">{{ $course->year_level }}</td>
                                            <td class="py-3 px-4 border-b border-gray-200">
                                                @if($course->instructors->isNotEmpty())
                                                    {{ $course->instructors->pluck('full_name')->join(', ') }}
                                                @else
                                                    TBA
                                                @endif
                                            </td>
                                            <td class="py-3 px-4 border-b border-gray-200">
                                                @if($course->schedules && $course->schedules->count() > 0)
                                                    @foreach($course->schedules as $schedule)
                                                        <div class="mb-1">
                                                            {{ $schedule->day }} {{ $schedule->time_start }} - {{ $schedule->time_end }}, Room {{ $schedule->room }}
                                                        </div>
                                                    @endforeach
                                                @else
                                                    TBA
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="mt-6">
                            <p class="text-sm text-gray-600 mb-4">
                                <i class="fas fa-info-circle text-primary mr-1"></i>
                                Please select the courses you wish to enroll in. Make sure to check the schedule to avoid conflicts.
                            </p>
                        </div>
                    @else
                        <div class="bg-gray-50 rounded-lg p-6 text-center">
                            <p class="text-gray-600">No courses available for your program at this time.</p>
                        </div>
                    @endif
                </div>
                
                <div class="flex justify-between">
                    <button type="button" id="back-to-step-1" class="border border-gray-300 bg-white text-gray-700 hover:bg-gray-50 font-medium py-2 px-6 rounded transition-colors">
                        <i class="fas fa-arrow-left mr-1"></i> Back
                    </button>
                    <button type="button" id="next-to-step-3" class="bg-primary hover:bg-primary-dark text-white font-medium py-2 px-6 rounded transition-colors">
                        Continue to Review <i class="fas fa-arrow-right ml-1"></i>
                    </button>
                </div>
            </div>

            <!-- Step 3: Review & Submit -->
            <div id="step-3" class="step-content hidden">
                <div class="bg-blue-50 rounded-lg p-6 mb-8">
                    <h2 class="text-xl font-semibold text-blue-800 mb-4">Review Your Enrollment</h2>
                    
                    <div class="mb-6">
                        <h3 class="text-md font-semibold text-gray-700 mb-2">Enrollment Details</h3>
                        <div class="bg-white p-4 rounded-lg shadow-sm">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-gray-600 mb-1">
                                        <span class="font-medium text-gray-700">Student:</span> {{ $student->first_name }} {{ $student->last_name }}
                                    </p>
                                    <p class="text-gray-600 mb-1">
                                        <span class="font-medium text-gray-700">Program:</span> {{ $program->program_name }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-gray-600 mb-1">
                                        <span class="font-medium text-gray-700">School Year:</span> {{ $schoolYear }}
                                    </p>
                                    <p class="text-gray-600 mb-1">
                                        <span class="font-medium text-gray-700">Semester:</span> {{ $semester }}
                                    </p>
                                    <p class="text-gray-600 mb-1">
                                        <span class="font-medium text-gray-700">Year Level:</span> <span id="review-year-level">Not selected</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <h3 class="text-md font-semibold text-gray-700 mb-2">Selected Courses</h3>
                        <div class="bg-white p-4 rounded-lg shadow-sm">
                            <div id="selected-courses-container">
                                <p class="text-gray-500 italic">No courses selected yet. Please go back and select courses.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-6 p-4 bg-yellow-50 border-l-4 border-yellow-400 rounded">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-exclamation-triangle text-yellow-400"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-yellow-700">
                                    Please review your enrollment details carefully before submitting. Once submitted, you will need to contact the registrar for any changes.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="flex justify-between">
                    <button type="button" id="back-to-step-2" class="border border-gray-300 bg-white text-gray-700 hover:bg-gray-50 font-medium py-2 px-6 rounded transition-colors">
                        <i class="fas fa-arrow-left mr-1"></i> Back
                    </button>
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-6 rounded transition-colors">
                        <i class="fas fa-check-circle mr-1"></i> Submit Enrollment
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get all step elements
        const step1 = document.getElementById('step-1');
        const step2 = document.getElementById('step-2');
        const step3 = document.getElementById('step-3');
        
        // Get navigation buttons
        const nextToStep2 = document.getElementById('next-to-step-2');
        const backToStep1 = document.getElementById('back-to-step-1');
        const nextToStep3 = document.getElementById('next-to-step-3');
        const backToStep2 = document.getElementById('back-to-step-2');
        
        // Progress indicators
        const step1Circle = document.getElementById('step-1-circle');
        const step2Circle = document.getElementById('step-2-circle');
        const step3Circle = document.getElementById('step-3-circle');
        const step1Text = document.getElementById('step-1-text');
        const step2Text = document.getElementById('step-2-text');
        const step3Text = document.getElementById('step-3-text');
        const line12 = document.getElementById('line-1-2');
        const line23 = document.getElementById('line-2-3');
        
        // Navigation functions
        nextToStep2.addEventListener('click', function() {
            // Validate year level selection
            const yearLevel = document.getElementById('year_level').value;
            if (!yearLevel) {
                alert('Please select a year level to continue.');
                return;
            }
            
            step1.classList.add('hidden');
            step2.classList.remove('hidden');
            
            // Update progress indicators
            step1Circle.classList.remove('bg-primary', 'text-white');
            step1Circle.classList.add('bg-green-500', 'text-white');
            step1Circle.innerHTML = '<i class="fas fa-check"></i>';
            
            step2Circle.classList.remove('bg-gray-300', 'text-gray-600');
            step2Circle.classList.add('bg-primary', 'text-white');
            
            step2Text.classList.remove('text-gray-500');
            step2Text.classList.add('text-primary');
            
            line12.classList.add('bg-green-500');
            line12.style.width = '100%';
            
            // Update year level in review section
            updateYearLevelInReview();
        });
        
        backToStep1.addEventListener('click', function() {
            step2.classList.add('hidden');
            step1.classList.remove('hidden');
            
            // Update progress indicators
            step1Circle.classList.remove('bg-green-500');
            step1Circle.classList.add('bg-primary', 'text-white');
            step1Circle.innerHTML = '1';
            
            step2Circle.classList.remove('bg-primary', 'text-white');
            step2Circle.classList.add('bg-gray-300', 'text-gray-600');
            
            step2Text.classList.remove('text-primary');
            step2Text.classList.add('text-gray-500');
            
            line12.classList.remove('bg-green-500');
            line12.style.width = '0';
        });
        
        nextToStep3.addEventListener('click', function() {
            // Validate that at least one course is selected
            const selectedCourses = document.querySelectorAll('input[name="courses[]"]:checked');
            if (selectedCourses.length === 0) {
                alert('Please select at least one course to continue.');
                return;
            }
            
            step2.classList.add('hidden');
            step3.classList.remove('hidden');
            
            // Update progress indicators
            step2Circle.classList.remove('bg-primary', 'text-white');
            step2Circle.classList.add('bg-green-500', 'text-white');
            step2Circle.innerHTML = '<i class="fas fa-check"></i>';
            
            step3Circle.classList.remove('bg-gray-300', 'text-gray-600');
            step3Circle.classList.add('bg-primary', 'text-white');
            
            step3Text.classList.remove('text-gray-500');
            step3Text.classList.add('text-primary');
            
            line23.classList.add('bg-green-500');
            line23.style.width = '100%';
            
            // Update selected courses in review step
            updateSelectedCoursesReview();
        });
        
        backToStep2.addEventListener('click', function() {
            step3.classList.add('hidden');
            step2.classList.remove('hidden');
            
            // Update progress indicators
            step2Circle.classList.remove('bg-green-500');
            step2Circle.classList.add('bg-primary', 'text-white');
            step2Circle.innerHTML = '2';
            
            step3Circle.classList.remove('bg-primary', 'text-white');
            step3Circle.classList.add('bg-gray-300', 'text-gray-600');
            
            step3Text.classList.remove('text-primary');
            step3Text.classList.add('text-gray-500');
            
            line23.classList.remove('bg-green-500');
            line23.style.width = '0';
        });
        
        // Function to update selected courses in review step
        function updateSelectedCoursesReview() {
            const selectedCourses = document.querySelectorAll('input[name="courses[]"]:checked');
            const selectedCoursesContainer = document.getElementById('selected-courses-container');
            
            if (selectedCourses.length === 0) {
                selectedCoursesContainer.innerHTML = '<p class="text-gray-500 italic">No courses selected yet. Please go back and select courses.</p>';
                return;
            }
            
            let coursesHTML = '<div class="overflow-x-auto"><table class="min-w-full divide-y divide-gray-200">';
            coursesHTML += '<thead class="bg-gray-50"><tr>';
            coursesHTML += '<th scope="col" class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Course Name</th>';
            coursesHTML += '<th scope="col" class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Units</th>';
            coursesHTML += '<th scope="col" class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Year Level</th>';
            coursesHTML += '<th scope="col" class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Schedule</th>';
            coursesHTML += '</tr></thead><tbody>';
            
            let totalUnits = 0;
            
            selectedCourses.forEach(checkbox => {
                const row = checkbox.closest('tr');
                const courseName = row.cells[1].textContent;
                const units = parseInt(row.cells[2].textContent);
                const yearLevel = row.cells[3].textContent;
                const schedule = row.cells[5].textContent;
                
                totalUnits += units;
                
                coursesHTML += '<tr class="bg-white">';
                coursesHTML += `<td class="px-4 py-2 text-sm text-gray-900">${courseName}</td>`;
                coursesHTML += `<td class="px-4 py-2 text-sm text-gray-900">${units}</td>`;
                coursesHTML += `<td class="px-4 py-2 text-sm text-gray-900">${yearLevel}</td>`;
                coursesHTML += `<td class="px-4 py-2 text-sm text-gray-900">${schedule}</td>`;
                coursesHTML += '</tr>';
            });
            
            coursesHTML += '</tbody></table></div>';
            coursesHTML += `<div class="mt-4 text-right"><p class="font-medium">Total Units: <span class="text-primary">${totalUnits}</span></p></div>`;
            
            selectedCoursesContainer.innerHTML = coursesHTML;
        }
        
        // Function to update the year level in the review section
        function updateYearLevelInReview() {
            const yearLevelSelect = document.getElementById('year_level');
            const yearLevelText = document.getElementById('review-year-level');
            const yearLevelValue = yearLevelSelect.value;
            
            if (yearLevelValue) {
                const yearLevelOption = yearLevelSelect.options[yearLevelSelect.selectedIndex].text;
                yearLevelText.textContent = yearLevelOption;
            } else {
                yearLevelText.textContent = 'Not selected';
            }
        }
        
        // Add change event listener to year level select to update the review in real-time
        document.getElementById('year_level').addEventListener('change', function() {
            if (step3.classList.contains('hidden') === false) {
                updateYearLevelInReview();
            }
        });
        
        // Add change event listeners to checkboxes to update the review in real-time
        const courseCheckboxes = document.querySelectorAll('input[name="courses[]"]');
        courseCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                if (step3.classList.contains('hidden') === false) {
                    updateSelectedCoursesReview();
                }
            });
        });
    });
</script>
@endsection 