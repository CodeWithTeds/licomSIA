<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScheduleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Assuming authorization is handled via middleware
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'course_id' => 'required|exists:courses,course_id',
            'day' => 'required|string|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'time_start' => 'required|date_format:H:i',
            'time_end' => 'required|date_format:H:i|after:time_start',
            'room' => 'required|string|max:50',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'course_id.required' => 'The course field is required.',
            'course_id.exists' => 'The selected course is invalid.',
            'day.required' => 'The day field is required.',
            'day.in' => 'The selected day is invalid.',
            'time_start.required' => 'The start time field is required.',
            'time_start.date_format' => 'The start time must be in the format HH:MM.',
            'time_end.required' => 'The end time field is required.',
            'time_end.date_format' => 'The end time must be in the format HH:MM.',
            'time_end.after' => 'The end time must be after the start time.',
            'room.required' => 'The room field is required.',
            'room.max' => 'The room name must not exceed 50 characters.',
        ];
    }
} 