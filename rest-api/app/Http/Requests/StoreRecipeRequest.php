<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRecipeRequest extends FormRequest
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
        return [
            'name' => [
                'required',
                'max:255',
                'unique:procedures,name'
            ],
            'description' => 'max:1000',
            'duration_from_minute' => [
                'required_with:duration_to_minute',
                'integer',
                'min:0'
            ],

            'ingredients' => 'required|array|min:1|max:100',
            'ingredients.measurement' => 'string|min:3',
            'ingredients.optional_name' => 'max:50',
            'ingredients.description' => 'max:1000',
            'ingredients.ingredient_id' => 'exists:ingredients,id',

            'procedures' => 'required|array|min:1|max:100',
            'procedures.optional_name' => 'max:50',
            'procedures.description' => 'max:1000',
            'procedures.procedure_id' => 'exists:procedures,id',

            'duration_from_minute' => [
                'required_with:duration_to_minute',
                'integer',
                'min:0'
            ],
            'duration_to_minute' => [
                'required_with:duration_from_minute',
                'greater_than_field:duration_from_minute',
                'integer',
                'min:0'
            ],

            'duration_to_minute' => [
                'required_with:duration_from_minute',
                'greater_than_field:duration_from_minute',
                'integer',
                'min:0'
            ],
        ];
    }
}
