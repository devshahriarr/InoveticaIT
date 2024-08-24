<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceCatRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'categoryName' => 'required|max:100'
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
