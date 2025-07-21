@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold">Admission Form</h1>
    <div class="w-full bg-gray-200 rounded-full h-2.5 mb-4">
        <div class="bg-blue-600 h-2.5 rounded-full" style="width: 45%"></div>
    </div>
    <form action="{{ route('admission.store') }}" method="POST">
        @csrf
        <div>
            <label for="last_name">Last Name</label>
            <input type="text" name="last_name" id="last_name" class="w-full border rounded">
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Submit</button>
    </form>
</div>
@endsection
