<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
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
            'course_name' => 'required|string|max:100',
            'units' => 'required|integer|min:1',

            'program_id' => 'required|exists:programs,program_id',
            'year_level' => 'required|integer|min:1|max:4',
            'instructor_ids' => 'nullable|array',
            'instructor_ids.*' => 'exists:instructors,instructor_id',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'course_name' => 'course name',

            'program_id' => 'program',
            'instructor_ids' => 'instructors',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'program_id.exists' => 'The selected program does not exist.',
            'instructor_id.exists' => 'The selected instructor does not exist.',
            'prerequisite_id.exists' => 'The selected prerequisite course does not exist.',
        ];
    }
} 