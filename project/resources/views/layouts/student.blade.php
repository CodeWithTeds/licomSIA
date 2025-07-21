<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Student Dashboard') - LicomSIA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
    @stack('styles')
    <style>
        body::before {
            content: "";
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-image: url("{{ asset('images/back.png') }}");
            background-repeat: repeat;
            opacity: 0.1;
            z-index: -1;
        }
    </style>
</head>

<body class="font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <header class="flex justify-between items-center mb-12">
            <div class="flex items-center space-x-4">
                <img class="h-10 w-auto" src="{{ asset('images/logo.png') }}" alt="LicomSIA Logo">
                <span class="text-2xl font-bold text-gray-800">LicomSIA</span>
            </div>
            <nav class="hidden md:flex items-center space-x-8">
                <a href="{{ route('student.dashboard') }}" class="text-gray-600 hover:text-primary font-medium">Home</a>
                <a href="{{ route('student.dashboard') }}" class="text-primary font-bold">Dashboard</a>
                <a href="{{ route('admission.create') }}" class="text-gray-600 hover:text-primary font-medium">Admission</a>
            </nav>
            <div class="flex items-center space-x-4">
                <i class="fas fa-search text-gray-500"></i>
                <i class="fas fa-bell text-gray-500"></i>
                <img class="h-8 w-8 rounded-full" src="https://i.pravatar.cc/150?u={{ Auth::user()->id }}" alt="User profile">
            </div>
        </header>

        <main>
            @yield('content')
        </main>
    </div>

    @stack('scripts')
</body>

</html> 