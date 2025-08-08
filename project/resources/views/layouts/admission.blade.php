<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'LicomSIA')</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <div class="min-h-screen bg-cover bg-center" style="background-image: url('{{ asset('images/background.png') }}');">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
            @yield('content')
        </div>
    </div>
    @stack('scripts')
</body>
</html> 