<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlbumRequest extends FormRequest
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
            'description' => 'required|max:255',
            'genres' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required'        => 'The field name is required.',
            'genres.required'      => 'The field genres is required.',
            'description.required' => 'The field description is required.',
        ];
    }

}
