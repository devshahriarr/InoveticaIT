<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTeamRequest extends FormRequest
{
    public function authorize()
    {
        // Set this to true if any authenticated user can make this request.
        // Adjust according to your authorization logic.
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|max:100',
            'position' => 'required|max:100',
            'image' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ];
    }
}
