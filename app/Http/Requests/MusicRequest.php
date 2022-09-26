<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MusicRequest extends FormRequest
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
            'album_id' => 'required',
            'name' => 'required',
            'audio' => 'required|mimes:application/octet-stream,audio/mpeg,mpga,mp3,wav',
            'image' => 'mimes:jpeg,jpg,png|required|max:10000'
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
