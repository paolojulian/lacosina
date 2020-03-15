<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreIngredientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        // If updating
        if (isset($this->ingredient) && $this->ingredient) {
            $name = [
                'required',
                'max:255',
                Rule::unique('ingredients')->ignore($this->ingredient)
            ];
        } else {
            $name = [
                'required',
                'max:255',
                'unique:ingredients,name'
            ];

        }
        return [
            'name' => $name,
            'description' => 'max:1000',
            'category' => 'max:255',
        ];
    }

    /**
     * @inheritDoc
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Ingredient name is required',
        ];
    }
}
