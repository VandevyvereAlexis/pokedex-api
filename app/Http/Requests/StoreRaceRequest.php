<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRaceRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:50|unique:races,name',
        ];
    }

    public function messages(): array
    {
        return [
            /*
            |--------------------------------------------------------------------------|
            |   messages NAME                                                          |
            |--------------------------------------------------------------------------|
            */
            'name.required' => 'Le nom de la race est obligatoire.',
            'name.string'   => 'Le nom de la race doit être une chaîne de caractères.',
            'name.min'      => 'Le nom de la race doit comporter au moins 3 caractères.',
            'name.max'      => 'Le nom de la race ne peut pas dépasser 50 caractères.',
            'name.unique'   => 'Une race avec ce nom existe déjà.',
        ];
    }
}
