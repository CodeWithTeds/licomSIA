<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard - LicomSIA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#2768bc',
                        secondary: '#cccb62',
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <nav class="bg-primary text-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <img class="h-8 w-auto" src="{{ asset('images/logoo.png') }}" alt="LicomSIA Logo">
                    </div>
                    <div class="hidden md:ml-6 md:flex md:space-x-8">
                        <a href="#" class="border-b-2 border-white text-white inline-flex items-center px-1 pt-1 text-sm font-medium">
                            Dashboard
                        </a>
                        <a href="#" class="border-transparent text-gray-200 hover:text-white hover:border-gray-300 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Courses
                        </a>
                        <a href="#" class="border-transparent text-gray-200 hover:text-white hover:border-gray-300 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Schedule
                        </a>
                        <a href="#" class="border-transparent text-gray-200 hover:text-white hover:border-gray-300 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Grades
                        </a>
                    </div>
                </div>
                <div class="flex items-center">
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
                            <span class="sr-only">Open user menu</span>
                            <div class="h-8 w-8 rounded-full bg-gray-200 text-gray-700 flex items-center justify-center">
                                <i class="fas fa-user"></i>
                            </div>
                        </button>
                        <div x-show="open" @click.away="open = false" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" style="display: none;">
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Your Profile</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>
                            <form method="POST" action="{{ route('student.logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Sign out</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="py-8 bg-gradient-to-b from-primary/10 to-transparent">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Welcome Back, {{ Auth::user()->name }}</h1>
                    <p class="mt-1 text-sm text-gray-600">
                        @if(Auth::user()->student && Auth::user()->student->program)
                            {{ Auth::user()->student->program->program_name }} | {{ Auth::user()->student->year_level }} Year
                        @else
                            Complete your profile to get started
                        @endif
                    </p>
                </div>
                <div class="hidden md:block">
                    <span class="text-sm text-gray-500">Today is</span>
                    <p class="text-lg font-medium">{{ now()->format('F d, Y') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Enrollment Promotion Banner -->
    <div class="bg-gradient-to-r from-primary to-blue-700 text-white py-4 mb-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center justify-between">
                @php
                    $activeEnrollment = Auth::user()->student->enrollments()
                        ->where('status', 'Pending')
                        ->orWhere('status', 'Enrolled')
                        ->latest()
                        ->first();
                @endphp

                @if($activeEnrollment)
                    <div class="flex items-center mb-3 md:mb-0">
                        @if($activeEnrollment->status == 'Pending')
                            <div class="bg-yellow-100/30 rounded-full p-2 mr-3">
                                <i class="fas fa-clock text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-lg">Enrollment Pending</h3>
                                <p class="text-sm text-white/80">Your enrollment request is being processed</p>
                            </div>
                        @elseif($activeEnrollment->status == 'Approved')
                            <div class="bg-green-100/30 rounded-full p-2 mr-3">
                                <i class="fas fa-check-circle text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-lg">Enrollment Approved!</h3>
                                <p class="text-sm text-white/80">Your courses are ready. Welcome!</p>
                            </div>
                        @else
                            <div class="bg-white/20 rounded-full p-2 mr-3">
                                <i class="fas fa-user-graduate text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-lg">You're Enrolled!</h3>
                                <p class="text-sm text-white/80">{{ $activeEnrollment->school_year }} - {{ $activeEnrollment->semester }} Semester</p>
                            </div>
                        @endif
                    </div>
                    <div class="flex space-x-3">
                        <a href="{{ route('student.enrollment.show', $activeEnrollment) }}" class="bg-white text-primary hover:bg-white/90 px-4 py-2 rounded-lg font-medium text-sm transition">
                            View Enrollment
                        </a>
                        <a href="#" class="bg-transparent border border-white text-white hover:bg-white/10 px-4 py-2 rounded-lg font-medium text-sm transition">
                            My Courses
                        </a>
                    </div>
                @else
                    <div class="flex items-center mb-3 md:mb-0">
                        <div class="bg-white/20 rounded-full p-2 mr-3">
                            <i class="fas fa-calendar-check text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg">Course Enrollment Now Open!</h3>
                            <p class="text-sm text-white/80">Secure your spot in your preferred courses before they fill up</p>
                        </div>
                    </div>
                    <div class="flex space-x-3">
                        <a href="{{ route('student.enroll') }}" class="bg-white text-primary hover:bg-white/90 px-4 py-2 rounded-lg font-medium text-sm transition">
                            Enroll Now
                        </a>
                     
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Status Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Enrollment Status -->
                <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 
                    @if(isset($activeEnrollment) && $activeEnrollment->status == 'Enrolled') border-green-500
                    @elseif(isset($activeEnrollment) && $activeEnrollment->status == 'Approved') border-green-500
                    @elseif(isset($activeEnrollment) && $activeEnrollment->status == 'Pending') border-yellow-500
                    @elseif(Auth::user()->student && Auth::user()->student->status == 'Dropped') border-red-500
                    @else border-gray-500 @endif">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full 
                            @if(isset($activeEnrollment) && $activeEnrollment->status == 'Enrolled') bg-green-100
                            @elseif(isset($activeEnrollment) && $activeEnrollment->status == 'Approved') bg-green-100
                            @elseif(isset($activeEnrollment) && $activeEnrollment->status == 'Pending') bg-yellow-100
                            @elseif(Auth::user()->student && Auth::user()->student->status == 'Dropped') bg-red-100
                            @else bg-gray-100 @endif mr-4">
                            <i class="fas fa-user-check text-xl
                                @if(isset($activeEnrollment) && $activeEnrollment->status == 'Enrolled') text-green-500
                                @elseif(isset($activeEnrollment) && $activeEnrollment->status == 'Approved') text-green-500
                                @elseif(isset($activeEnrollment) && $activeEnrollment->status == 'Pending') text-yellow-500
                                @elseif(Auth::user()->student && Auth::user()->student->status == 'Dropped') text-red-500
                                @else text-gray-500 @endif"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 uppercase font-medium">Enrollment Status</p>
                            <p class="text-xl font-bold">
                                @if(isset($activeEnrollment))
                                    {{ $activeEnrollment->status }}
                                @elseif(Auth::user()->student)
                                    {{ Auth::user()->student->status }}
                                @else
                                    Incomplete
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Courses -->
                <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-blue-500">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-100 mr-4">
                            <i class="fas fa-book text-blue-500 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 uppercase font-medium">Enrolled Courses</p>
                            <p class="text-xl font-bold">5</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="#" class="text-sm text-primary hover:text-primary-dark font-medium flex items-center">
                            View courses <i class="fas fa-arrow-right ml-1 text-xs"></i>
                        </a>
                    </div>
                </div>

                <!-- Attendance -->
                <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-purple-500">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-purple-100 mr-4">
                            <i class="fas fa-calendar-check text-purple-500 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 uppercase font-medium">Attendance Rate</p>
                            <p class="text-xl font-bold">95%</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="#" class="text-sm text-primary hover:text-primary-dark font-medium flex items-center">
                            View details <i class="fas fa-arrow-right ml-1 text-xs"></i>
                        </a>
                    </div>
                </div>

                <!-- GPA -->
                <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-amber-500">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-amber-100 mr-4">
                            <i class="fas fa-chart-line text-amber-500 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 uppercase font-medium">Current GPA</p>
                            <p class="text-xl font-bold">3.75</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="#" class="text-sm text-primary hover:text-primary-dark font-medium flex items-center">
                            View grades <i class="fas fa-arrow-right ml-1 text-xs"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Profile Card -->
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="bg-primary/10 px-6 py-4">
                        <h2 class="text-lg font-semibold text-gray-900">Your Profile</h2>
                    </div>
                    <div class="p-6">
                        <div class="flex flex-col items-center mb-6">
                            <div class="h-24 w-24 rounded-full bg-primary/20 text-primary flex items-center justify-center mb-3">
                                <i class="fas fa-user-graduate text-3xl"></i>
                            </div>
                            <h3 class="text-xl font-bold">{{ Auth::user()->name }}</h3>
                            <p class="text-gray-500">
                                @if(Auth::user()->student && Auth::user()->student->student_id)
                                    ID: {{ Auth::user()->student->student_id }}
                                @else
                                    No ID assigned
                                @endif
                            </p>
                        </div>
                        
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <div class="w-8 text-gray-400">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Email</p>
                                    <p class="font-medium">{{ Auth::user()->email }}</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center">
                                <div class="w-8 text-gray-400">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Phone</p>
                                    <p class="font-medium">
                                        @if(Auth::user()->student && Auth::user()->student->phone)
                                            {{ Auth::user()->student->phone }}
                                        @else
                                            Not provided
                                        @endif
                                    </p>
                                </div>
                            </div>
                            
                            <div class="flex items-center">
                                <div class="w-8 text-gray-400">
                                    <i class="fas fa-graduation-cap"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Program</p>
                                    <p class="font-medium">
                                        @if(Auth::user()->student && Auth::user()->student->program)
                                            {{ Auth::user()->student->program->program_name }}
                                        @else
                                            Not enrolled
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-6">
                            <a href="#" class="block w-full py-2 px-4 bg-primary hover:bg-primary/90 text-white text-center rounded-lg transition">
                                Edit Profile
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Schedule Card -->
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="bg-primary/10 px-6 py-4 flex justify-between items-center">
                        <h2 class="text-lg font-semibold text-gray-900">Today's Schedule</h2>
                        <span class="text-sm text-primary font-medium">{{ now()->format('l') }}</span>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <div class="flex items-start p-3 bg-blue-50 rounded-lg">
                                <div class="bg-blue-100 text-blue-600 rounded-lg h-12 w-12 flex items-center justify-center mr-4">
                                    <span class="font-bold">8:00</span>
                                </div>
                                <div>
                                    <h4 class="font-medium">Introduction to Computer Science</h4>
                                    <p class="text-sm text-gray-500">Room 101 • Prof. Johnson</p>
                                    <div class="mt-1 flex items-center">
                                        <span class="inline-block h-2 w-2 rounded-full bg-green-500 mr-2"></span>
                                        <span class="text-xs text-green-600 font-medium">In Progress</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="flex items-start p-3 rounded-lg">
                                <div class="bg-gray-100 text-gray-600 rounded-lg h-12 w-12 flex items-center justify-center mr-4">
                                    <span class="font-bold">10:30</span>
                                </div>
                                <div>
                                    <h4 class="font-medium">Calculus I</h4>
                                    <p class="text-sm text-gray-500">Room 205 • Prof. Smith</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start p-3 rounded-lg">
                                <div class="bg-gray-100 text-gray-600 rounded-lg h-12 w-12 flex items-center justify-center mr-4">
                                    <span class="font-bold">1:00</span>
                                </div>
                                <div>
                                    <h4 class="font-medium">English Composition</h4>
                                    <p class="text-sm text-gray-500">Room 310 • Prof. Williams</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-6">
                            <a href="#" class="block w-full py-2 px-4 bg-gray-100 hover:bg-gray-200 text-center rounded-lg transition">
                                View Full Schedule
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Quick Links Card -->
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="bg-primary/10 px-6 py-4">
                        <h2 class="text-lg font-semibold text-gray-900">Quick Links</h2>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-2 gap-4">
                            <a href="#" class="flex flex-col items-center justify-center p-4 bg-gray-50 hover:bg-gray-100 rounded-xl transition">
                                <div class="h-12 w-12 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center mb-2">
                                    <i class="fas fa-book"></i>
                                </div>
                                <span class="text-sm font-medium text-center">My Courses</span>
                            </a>
                            
                            <a href="#" class="flex flex-col items-center justify-center p-4 bg-gray-50 hover:bg-gray-100 rounded-xl transition">
                                <div class="h-12 w-12 rounded-full bg-green-100 text-green-600 flex items-center justify-center mb-2">
                                    <i class="fas fa-chart-bar"></i>
                                </div>
                                <span class="text-sm font-medium text-center">Grades</span>
                            </a>
                            
                            <a href="#" class="flex flex-col items-center justify-center p-4 bg-gray-50 hover:bg-gray-100 rounded-xl transition">
                                <div class="h-12 w-12 rounded-full bg-purple-100 text-purple-600 flex items-center justify-center mb-2">
                                    <i class="fas fa-calendar"></i>
                                </div>
                                <span class="text-sm font-medium text-center">Calendar</span>
                            </a>
                            
                            <a href="#" class="flex flex-col items-center justify-center p-4 bg-gray-50 hover:bg-gray-100 rounded-xl transition">
                                <div class="h-12 w-12 rounded-full bg-amber-100 text-amber-600 flex items-center justify-center mb-2">
                                    <i class="fas fa-question-circle"></i>
                                </div>
                                <span class="text-sm font-medium text-center">Help Center</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            


            <!-- Enrollment Information Section -->
            <div class="mt-8">
                <h2 class="text-xl font-bold mb-4 text-gray-900">Enrollment Information</h2>
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="bg-primary/10 p-6">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="h-12 w-12 rounded-full bg-primary/20 text-primary flex items-center justify-center mr-4">
                                    <i class="fas fa-book-open text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="font-bold text-lg">2023-2024 Course Enrollment</h3>
                                    <p class="text-sm text-gray-600">Secure your spot in your preferred courses</p>
                                </div>
                            </div>
                            <div class="hidden md:block">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                    <span class="h-2 w-2 rounded-full bg-green-600 mr-2"></span>
                                    Now Open
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="border border-gray-100 rounded-lg p-4 hover:shadow-md transition">
                                <div class="flex items-center mb-3">
                                    <div class="h-10 w-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center mr-3">
                                        <i class="fas fa-calendar-alt"></i>
                                    </div>
                                    <h4 class="font-semibold">Important Dates</h4>
                                </div>
                                <ul class="space-y-2 text-sm">
                                    <li class="flex justify-between">
                                        <span class="text-gray-600">Enrollment Start:</span>
                                        <span class="font-medium">August 1, 2023</span>
                                    </li>
                                    <li class="flex justify-between">
                                        <span class="text-gray-600">Enrollment Deadline:</span>
                                        <span class="font-medium">August 31, 2023</span>
                                    </li>
                                    <li class="flex justify-between">
                                        <span class="text-gray-600">Classes Begin:</span>
                                        <span class="font-medium">September 5, 2023</span>
                                    </li>
                                    <li class="flex justify-between">
                                        <span class="text-gray-600">Add/Drop Period:</span>
                                        <span class="font-medium">Sept 5-12, 2023</span>
                                    </li>
                                </ul>
                            </div>
                            
                            <div class="border border-gray-100 rounded-lg p-4 hover:shadow-md transition">
                                <div class="flex items-center mb-3">
                                    <div class="h-10 w-10 rounded-full bg-amber-100 text-amber-600 flex items-center justify-center mr-3">
                                        <i class="fas fa-clipboard-list"></i>
                                    </div>
                                    <h4 class="font-semibold">Enrollment Steps</h4>
                                </div>
                                <ul class="space-y-2 text-sm">
                                    <li class="flex items-start">
                                        <span class="flex-shrink-0 h-5 w-5 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center mr-2 text-xs font-bold">1</span>
                                        <span>Browse available courses</span>
                                    </li>
                                    <li class="flex items-start">
                                        <span class="flex-shrink-0 h-5 w-5 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center mr-2 text-xs font-bold">2</span>
                                        <span>Select desired courses</span>
                                    </li>
                                    <li class="flex items-start">
                                        <span class="flex-shrink-0 h-5 w-5 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center mr-2 text-xs font-bold">3</span>
                                        <span>Review your selection</span>
                                    </li>
                                    <li class="flex items-start">
                                        <span class="flex-shrink-0 h-5 w-5 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center mr-2 text-xs font-bold">4</span>
                                        <span>Submit enrollment request</span>
                                    </li>
                                    <li class="flex items-start">
                                        <span class="flex-shrink-0 h-5 w-5 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center mr-2 text-xs font-bold">5</span>
                                        <span>Wait for confirmation</span>
                                    </li>
                                </ul>
                            </div>
                            
                            <div class="border border-gray-100 rounded-lg p-4 hover:shadow-md transition">
                                <div class="flex items-center mb-3">
                                    <div class="h-10 w-10 rounded-full bg-green-100 text-green-600 flex items-center justify-center mr-3">
                                        <i class="fas fa-lightbulb"></i>
                                    </div>
                                    <h4 class="font-semibold">Enrollment Tips</h4>
                                </div>
                                <ul class="space-y-2 text-sm">
                                    <li class="flex items-start">
                                        <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                                        <span>Enroll early to secure your spot</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                                        <span>Check prerequisites for each course</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                                        <span>Balance your schedule throughout the week</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                                        <span>Consider course difficulty when planning</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                                        <span>Have backup courses ready</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="mt-6 flex justify-center">
                            <a href="{{ route('student.enroll') }}" class="inline-flex items-center justify-center px-6 py-3 bg-primary hover:bg-primary-dark text-white font-medium rounded-lg transition">
                                <i class="fas fa-check-circle mr-2"></i> Enroll in Courses
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Announcements Section -->
            <div class="mt-8">
                <h2 class="text-xl font-bold mb-4 text-gray-900">Announcements & Updates</h2>
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="p-6">
                        <div class="space-y-6">
                            <div class="border-b border-gray-100 pb-6">
                                <div class="flex items-center mb-2">
                                    <div class="h-10 w-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center mr-3">
                                        <i class="fas fa-bullhorn"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-lg">Welcome to the New Semester</h3>
                                        <p class="text-sm text-gray-500">Posted on August 15, 2023</p>
                                    </div>
                                </div>
                                <p class="text-gray-700">Welcome to the new academic semester! We're excited to have you back on campus. Please check your schedule for any updates and make sure to complete all registration requirements by the end of this week.</p>
                                <div class="mt-3">
                                    <a href="#" class="text-primary hover:text-primary-dark text-sm font-medium">Read more</a>
                                </div>
                            </div>
                            
                            <div class="border-b border-gray-100 pb-6">
                                <div class="flex items-center mb-2">
                                    <div class="h-10 w-10 rounded-full bg-amber-100 text-amber-600 flex items-center justify-center mr-3">
                                        <i class="fas fa-book"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-lg">Library Hours Extended</h3>
                                        <p class="text-sm text-gray-500">Posted on August 10, 2023</p>
                                    </div>
                                </div>
                                <p class="text-gray-700">The library will now be open until 10 PM on weekdays to accommodate students preparing for midterm exams. Additional study rooms have been made available for group study sessions.</p>
                                <div class="mt-3">
                                    <a href="#" class="text-primary hover:text-primary-dark text-sm font-medium">Read more</a>
                                </div>
                            </div>
                            
                            <div>
                                <div class="flex items-center mb-2">
                                    <div class="h-10 w-10 rounded-full bg-red-100 text-red-600 flex items-center justify-center mr-3">
                                        <i class="fas fa-tools"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-lg">Campus Maintenance Notice</h3>
                                        <p class="text-sm text-gray-500">Posted on August 5, 2023</p>
                                    </div>
                                </div>
                                <p class="text-gray-700">The west wing of the Science Building will be closed for renovations from August 20-25. Classes will be temporarily relocated to the Engineering Building. Please check your email for specific room assignments.</p>
                                <div class="mt-3">
                                    <a href="#" class="text-primary hover:text-primary-dark text-sm font-medium">Read more</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-6 text-center">
                            <a href="#" class="inline-flex items-center justify-center px-4 py-2 border border-primary text-primary hover:bg-primary hover:text-white rounded-lg transition">
                                View All Announcements
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html> 