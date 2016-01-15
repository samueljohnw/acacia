<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ProfileRequest extends Request
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
     * @return array
     */
    public function rules()
    {
        return
        [
            'image' => 'image',
            'slug' => 'alpha_dash|required|unique:users,slug,'.auth()->user()->id,
            'email' => 'unique:users,email,'.auth()->user()->id,
            'website' => 'min:3|URL',
        ];
    }
}
