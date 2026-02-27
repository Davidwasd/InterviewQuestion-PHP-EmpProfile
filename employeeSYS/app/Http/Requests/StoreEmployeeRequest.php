<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
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
            'name'            => 'required|string|max:255',
            'gender'          => 'required|in:male,female,other',
            'marital_status'  => 'required|in:single,married,divorced,widowed,separated',
            'phone'           => 'required|string|max:20|regex:/^[\d\s\+\-\(\)]+$/',
            'email'           => 'required|email|max:255',
            'address'         => 'required|string|max:500',
            'dob'             => 'required|date|before:today',
            'nationality'     => 'required|string|max:100',
            'hire_date'       => 'required|date|after:dob',
            'department'      => 'required|string|max:100',
        ];
    }

    public function messages(): array
    {
        return [
            'email.unique' => 'This email is already registered.',
            'dob.before'   => 'Date of birth must be in the past.',
            'hire_date.after' => 'Hire date must be after date of birth.',
        ];
    }
}
