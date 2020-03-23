<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProcedureRequest extends FormRequest
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
        if (isset($this->procedure) && $this->procedure) {
            $name = [
                'required',
                'max:255',
                Rule::unique('procedures')->ignore($this->procedure)
            ];
        } else {
            $name = [
                'required',
                'max:255',
                'unique:procedures,name'
            ];

        }
        return [
            'name' => $name,
            'description' => 'max:1000',
            'duration_from_minute' => [
                'required',
                'integer',
                'min:1'
            ],
            'duration_to_minute' => [
                'required',
                'greater_than_field:duration_from_minute',
                'integer',
                'min:1'
            ],
        ];
    }

    /**
     * @inheritDoc
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Procedure name is required.',
            'duration_to_minute.required' => 'Duration end is required.',
            'duration_to_minute.greater_than_field' => '(Duration to) must not be lower than (duration from).',
        ];
    }
}
