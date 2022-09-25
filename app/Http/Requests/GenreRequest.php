<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GenreRequest extends FormRequest
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
            'name' => 'required|unique:genres',
            'description' => 'required|max:255'
        ];
    }

    public function messages()
    {
        return [
            'name.required'        => 'The field name is required.',
            'name.unique'          => 'The field name already exists.',
            'description.required' => 'The field description is required.',
        ];
    }
}
