<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="LicomSIA - Student Information System with Admission for Libon Community College">
    
    <title>{{ config('app.name', 'LicomSIA') }} - Student Portal</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#2768bc',
                        secondary: '#cccb62',
                        dark: '#131417',
                        light: '#e2e4e3'
                    }
                }
            }
        }
    </script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    <style>
        [x-cloak] { display: none !important; }
        .select2-container--default .select2-selection--single {
            height: 38px;
            border-radius: 0.375rem;
            border-color: rgb(209, 213, 219);
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 38px;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 36px;
        }
        .select2-container .select2-selection--single .select2-selection__rendered {
            padding-left: 12px;
        }
    </style>
    
    @yield('head')
</head>
<body class="antialiased bg-[#e2e4e3] text-[#131417]">
    <header>
        <!-- Student Navigation Bar -->
        <nav class="bg-primary text-white shadow-md">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="flex-shrink-0 flex items-center">
                            <a href="{{ route('student.dashboard') }}">
                                <img class="h-8 w-auto" src="{{ asset('images/logo.png') }}" alt="LicomSIA Logo">
                            </a>
                        </div>
                        <div class="hidden md:ml-6 md:flex md:space-x-8">
                            <a href="{{ route('student.dashboard') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('student.dashboard') ? 'border-secondary font-medium' : 'border-transparent hover:border-gray-300' }} text-sm font-medium">
                                Dashboard
                            </a>
                            <a href="#" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium hover:border-gray-300">
                                Courses
                            </a>
                            <a href="#" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium hover:border-gray-300">
                                Schedule
                            </a>
                            <a href="#" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium hover:border-gray-300">
                                Grades
                            </a>
                        </div>
                    </div>
                    <div class="hidden md:ml-6 md:flex md:items-center">
                        <div class="ml-3 relative" x-data="userDropdown">
                            <div>
                                <button @click="toggle" type="button" class="flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                    <span class="sr-only">Open user menu</span>
                                    <div class="h-8 w-8 rounded-full bg-gray-200 text-gray-700 flex items-center justify-center">
                                        <i class="fas fa-user"></i>
                                    </div>
                                </button>
                            </div>
                            <div x-cloak x-show="open" @click.away="open = false" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Your Profile</a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Settings</a>
                                <form method="POST" action="{{ route('student.logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Sign out</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="-mr-2 flex items-center md:hidden" x-data="sidebarState">
                        <button @click="toggle" type="button" class="inline-flex items-center justify-center p-2 rounded-md text-white hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
                            <span class="sr-only">Open main menu</span>
                            <i class="fas fa-bars"></i>
                        </button>
                        <div x-cloak x-show="open" @click.away="open = false" class="absolute top-16 right-0 w-full bg-primary z-10" id="mobile-menu">
                            <div class="px-2 pt-2 pb-3 space-y-1">
                                <a href="{{ route('student.dashboard') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('student.dashboard') ? 'bg-primary-dark text-white' : 'text-white hover:bg-primary-dark' }}">Dashboard</a>
                                <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-primary-dark">Courses</a>
                                <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-primary-dark">Schedule</a>
                                <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-primary-dark">Grades</a>
                                <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-primary-dark">Profile</a>
                                <form method="POST" action="{{ route('student.logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-3 py-2 rounded-md text-base font-medium text-white hover:bg-primary-dark">Sign out</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    
    <main>
        @yield('content')
    </main>
    
    <footer class="bg-[#131417] text-white mt-12 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="md:flex md:justify-between">
                <div class="mb-6 md:mb-0">
                    <a href="{{ url('/') }}" class="flex items-center">
                        <img src="{{ asset('images/logo.png') }}" class="h-8 mr-3" alt="LicomSIA Logo" />
                        <span class="self-center text-2xl font-semibold whitespace-nowrap">LicomSIA</span>
                    </a>
                    <p class="mt-3 text-sm text-gray-300">
                        Student Information System with Admission<br>
                        Libon Community College
                    </p>
                </div>
                <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-3">
                    <div>
                        <h2 class="mb-4 text-sm font-semibold uppercase">Resources</h2>
                        <ul class="text-gray-300 text-sm">
                            <li class="mb-2">
                                <a href="#" class="hover:underline">Student Handbook</a>
                            </li>
                            <li class="mb-2">
                                <a href="#" class="hover:underline">Academic Calendar</a>
                            </li>
                            <li>
                                <a href="#" class="hover:underline">Library</a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h2 class="mb-4 text-sm font-semibold uppercase">Support</h2>
                        <ul class="text-gray-300 text-sm">
                            <li class="mb-2">
                                <a href="#" class="hover:underline">Help Center</a>
                            </li>
                            <li class="mb-2">
                                <a href="#" class="hover:underline">Contact Us</a>
                            </li>
                            <li>
                                <a href="#" class="hover:underline">FAQs</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <hr class="my-6 border-gray-700" />
            <div class="sm:flex sm:items-center sm:justify-between">
                <span class="text-sm text-gray-300">© {{ date('Y') }} LicomSIA. All Rights Reserved.</span>
                <div class="flex mt-4 space-x-6 sm:justify-center sm:mt-0">
                    <a href="#" class="text-gray-400 hover:text-white">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('sidebarState', () => ({
                open: false,
                toggle() {
                    this.open = !this.open;
                }
            }));
            
            Alpine.data('userDropdown', () => ({
                open: false,
                toggle() {
                    this.open = !this.open;
                }
            }));
        });
    </script>
    
    @yield('scripts')
</body>
</html> 