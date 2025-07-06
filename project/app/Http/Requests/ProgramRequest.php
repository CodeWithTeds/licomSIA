<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProgramRequest extends FormRequest
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
        $rules = [
            'program_name' => ['required', 'string', 'max:100'],
            'department_id' => ['required', 'exists:departments,id'],
        ];

        // Add unique rule with exception for the current program when updating
        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules['program_name'][] = Rule::unique('programs', 'program_name')->ignore($this->program, 'program_id');
        } else {
            $rules['program_name'][] = 'unique:programs,program_name';
        }

        return $rules;
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'program_name' => 'program name',
            'department_id' => 'department',
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
            'program_name.unique' => 'A program with this name already exists.',
            'department_id.exists' => 'The selected department does not exist.',
        ];
    }
} 