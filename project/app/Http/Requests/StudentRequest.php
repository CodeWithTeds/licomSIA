<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
        $studentId = $this->route('student') ? $this->route('student')->student_id : null;
        
        $rules = [
            'admission_id' => 'nullable|integer|unique:students,admission_id' . ($studentId ? ',' . $studentId . ',student_id' : ''),
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'birthdate' => 'required|date',
            'address' => 'required|string',
            'contact_number' => 'required|string|max:20',
            'email' => 'required|email|unique:students,email' . ($studentId ? ',' . $studentId . ',student_id' : ''),
            'program_id' => 'required|exists:programs,program_id',
            'year_level' => 'required|integer|min:1|max:5',
            'status' => 'required|in:Pending,Enrolled,Dropped,Graduated',
        ];
        
        // Only require password when creating a new student
        if (!$studentId) {
            $rules['password'] = 'required|min:8';
        }
        
        return $rules;
    }
} 