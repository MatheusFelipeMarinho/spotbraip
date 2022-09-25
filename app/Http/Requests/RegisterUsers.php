<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUsers extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'nickname' => 'required|unique:users',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ];
    }

    public function messages()
    {
        return [
            'name.required'      => 'The field name is required.',
            'nickname.required'  => 'The field nickname is required.',
            'nickname.unique'    => 'This nickname already exists in database.',
            'email.required'     => 'The field email is required.',
            'email.email'        => 'Invalid email.',
            'email.unique'       => 'This email already exists in database.',
            'password.min'       => 'Password must be at least 6 characters long.',
        ];
    }
}
