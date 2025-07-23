<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdmissionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'last_name' => 'required|string|max:100',
            'first_name' => 'required|string|max:100',
            'middle_name' => 'nullable|string|max:100',
            'suffix_name' => 'nullable|string|max:10',
            'age' => 'required|integer',
            'gender' => 'required|string|max:50',
            'date_of_birth' => 'required|date',
            'civil_status' => 'required|string|max:50',
            'citizenship' => 'required|string|max:255',
            'mobile_number' => 'required|string|max:20',
            'email' => 'required|string|email|max:100|unique:admissions,email',
            'father_last_name' => 'required|string|max:100',
            'father_first_name' => 'required|string|max:100',
            'father_middle_name' => 'nullable|string|max:100',
            'father_occupation' => 'required|string|max:100',
            'mother_last_name' => 'required|string|max:100',
            'mother_first_name' => 'required|string|max:100',
            'mother_middle_name' => 'nullable|string|max:100',
            'mother_occupation' => 'required|string|max:100',
            'home_address' => 'required|string',
            'barangay' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'province' => 'required|string|max:100',
            'zipcode' => 'required|string|max:10',
            'year_graduated' => 'nullable|string|max:4',
            'religion' => 'required|string|max:50',
            'expected_date_of_grad' => 'nullable|string|max:100',
            'course_preferences' => 'required|string|max:100',
            'scholarship' => 'nullable|string|max:20',
            'disability' => 'nullable|string',
            'admission_type' => 'required|string|max:50',
            'last_school_attended' => 'required|string|max:150',
            'program_id' => 'required|exists:programs,program_id',
            'school_year_applied' => 'required|string|max:20',
            'upload_requirements' => 'nullable|string',
        ];
    }
}
