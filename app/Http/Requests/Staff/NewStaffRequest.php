<?php

namespace App\Http\Requests\Staff;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class NewStaffRequest extends FormRequest
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
            'role' => 'required',
            'date_of_birth' => 'required',
            'place_of_birth' => 'required',
            'gender' => 'required',
            'highest_qualification' => 'required',
            'position' => 'nullable',
            'marital_status' => 'nullable',
            'nationality' => 'nullable',
            'denomination' => 'nullable',
            'date_of_employment' => 'nullable',
            'address' => 'nullable',
            'phone_number' => 'nullable',
            'insurance_number' => 'nullable',
            'password' => 'nullable|confirmed|min:6',
            'password_confirmed' => 'nullable|min:6',
        ];
    }

    protected function getValidatorInstance(): Validator
    {
        $validator = parent::getValidatorInstance();
        $validator->sometimes('password', 'sometimes|confirmed|min:6', function ($input) {
            return $input->password == true;
        });
        $validator->sometimes('password_confirmation', 'sometimes|min:6', function ($input) {
            return $input->password_confirmation == true;
        });

        return $validator;
    }

    public function messages(): array
    {
        return [
            'full_name.required' => 'The name of the staff is required',
            'role.required' => 'The role of the staff is required',
            'date_of_birth.required' => 'The date of birth of staff is required',
            'place_of_birth.required' => 'The place of birth of staff is required',
            'gender.required' => 'The the gender of the staff is required',
            'photo.max:2048' => "The Student's photo should not be more than 2M",
        ];
    }
}
