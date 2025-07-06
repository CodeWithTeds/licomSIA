<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="LicomSIA - Student Information System with Admission for Libon Community College">
    
    <title>{{ config('app.name', 'LicomSIA') }} - Student Information System</title>
    
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
        @yield('header')
    </header>
    
    <main>
        @yield('content')
    </main>
    
    <footer class="bg-[#131417] text-white">
        @yield('footer')
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