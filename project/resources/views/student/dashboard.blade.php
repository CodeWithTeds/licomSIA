@extends('layouts.student')

@section('title', 'Student Dashboard')

@section('content')
    <!-- Hero Section -->
    <section class="flex flex-col md:flex-row items-center justify-between space-y-8 md:space-y-0 md:space-x-12">
        <div class="md:w-1/2">
            <h1 class="text-5xl font-extrabold text-gray-900 leading-tight">
                Your Future <br> Begins Here
            </h1>
            <p class="mt-4 text-lg text-gray-600">
                A centralized digital platform to manage school admissions with ease — from discovery to enrollment.
            </p>
            <div class="mt-8 flex space-x-4">
                <a href="{{ route('student.enroll') }}" class="px-6 py-3 bg-primary text-white font-semibold rounded-lg shadow-md hover:bg-primary/90 transition">
                    Enroll Now
                </a>
              
            </div>
        </div>
        <div class="md:w-1/2 flex justify-center items-center p-8">
            <div class="relative w-80 h-96 group">
                <!-- Background Card -->
                <div class="absolute inset-0 bg-gradient-to-tr from-primary to-secondary rounded-2xl shadow-lg transform-gpu -rotate-6 group-hover:rotate-[-2deg] transition-transform duration-500 ease-in-out"></div>
                
                <!-- Foreground Image Card -->
                <div class="relative w-full h-full bg-white rounded-2xl shadow-xl p-2 transform-gpu rotate-6 group-hover:rotate-[2deg] transition-transform duration-500 ease-in-out">
                     <img class="w-full h-full object-cover rounded-xl" src="{{ asset('images/image.png') }}" alt="Student">
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="mt-20">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="bg-white p-6 rounded-xl shadow-lg flex items-center space-x-4">
                <div class="bg-blue-100 p-3 rounded-full">
                    <i class="fas fa-user-graduate text-2xl text-blue-500"></i>
                </div>
                <div>
                    <p class="text-3xl font-bold text-gray-900">{{ $studentCount }}+</p>
                    <p class="text-gray-500">Students</p>
                </div>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-lg flex items-center space-x-4">
                <div class="bg-green-100 p-3 rounded-full">
                    <i class="fas fa-chalkboard-teacher text-2xl text-green-500"></i>
                </div>
                <div>
                    <p class="text-3xl font-bold text-gray-900">{{ $instructorCount }}+</p>
                    <p class="text-gray-500">Instructors</p>
                </div>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-lg flex items-center space-x-4">
                <div class="bg-purple-100 p-3 rounded-full">
                    <i class="fas fa-book-open text-2xl text-purple-500"></i>
                </div>
                <div>
                    <p class="text-3xl font-bold text-gray-900">{{ $courseCount }}+</p>
                    <p class="text-gray-500">Courses</p>
                </div>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-lg flex items-center space-x-4">
                <div class="bg-yellow-100 p-3 rounded-full">
                    <i class="fas fa-school text-2xl text-yellow-500"></i>
                </div>
                <div>
                    <p class="text-3xl font-bold text-gray-900">{{ $programCount }}+</p>
                    <p class="text-gray-500">Programs</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Quick Links Section -->
    <section class="mt-20">
        <div class="p-6 text-gray-900">
            <h2 class="text-2xl font-bold mb-4">Welcome, {{ Auth::user()->name }}!</h2>
            <p>This is your student dashboard. You can view your grades, admission status, and evaluate your instructors here.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-6">
            <a href="{{ route('student.grades.index') }}" class="bg-blue-500 text-white p-6 rounded-lg shadow-md hover:bg-blue-600 transition">
                <h3 class="text-xl font-bold">My Grades</h3>
                <p>View your academic performance.</p>
            </a>
            <a href="{{ route('student.admission.index') }}" class="bg-green-500 text-white p-6 rounded-lg shadow-md hover:bg-green-600 transition">
                <h3 class="text-xl font-bold">My Admission</h3>
                <p>Check your admission status.</p>
            </a>
            <a href="{{ route('student.evaluations.index') }}" class="bg-yellow-500 text-white p-6 rounded-lg shadow-md hover:bg-yellow-600 transition">
                <h3 class="text-xl font-bold">Instructor Evaluation</h3>
                <p>Evaluate your instructors.</p>
            </a>
        </div>
    </section>
@endsection
