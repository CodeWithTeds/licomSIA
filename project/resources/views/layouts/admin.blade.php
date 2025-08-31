<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'LicomSIA') }} - Admin</title>

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
                        light: '#e2e4e3',
                    },
                    fontFamily: {
                        'sans': ['Inter', 'system-ui', 'sans-serif'],
                        'serif': ['Georgia', 'serif'],
                    }
                }
            }
        }
    </script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Inter Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
    
    <style>
        /* Custom scrollbar for sidebar */
        .sidebar-scroll::-webkit-scrollbar {
            width: 4px;
        }
        
        .sidebar-scroll::-webkit-scrollbar-track {
            background: #1a1c23;
        }
        
        .sidebar-scroll::-webkit-scrollbar-thumb {
            background: #4a5568;
            border-radius: 2px;
        }
        
        .sidebar-scroll::-webkit-scrollbar-thumb:hover {
            background: #718096;
        }
        
        /* Active nav item styling */
        .nav-item.active {
            position: relative;
        }
        
        .nav-item.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background-color: #cccb62;
            border-radius: 0 2px 2px 0;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen font-sans">
    <div class="flex h-screen bg-gray-100">
        <!-- Sidebar -->
        <div class="bg-gradient-to-b from-dark to-gray-900 text-white w-64 flex-shrink-0 hidden md:flex md:flex-col shadow-xl">
            <div class="flex items-center justify-center h-16 border-b border-gray-800 bg-dark">
                <img src="{{ asset('images/logoo.png') }}" alt="LicomSIA Logo" class="h-10 w-10 mr-2">
                <h2 class="text-2xl font-bold text-secondary">LicomSIA</h2>
            </div>
            <div class="flex flex-col flex-grow overflow-y-auto sidebar-scroll">
                <div class="flex items-center px-4 py-6 border-b border-gray-800">
                    <div class="flex items-center justify-center h-10 w-10 rounded-full bg-primary text-white">
                        <i class="fas fa-user-shield"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-white">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-400">Administrator</p>
                    </div>
                </div>
                
                <div class="py-4">
                    <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Dashboard</p>
                    <nav>
                        <a href="{{ route('admin.dashboard') }}" class="nav-item flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white transition-colors {{ request()->routeIs('admin.dashboard') ? 'active bg-gray-800 text-white' : '' }}">
                            <i class="fas fa-tachometer-alt w-5 h-5 mr-3"></i> 
                            <span class="text-sm font-medium">Overview</span>
                        </a>
                    </nav>
                </div>
                
                <div class="py-4">
                    <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Academic</p>
                    <nav>
                        <a href="{{ route('admin.admissions.index') }}" class="nav-item flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white transition-colors {{ request()->routeIs('admin.admissions.*') ? 'active bg-gray-800 text-white' : '' }}">
                            <i class="fas fa-file-alt w-5 mr-3 text-center"></i>
                            <span>Admissions</span>
                        </a>
                        <a href="{{ route('admin.students.index') }}" class="nav-item flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white transition-colors {{ request()->routeIs('admin.students.*') ? 'active bg-gray-800 text-white' : '' }}">
                            <i class="fas fa-user-graduate w-5 mr-3 text-center"></i>
                            <span>Students</span>
                        </a>

                        <a href="{{ route('admin.enrollments.index') }}" class="nav-item flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white transition-colors {{ request()->routeIs('admin.enrollments.*') ? 'active bg-gray-800 text-white' : '' }}">
                            <i class="fas fa-clipboard-check w-5 mr-3 text-center"></i>
                            <span>Enrollments</span>
                        </a>
                        
                        <a href="{{ route('admin.programs.index') }}" class="nav-item flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white transition-colors {{ request()->routeIs('admin.programs.*') ? 'active bg-gray-800 text-white' : '' }}">
                            <i class="fas fa-graduation-cap w-5 h-5 mr-3"></i>
                            <span class="text-sm font-medium">Programs</span>
                        </a>
                        <!-- Courses -->
                        <a href="{{ route('admin.courses.index') }}" class="nav-item flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white transition-colors {{ request()->routeIs('admin.courses.*') ? 'active bg-gray-800 text-white' : '' }}">
                            <i class="fas fa-book w-5 mr-3 text-center"></i>
                            <span>Courses</span>
                        </a>
                    </nav>
                </div>
            
                
                <div class="py-4">
                    <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Faculty Management</p>
                    <nav>
                        <a href="{{ route('admin.instructors.index') }}" class="nav-item flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white transition-colors {{ request()->routeIs('admin.instructors.*') ? 'active bg-gray-800 text-white' : '' }}">
                            <i class="fas fa-chalkboard-teacher w-5 h-5 mr-3"></i>
                            <span class="text-sm font-medium">Instructors</span>
                        </a>
                        <a href="{{ route('admin.departments.index') }}" class="nav-item flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white transition-colors {{ request()->routeIs('admin.departments.*') ? 'active bg-gray-800 text-white' : '' }}">
                            <i class="fas fa-building w-5 h-5 mr-3"></i>
                            <span class="text-sm font-medium">Departments</span>
                        </a>
                        <a href="{{ route('admin.positions.index') }}" class="nav-item flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white transition-colors {{ request()->routeIs('admin.positions.*') ? 'active bg-gray-800 text-white' : '' }}">
                            <i class="fas fa-id-badge w-5 h-5 mr-3"></i>
                            <span class="text-sm font-medium">Positions</span>
                        </a>
                    </nav>
                </div>
                
                <div class="py-4">
                    <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Management</p>
                    <nav>
                        <a href="{{ route('admin.schedules.index') }}" class="nav-item flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white transition-colors {{ request()->routeIs('admin.schedules.*') ? 'active bg-gray-800 text-white' : '' }}">
                            <i class="fas fa-calendar-alt w-5 h-5 mr-3"></i>
                            <span class="text-sm font-medium">Schedules</span>
                        </a>
                        <a href="{{ route('admin.grades.index') }}" class="nav-item flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white transition-colors {{ request()->routeIs('admin.grades.*') ? 'active bg-gray-800 text-white' : '' }}">
                            <i class="fas fa-graduation-cap w-5 h-5 mr-3"></i>
                            <span class="text-sm font-medium">Grades</span>
                        </a>
                        <a href="{{ route('admin.reports.deans_list') }}" class="nav-item flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white transition-colors {{ request()->routeIs('admin.reports.deans_list') ? 'active bg-gray-800 text-white' : '' }}">
                            <i class="fas fa-award w-5 h-5 mr-3"></i>
                            <span class="text-sm font-medium">Dean's List</span>
                        </a>
                      
                    </nav>
                </div>
                
                <div class="py-4">
                    <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Settings</p>
                    <nav>
                        <a href="#" class="nav-item flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white transition-colors">
                            <i class="fas fa-cog w-5 h-5 mr-3"></i>
                            <span class="text-sm font-medium">System</span>
                        </a>
                        <form method="POST" action="{{ route('admin.logout') }}" class="w-full">
                            @csrf
                            <button type="submit" class="w-full flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white transition-colors text-left">
                                <i class="fas fa-sign-out-alt w-5 h-5 mr-3"></i>
                                <span class="text-sm font-medium">Logout</span>
                            </button>
                        </form>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Mobile sidebar toggle -->
        <div class="md:hidden fixed top-0 left-0 z-50 w-full bg-dark h-16 flex items-center px-4">
            <button id="sidebarToggle" class="text-white focus:outline-none">
                <i class="fas fa-bars"></i>
            </button>
            <div class="flex items-center ml-4">
                <img src="{{ asset('images/logoo.png') }}" alt="LicomSIA Logo" class="h-8 w-8 mr-2">
                <h2 class="text-xl font-bold text-secondary">LicomSIA</h2>
            </div>
        </div>

        <!-- Mobile sidebar -->
        <div id="mobileSidebar" class="fixed inset-0 z-40 transform -translate-x-full transition-transform duration-300 ease-in-out md:hidden">
            <div class="bg-gradient-to-b from-dark to-gray-900 text-white w-64 h-full flex flex-col">
                <div class="flex items-center justify-between h-16 border-b border-gray-800 px-4 bg-dark">
                    <div class="flex items-center">
                        <img src="{{ asset('images/logoo.png') }}" alt="LicomSIA Logo" class="h-8 w-8 mr-2">
                        <h2 class="text-xl font-bold text-secondary">LicomSIA</h2>
                    </div>
                    <button id="closeSidebar" class="text-white focus:outline-none">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
                <div class="flex-grow overflow-y-auto sidebar-scroll">
                    <div class="flex items-center px-4 py-6 border-b border-gray-800">
                        <div class="flex items-center justify-center h-10 w-10 rounded-full bg-primary text-white">
                            <i class="fas fa-user-shield"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-white">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-400">Administrator</p>
                        </div>
                    </div>
                    
                    <div class="py-4">
                        <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Dashboard</p>
                        <nav>
                            <a href="{{ route('admin.dashboard') }}" class="nav-item flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white transition-colors {{ request()->routeIs('admin.dashboard') ? 'active bg-gray-800 text-white' : '' }}">
                                <i class="fas fa-tachometer-alt w-5 h-5 mr-3"></i> 
                                <span class="text-sm font-medium">Overview</span>
                            </a>
                        </nav>
                    </div>
                    
                    <div class="py-4">
                        <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Academic</p>
                        <nav>
                            <a href="{{ route('admin.admissions.index') }}" class="nav-item flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white transition-colors {{ request()->routeIs('admin.admissions.*') ? 'active bg-gray-800 text-white' : '' }}">
                                <i class="fas fa-file-alt w-5 mr-3 text-center"></i>
                                <span>Admissions</span>
                            </a>
                            <a href="{{ route('admin.students.index') }}" class="nav-item flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white transition-colors {{ request()->routeIs('admin.students.*') ? 'active bg-gray-800 text-white' : '' }}">
                                <i class="fas fa-user-graduate w-5 mr-3 text-center"></i>
                                <span>Students</span>
                            </a>
                            <a href="#" class="nav-item flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white transition-colors">
                                <i class="fas fa-chalkboard-teacher w-5 h-5 mr-3"></i>
                                <span class="text-sm font-medium">Faculty</span>
                            </a>
                            <a href="{{ route('admin.programs.index') }}" class="nav-item flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white transition-colors {{ request()->routeIs('admin.programs.*') ? 'active bg-gray-800 text-white' : '' }}">
                                <i class="fas fa-graduation-cap w-5 h-5 mr-3"></i>
                                <span class="text-sm font-medium">Programs</span>
                            </a>
                            <a href="{{ route('admin.courses.index') }}" class="nav-item flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white transition-colors {{ request()->routeIs('admin.courses.*') ? 'active bg-gray-800 text-white' : '' }}">
                                <i class="fas fa-book w-5 mr-3 text-center"></i>
                                <span>Courses</span>
                            </a>
                        </nav>
                    </div>
                    
                    <div class="py-4">
                        <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Students</p>
                        <nav>
                            <a href="{{ route('admin.students.index') }}" class="nav-item flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white transition-colors {{ request()->routeIs('admin.students.index') ? 'active bg-gray-800 text-white' : '' }}">
                                <i class="fas fa-list w-5 h-5 mr-3"></i>
                                <span class="text-sm font-medium">All Students</span>
                            </a>
                            <a href="{{ route('admin.students.create') }}" class="nav-item flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white transition-colors {{ request()->routeIs('admin.students.create') ? 'active bg-gray-800 text-white' : '' }}">
                                <i class="fas fa-user-plus w-5 h-5 mr-3"></i>
                                <span class="text-sm font-medium">Add Student</span>
                            </a>
                        </nav>
                    </div>
                    
                    <div class="py-4">
                        <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Instructors</p>
                        <nav>
                            <a href="{{ route('admin.instructors.index') }}" class="nav-item flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white transition-colors {{ request()->routeIs('admin.instructors.index') ? 'active bg-gray-800 text-white' : '' }}">
                                <i class="fas fa-list w-5 h-5 mr-3"></i>
                                <span class="text-sm font-medium">All Instructors</span>
                            </a>
                            <a href="{{ route('admin.instructors.create') }}" class="nav-item flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white transition-colors {{ request()->routeIs('admin.instructors.create') ? 'active bg-gray-800 text-white' : '' }}">
                                <i class="fas fa-user-plus w-5 h-5 mr-3"></i>
                                <span class="text-sm font-medium">Add Instructor</span>
                            </a>
                        </nav>
                    </div>
                    
                    <div class="py-4">
                        <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Faculty Management</p>
                        <nav>
                            <a href="{{ route('admin.instructors.index') }}" class="nav-item flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white transition-colors {{ request()->routeIs('admin.instructors.*') ? 'active bg-gray-800 text-white' : '' }}">
                                <i class="fas fa-chalkboard-teacher w-5 h-5 mr-3"></i>
                                <span class="text-sm font-medium">Instructors</span>
                            </a>
                            <a href="{{ route('admin.departments.index') }}" class="nav-item flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white transition-colors {{ request()->routeIs('admin.departments.*') ? 'active bg-gray-800 text-white' : '' }}">
                                <i class="fas fa-building w-5 h-5 mr-3"></i>
                                <span class="text-sm font-medium">Departments</span>
                            </a>
                            <a href="{{ route('admin.positions.index') }}" class="nav-item flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white transition-colors {{ request()->routeIs('admin.positions.*') ? 'active bg-gray-800 text-white' : '' }}">
                                <i class="fas fa-id-badge w-5 h-5 mr-3"></i>
                                <span class="text-sm font-medium">Positions</span>
                            </a>
                        </nav>
                    </div>
                    
                    <div class="py-4">
                        <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Management</p>
                        <nav>
                            <a href="#" class="nav-item flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white transition-colors">
                                <i class="fas fa-calendar-alt w-5 h-5 mr-3"></i>
                                <span class="text-sm font-medium">Schedule</span>
                            </a>
                            <a href="#" class="nav-item flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white transition-colors">
                                <i class="fas fa-clipboard-list w-5 h-5 mr-3"></i>
                                <span class="text-sm font-medium">Grades</span>
                            </a>
                            <a href="{{ route('admin.reports.deans_list') }}" class="nav-item flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white transition-colors {{ request()->routeIs('admin.reports.deans_list') ? 'active bg-gray-800 text-white' : '' }}">
                                <i class="fas fa-award w-5 h-5 mr-3"></i>
                                <span class="text-sm font-medium">Dean's List</span>
                            </a>
                        </nav>
                    </div>
                    
                    <div class="py-4">
                        <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Settings</p>
                        <nav>
                            <a href="#" class="nav-item flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white transition-colors">
                                <i class="fas fa-cog w-5 h-5 mr-3"></i>
                                <span class="text-sm font-medium">System</span>
                            </a>
                            <form method="POST" action="{{ route('admin.logout') }}" class="w-full">
                                @csrf
                                <button type="submit" class="w-full flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white transition-colors text-left">
                                    <i class="fas fa-sign-out-alt w-5 h-5 mr-3"></i>
                                    <span class="text-sm font-medium">Logout</span>
                                </button>
                            </form>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="bg-black bg-opacity-50 absolute inset-0 -z-10" id="sidebarOverlay"></div>
        </div>

        <!-- Main content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="bg-white shadow-sm flex justify-between items-center py-4 px-6 hidden md:flex">
                <div class="flex items-center">
                    <h2 class="text-xl font-semibold text-primary">@yield('header', 'Dashboard')</h2>
                </div>
                <div class="flex items-center">
                    <div class="relative">
                        <button id="userMenu" class="flex items-center focus:outline-none">
                            <span class="mr-2 text-sm">{{ Auth::user()->name }}</span>
                            <div class="h-8 w-8 rounded-full bg-primary text-white flex items-center justify-center">
                                <i class="fas fa-user-circle"></i>
                            </div>
                        </button>
                        <div id="userMenuDropdown" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10 hidden">
                          
                            <form method="POST" action="{{ route('admin.logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Mobile header -->
            <header class="bg-white shadow-sm flex justify-end items-center py-4 px-6 mt-16 md:hidden">
                <div class="flex items-center">
                    <div class="relative">
                        <button id="mobileUserMenu" class="flex items-center focus:outline-none">
                            <span class="mr-2 text-sm">{{ Auth::user()->name }}</span>
                            <div class="h-8 w-8 rounded-full bg-primary text-white flex items-center justify-center">
                                <i class="fas fa-user-circle"></i>
                            </div>
                        </button>
                        <div id="mobileUserMenuDropdown" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10 hidden">
                           
                            <form method="POST" action="{{ route('admin.logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        // Toggle dropdowns
        document.getElementById('userMenu')?.addEventListener('click', function() {
            document.getElementById('userMenuDropdown').classList.toggle('hidden');
        });
        
        document.getElementById('mobileUserMenu')?.addEventListener('click', function() {
            document.getElementById('mobileUserMenuDropdown').classList.toggle('hidden');
        });
        
        // Mobile sidebar toggle
        document.getElementById('sidebarToggle')?.addEventListener('click', function() {
            document.getElementById('mobileSidebar').classList.toggle('-translate-x-full');
        });
        
        document.getElementById('closeSidebar')?.addEventListener('click', function() {
            document.getElementById('mobileSidebar').classList.add('-translate-x-full');
        });
        
        document.getElementById('sidebarOverlay')?.addEventListener('click', function() {
            document.getElementById('mobileSidebar').classList.add('-translate-x-full');
        });
        
        // Close dropdowns when clicking outside
        window.addEventListener('click', function(event) {
            if (!event.target.closest('#userMenu') && !event.target.closest('#userMenuDropdown')) {
                document.getElementById('userMenuDropdown')?.classList.add('hidden');
            }
            
            if (!event.target.closest('#mobileUserMenu') && !event.target.closest('#mobileUserMenuDropdown')) {
                document.getElementById('mobileUserMenuDropdown')?.classList.add('hidden');
            }
        });
    </script>
</body>
</html> 