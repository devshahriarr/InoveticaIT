<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PortfolioCategoryRequest extends FormRequest
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
     */
    public function rules(): array
    {
        $rules = [
            'categoryName' => 'required|string|max:100|unique:portfolio_categories,categoryName,' . $this->route('id'),
        ];

        // If it's a POST request for creating a new category
        if ($this->isMethod('post') && !$this->route('id')) {
            $rules['image'] = 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048';
        }

        // If it's a POST request for updating an existing category
        if ($this->isMethod('post') && $this->route('id')) {
            $rules['image'] = 'sometimes|image|mimes:jpeg,png,jpg,gif,webp|max:2048';
        }

        return $rules;
    }
}
