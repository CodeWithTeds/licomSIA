@extends('layouts.admission')

@section('title', 'Admission Application')

@section('content')
<div class="max-w-4xl mx-auto bg-white rounded-xl shadow p-6">
    <h1 class="text-2xl font-bold mb-4">Admission Application</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-300 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-100 border border-red-300 text-red-800 p-3 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admission.store') }}" method="POST">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium">First Name</label>
                <input type="text" name="first_name" value="{{ old('first_name') }}" class="mt-1 w-full border rounded p-2" required>
            </div>
            <div>
                <label class="block text-sm font-medium">Middle Name</label>
                <input type="text" name="middle_name" value="{{ old('middle_name') }}" class="mt-1 w-full border rounded p-2">
            </div>
            <div>
                <label class="block text-sm font-medium">Last Name</label>
                <input type="text" name="last_name" value="{{ old('last_name') }}" class="mt-1 w-full border rounded p-2" required>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-4">
            <div>
                <label class="block text-sm font-medium">Suffix</label>
                <input type="text" name="suffix_name" value="{{ old('suffix_name') }}" class="mt-1 w-full border rounded p-2">
            </div>
            <div>
                <label class="block text-sm font-medium">Age</label>
                <input type="number" name="age" value="{{ old('age') }}" class="mt-1 w-full border rounded p-2" required>
            </div>
            <div>
                <label class="block text-sm font-medium">Gender</label>
                <select name="gender" class="mt-1 w-full border rounded p-2" required>
                    <option value="">Select</option>
                    <option value="Male" {{ old('gender')=='Male'?'selected':'' }}>Male</option>
                    <option value="Female" {{ old('gender')=='Female'?'selected':'' }}>Female</option>
                    <option value="Other" {{ old('gender')=='Other'?'selected':'' }}>Other</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium">Date of Birth</label>
                <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}" class="mt-1 w-full border rounded p-2" required>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
            <div>
                <label class="block text-sm font-medium">Civil Status</label>
                <input type="text" name="civil_status" value="{{ old('civil_status') }}" class="mt-1 w-full border rounded p-2" required>
            </div>
            <div>
                <label class="block text-sm font-medium">Citizenship</label>
                <input type="text" name="citizenship" value="{{ old('citizenship') }}" class="mt-1 w-full border rounded p-2" required>
            </div>
            <div>
                <label class="block text-sm font-medium">Religion</label>
                <input type="text" name="religion" value="{{ old('religion') }}" class="mt-1 w-full border rounded p-2" required>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
            <div>
                <label class="block text-sm font-medium">Mobile Number</label>
                <input type="text" name="mobile_number" value="{{ old('mobile_number') }}" class="mt-1 w-full border rounded p-2" required>
            </div>
            <div>
                <label class="block text-sm font-medium">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="mt-1 w-full border rounded p-2" required>
            </div>
        </div>

        <div class="mt-4">
            <label class="block text-sm font-medium">Home Address</label>
            <input type="text" name="home_address" value="{{ old('home_address') }}" class="mt-1 w-full border rounded p-2" required>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-4">
            <div>
                <label class="block text-sm font-medium">Barangay</label>
                <input type="text" name="barangay" value="{{ old('barangay') }}" class="mt-1 w-full border rounded p-2" required>
            </div>
            <div>
                <label class="block text-sm font-medium">City</label>
                <input type="text" name="city" value="{{ old('city') }}" class="mt-1 w-full border rounded p-2" required>
            </div>
            <div>
                <label class="block text-sm font-medium">Province</label>
                <input type="text" name="province" value="{{ old('province') }}" class="mt-1 w-full border rounded p-2" required>
            </div>
            <div>
                <label class="block text-sm font-medium">Zipcode</label>
                <input type="text" name="zipcode" value="{{ old('zipcode') }}" class="mt-1 w-full border rounded p-2" required>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
            <div>
                <label class="block text-sm font-medium">Father's First Name</label>
                <input type="text" name="father_first_name" value="{{ old('father_first_name') }}" class="mt-1 w-full border rounded p-2" required>
            </div>
            <div>
                <label class="block text-sm font-medium">Father's Middle Name</label>
                <input type="text" name="father_middle_name" value="{{ old('father_middle_name') }}" class="mt-1 w-full border rounded p-2">
            </div>
            <div>
                <label class="block text-sm font-medium">Father's Last Name</label>
                <input type="text" name="father_last_name" value="{{ old('father_last_name') }}" class="mt-1 w-full border rounded p-2" required>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
            <div>
                <label class="block text-sm font-medium">Father's Occupation</label>
                <input type="text" name="father_occupation" value="{{ old('father_occupation') }}" class="mt-1 w-full border rounded p-2" required>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
            <div>
                <label class="block text-sm font-medium">Mother's First Name</label>
                <input type="text" name="mother_first_name" value="{{ old('mother_first_name') }}" class="mt-1 w-full border rounded p-2" required>
            </div>
            <div>
                <label class="block text-sm font-medium">Mother's Middle Name</label>
                <input type="text" name="mother_middle_name" value="{{ old('mother_middle_name') }}" class="mt-1 w-full border rounded p-2">
            </div>
            <div>
                <label class="block text-sm font-medium">Mother's Last Name</label>
                <input type="text" name="mother_last_name" value="{{ old('mother_last_name') }}" class="mt-1 w-full border rounded p-2" required>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
            <div>
                <label class="block text-sm font-medium">Mother's Occupation</label>
                <input type="text" name="mother_occupation" value="{{ old('mother_occupation') }}" class="mt-1 w-full border rounded p-2" required>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
            <div>
                <label class="block text-sm font-medium">Last School Attended</label>
                <input type="text" name="last_school_attended" value="{{ old('last_school_attended') }}" class="mt-1 w-full border rounded p-2" required>
            </div>
            <div>
                <label class="block text-sm font-medium">Year Graduated</label>
                <input type="text" name="year_graduated" value="{{ old('year_graduated') }}" class="mt-1 w-full border rounded p-2">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
            <div>
                <label class="block text-sm font-medium">Program</label>
                <select name="program_id" class="mt-1 w-full border rounded p-2" required>
                    <option value="">Select a program</option>
                    @foreach($programs as $program)
                        <option value="{{ $program->program_id }}" {{ old('program_id')==$program->program_id?'selected':'' }}>
                            {{ $program->program_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium">Course Preferences</label>
                <input type="text" name="course_preferences" value="{{ old('course_preferences') }}" class="mt-1 w-full border rounded p-2" required>
            </div>
            <div>
                <label class="block text-sm font-medium">School Year Applied</label>
                <input type="text" name="school_year_applied" placeholder="e.g. 2024-2025" value="{{ old('school_year_applied') }}" class="mt-1 w-full border rounded p-2" required>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
            <div>
                <label class="block text-sm font-medium">Admission Type</label>
                <select name="admission_type" class="mt-1 w-full border rounded p-2" required>
                    <option value="">Select</option>
                    <option value="Freshman" {{ old('admission_type')=='Freshman'?'selected':'' }}>Freshman</option>
                    <option value="Transferee" {{ old('admission_type')=='Transferee'?'selected':'' }}>Transferee</option>
                    <option value="Returnee" {{ old('admission_type')=='Returnee'?'selected':'' }}>Returnee</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium">Scholarship (optional)</label>
                <input type="text" name="scholarship" value="{{ old('scholarship') }}" class="mt-1 w-full border rounded p-2">
            </div>
            <div>
                <label class="block text-sm font-medium">Disability (optional)</label>
                <input type="text" name="disability" value="{{ old('disability') }}" class="mt-1 w-full border rounded p-2">
            </div>
        </div>

        <div class="mt-6 flex justify-end">
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Submit Application</button>
        </div>
    </form>
</div>
@endsection


