<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRaceRequest extends FormRequest
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
            'name' => 'required|string|min:3|max:50|unique:races,name'
        ];
    }

    public function messages()
    {
        return [
            /*
            |--------------------------------------------------------------------------|
            |   messages NAME                                                          |
            |--------------------------------------------------------------------------|
            */
            'name.required' => 'Veuillez entrer le nom de la race.',
            'name.string'   => 'Le nom de la race doit être constitué uniquement de lettres.',
            'name.min'      => 'Le nom de la race doit contenir au moins 3 caractères.',
            'name.max'      => 'Le nom de la race ne doit pas dépasser 50 caractères.',
            'name.unique'   => 'Une race avec ce nom existe déjà. Veuillez choisir un nom différent.',
        ];
    }
}
