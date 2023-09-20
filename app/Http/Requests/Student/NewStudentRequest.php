<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;

class NewStudentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'photo' => 'image|mimes:png,jpg,jpeg|max:2048',
            'full_name' => 'required',
            'date_of_birth' => 'required',
            'place_of_birth' => 'required',
            'date_of_admission' => 'nullable',
            'gender' => 'required',
            'section_id' => 'required',
            'class_id' => 'required',
            'email' => 'nullable|email',
            'address' => 'nullable|string',
            'nationality' => 'nullable|string',
            'phone_number' => 'nullable|numeric',
            'denomination' => 'nullable|string',
            'password' => 'nullable|confirmed|min:6',
            'password_confirmed' => 'nullable|min:6',
        ];
    }

    public function messages(): array
    {
        return [
            'full_name.required' => "The Student's name is required",
            'date_of_birth.required' => "The Student's date of birth is required",
            'place_of_birth.required' => "The Student's place of birth is required",
            'gender.required' => "The Student's gender of birth is required",
            'section_id.required' => "The Student's section is not selected",
            'level_id.required' => "The Student's level is not selected",
            'class_id.required' => "The Student's class is not selected",
            'photo.max:2048' => "The Student's photo should not be more than 2M",
        ];
    }
}
