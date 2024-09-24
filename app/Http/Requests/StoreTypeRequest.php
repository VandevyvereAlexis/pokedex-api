<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTypeRequest extends FormRequest
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
            'name' => 'required|string|min:3|max:50|unique:types,name',
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
            'name.required' => 'Le nom du type est obligatoire.',
            'name.string'   => 'Le nom du type doit être une chaîne de caractères.',
            'name.min'      => 'Le nom du type doit comporter au moins 3 caractères.',
            'name.max'      => 'Le nom du type ne peut pas dépasser 50 caractères.',
            'name.unique'   => 'Un type avec ce nom existe déjà.',
        ];
    }
}
