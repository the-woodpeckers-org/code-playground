<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterFormRequest extends FormRequest
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
            'name' => 'required|min:2',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'birthday' => 'required',
            'gender' => 'required',
            'phone_number' => 'required',
            'address' => 'required',
            'confirm_password' => 'required|same:password',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Name is required',
            'name.min' => 'Name must be at least 1 character',
            'email.required' => 'Email is required',
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 6 characters',
            'birthday.required' => 'Birthday is required',
            'gender.required' => 'Gender is required',
            'phone_number.required' => 'Phone number is required',
            'address.required' => 'Address is required',
            'confirm_password.required' => 'Confirm Password is required',
            'confirm_password.same' => 'Confirm Password does not match',
        ];
    }
}
