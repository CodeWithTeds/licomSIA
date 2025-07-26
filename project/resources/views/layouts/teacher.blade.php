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
        .sidebar-scroll::-webkit-scrollbar { width: 4px; }
        .sidebar-scroll::-webkit-scrollbar-track { background: #1a1c23; }
        .sidebar-scroll::-webkit-scrollbar-thumb { background: #4a5568; border-radius: 2px; }
        .sidebar-scroll::-webkit-scrollbar-thumb:hover { background: #718096; }
        .nav-item.active::before {
            content: ''; position: absolute; left: 0; top: 0; height: 100%;
            width: 4px; background-color: #cccb62; border-radius: 0 2px 2px 0;
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
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-white">{{ Auth::guard('instructor')->user()->first_name }}</p>
                        <p class="text-xs text-gray-400">Instructor</p>
                    </div>
                </div>
                
                <div class="py-4">
                    <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Dashboard</p>
                    <nav>
                        <a href="{{ route('teacher.dashboard') }}" class="nav-item flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white transition-colors {{ request()->routeIs('teacher.dashboard') ? 'active bg-gray-800 text-white' : '' }}">
                            <i class="fas fa-tachometer-alt w-5 h-5 mr-3"></i> 
                            <span class="text-sm font-medium">Overview</span>
                        </a>
                    </nav>
                </div>
                
                <div class="py-4">
                    <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Management</p>
                    <nav>
                        <a href="{{ route('teacher.my_courses') }}" class="nav-item flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white transition-colors">
                            <i class="fas fa-book-open w-5 h-5 mr-3"></i><span class="text-sm font-medium">My Courses</span>
                        </a>
                        <a href="{{ route('teacher.my_students') }}" class="nav-item flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white transition-colors">
                            <i class="fas fa-users w-5 h-5 mr-3"></i><span class="text-sm font-medium">My Students</span>
                        </a>
                        <a href="{{ route('teacher.grades.index') }}" class="nav-item flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white transition-colors">
                            <i class="fas fa-graduation-cap w-5 h-5 mr-3"></i><span class="text-sm font-medium">Grades</span>
                        </a>
                         <a href="" class="nav-item flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white transition-colors">
                            <i class="fas fa-calendar-alt w-5 h-5 mr-3"></i><span class="text-sm font-medium">My Schedule</span>
                        </a>
                    </nav>
                </div>
                
                <div class="py-4">
                    <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Settings</p>
                    <nav>
                        <form method="POST" action="{{ route('teacher.logout') }}" class="w-full">
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

        <!-- Main content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="bg-white shadow-sm flex justify-between items-center py-4 px-6 hidden md:flex">
                <div class="flex items-center">
                    <h2 class="text-xl font-semibold text-primary">@yield('header', 'Dashboard')</h2>
                </div>
                <div class="flex items-center">
                     <div class="relative">
                        <button id="userMenu" class="flex items-center focus:outline-none">
                            <span class="mr-2 text-sm">{{ Auth::guard('instructor')->user()->first_name }}</span>
                            <div class="h-8 w-8 rounded-full bg-primary text-white flex items-center justify-center">
                                <i class="fas fa-user-circle"></i>
                            </div>
                        </button>
                        <div id="userMenuDropdown" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10 hidden">
                            <form method="POST" action="{{ route('teacher.logout') }}">
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
        document.getElementById('userMenu')?.addEventListener('click', function() {
            document.getElementById('userMenuDropdown').classList.toggle('hidden');
        });
    </script>
</body>
</html> 