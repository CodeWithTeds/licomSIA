@extends('layouts.app')

@section('header')
    @include('components.navbar')
@endsection

@section('content')
    @include('components.hero')
    @include('components.about')
    @include('components.features')
    @include('components.programs')
    @include('components.testimonials')
    @include('components.contact')
@endsection

@section('footer')
    @include('components.footer')
@endsection 