<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeamRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true; // Adjust authorization logic if needed
    }

    public function rules()
    {
        $rules = [
            'name' => 'required|max:100',
            'position' => 'required|max:100',
        ];

        // Additional rule for creating a new team member
        if ($this->isMethod('post')) {
            $rules['image'] = 'image|mimes:jpeg,png,jpg,gif,webp|max:2048';
        }

        // Optional: Rules specific to updating
        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules['image'] = 'sometimes|image|mimes:jpeg,png,jpg,gif,webp|max:2048';
        }

        return $rules;
    }
}
