<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="LicomSIA - Student Information System with Admission for Libon Community College">
    
    <title>{{ config('app.name', 'LicomSIA') }} - Login</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full">
    @include('components.login-form')
</body>
</html> 