<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'LicomSIA') }} - Teacher Portal</title>

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
                <h2 class="text-2xl font-bold text-secondary">Teacher Portal</h2>
            </div>
            <div class="flex flex-col flex-grow overflow-y-auto sidebar-scroll">
                <div class="flex items-center px-4 py-6 border-b border-gray-800">
                    <div class="flex items-center justify-center h-10 w-10 rounded-full bg-primary text-white">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-white">{{ Auth::user()->name ?? 'Teacher' }}</p>
                        <p class="text-xs text-gray-400">Instructor</p>
                    </div>
                </div>
                
                <div class="py-4">
                    <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Dashboard</p>
                    <nav>
                        <a href="#" class="nav-item flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white transition-colors">
                            <i class="fas fa-tachometer-alt w-5 h-5 mr-3"></i> 
                            <span class="text-sm font-medium">Overview</span>
                        </a>
                    </nav>
                </div>
                
                <div class="py-4">
                    <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Teaching</p>
                    <nav>
                        <a href="#" class="nav-item flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white transition-colors">
                            <i class="fas fa-book-open w-5 h-5 mr-3"></i>
                            <span class="text-sm font-medium">My Courses</span>
                        </a>
                        <a href="#" class="nav-item flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white transition-colors">
                            <i class="fas fa-users w-5 h-5 mr-3"></i>
                            <span class="text-sm font-medium">My Students</span>
                        </a>
                    </nav>
                </div>
                
                <div class="py-4">
                    <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Grades</p>
                    <nav>
                        <a href="#" class="nav-item flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white transition-colors">
                            <i class="fas fa-clipboard-list w-5 h-5 mr-3"></i>
                            <span class="text-sm font-medium">Enter Grades</span>
                        </a>
                        <a href="#" class="nav-item flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white transition-colors">
                            <i class="fas fa-chart-line w-5 h-5 mr-3"></i>
                            <span class="text-sm font-medium">Grade Reports</span>
                        </a>
                    </nav>
                </div>
                
                <div class="py-4">
                    <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Schedule</p>
                    <nav>
                        <a href="#" class="nav-item flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white transition-colors">
                            <i class="fas fa-calendar-alt w-5 h-5 mr-3"></i>
                            <span class="text-sm font-medium">My Schedule</span>
                        </a>
                        <a href="#" class="nav-item flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white transition-colors">
                            <i class="fas fa-clock w-5 h-5 mr-3"></i>
                            <span class="text-sm font-medium">Office Hours</span>
                        </a>
                    </nav>
                </div>
                
                <div class="py-4">
                    <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Profile</p>
                    <nav>
                        <a href="#" class="nav-item flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white transition-colors">
                            <i class="fas fa-user-edit w-5 h-5 mr-3"></i>
                            <span class="text-sm font-medium">Edit Profile</span>
                        </a>
                        <a href="#" class="nav-item flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white transition-colors">
                            <i class="fas fa-cog w-5 h-5 mr-3"></i>
                            <span class="text-sm font-medium">Settings</span>
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
                <h2 class="text-xl font-bold text-secondary">Teacher Portal</h2>
            </div>
        </div>

        <!-- Mobile sidebar -->
        <div id="mobileSidebar" class="fixed inset-0 z-40 transform -translate-x-full transition-transform duration-300 ease-in-out md:hidden">
            <div class="bg-gradient-to-b from-dark to-gray-900 text-white w-64 h-full flex flex-col">
                <div class="flex items-center justify-between h-16 border-b border-gray-800 px-4 bg-dark">
                    <div class="flex items-center">
                        <img src="{{ asset('images/logoo.png') }}" alt="LicomSIA Logo" class="h-8 w-8 mr-2">
                        <h2 class="text-xl font-bold text-secondary">Teacher Portal</h2>
                    </div>
                    <button id="closeSidebar" class="text-white focus:outline-none">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
                <div class="flex-grow overflow-y-auto sidebar-scroll">
                    <div class="flex items-center px-4 py-6 border-b border-gray-800">
                        <div class="flex items-center justify-center h-10 w-10 rounded-full bg-primary text-white">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-white">{{ Auth::user()->name ?? 'Teacher' }}</p>
                            <p class="text-xs text-gray-400">Instructor</p>
                        </div>
                    </div>
                    
                    <div class="py-4">
                        <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Dashboard</p>
                        <nav>
                            <a href="#" class="nav-item flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white transition-colors">
                                <i class="fas fa-tachometer-alt w-5 h-5 mr-3"></i> 
                                <span class="text-sm font-medium">Overview</span>
                            </a>
                        </nav>
                    </div>
                    
                    <div class="py-4">
                        <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Teaching</p>
                        <nav>
                            <a href="#" class="nav-item flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white transition-colors">
                                <i class="fas fa-book-open w-5 h-5 mr-3"></i>
                                <span class="text-sm font-medium">My Courses</span>
                            </a>
                            <a href="#" class="nav-item flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white transition-colors">
                                <i class="fas fa-users w-5 h-5 mr-3"></i>
                                <span class="text-sm font-medium">My Students</span>
                            </a>
                        </nav>
                    </div>
                    
                    <div class="py-4">
                        <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Grades</p>
                        <nav>
                            <a href="#" class="nav-item flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white transition-colors">
                                <i class="fas fa-clipboard-list w-5 h-5 mr-3"></i>
                                <span class="text-sm font-medium">Enter Grades</span>
                            </a>
                            <a href="#" class="nav-item flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white transition-colors">
                                <i class="fas fa-chart-line w-5 h-5 mr-3"></i>
                                <span class="text-sm font-medium">Grade Reports</span>
                            </a>
                        </nav>
                    </div>
                    
                    <div class="py-4">
                        <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Schedule</p>
                        <nav>
                            <a href="#" class="nav-item flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white transition-colors">
                                <i class="fas fa-calendar-alt w-5 h-5 mr-3"></i>
                                <span class="text-sm font-medium">My Schedule</span>
                            </a>
                            <a href="#" class="nav-item flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white transition-colors">
                                <i class="fas fa-clock w-5 h-5 mr-3"></i>
                                <span class="text-sm font-medium">Office Hours</span>
                            </a>
                        </nav>
                    </div>
                    
                    <div class="py-4">
                        <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Profile</p>
                        <nav>
                            <a href="#" class="nav-item flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white transition-colors">
                                <i class="fas fa-user-edit w-5 h-5 mr-3"></i>
                                <span class="text-sm font-medium">Edit Profile</span>
                            </a>
                            <a href="#" class="nav-item flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white transition-colors">
                                <i class="fas fa-cog w-5 h-5 mr-3"></i>
                                <span class="text-sm font-medium">Settings</span>
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
        </div>

        <!-- Main Content -->
        <div class="flex flex-col flex-1 w-full overflow-hidden">
            <!-- Header -->
            <header class="bg-white shadow-sm flex justify-between items-center py-4 px-6 md:py-3">
                <div class="md:hidden">
                    <!-- Mobile logo goes here if needed -->
                </div>
                
                <div class="hidden md:block">
                    <h2 class="text-xl font-bold text-gray-800">@yield('header', 'Teacher Dashboard')</h2>
                </div>
                
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <button class="text-gray-500 hover:text-gray-700 focus:outline-none">
                            <i class="fas fa-bell"></i>
                            <span class="absolute top-0 right-0 h-2 w-2 bg-red-500 rounded-full"></span>
                        </button>
                    </div>
                    
                    <div class="relative">
                        <button class="flex items-center text-gray-500 hover:text-gray-700 focus:outline-none">
                            <span class="mr-2 text-sm hidden sm:inline-block">{{ Auth::user()->name ?? 'Teacher' }}</span>
                            <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center text-gray-600">
                                <i class="fas fa-user-circle"></i>
                            </div>
                        </button>
                    </div>
                </div>
            </header>
            
            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-4 md:p-6 bg-gray-100">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        // Mobile sidebar toggle
        document.getElementById('sidebarToggle')?.addEventListener('click', function() {
            document.getElementById('mobileSidebar').classList.remove('-translate-x-full');
        });
        
        document.getElementById('closeSidebar')?.addEventListener('click', function() {
            document.getElementById('mobileSidebar').classList.add('-translate-x-full');
        });
    </script>
</body>
</html> 