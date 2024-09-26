<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTypeRequest extends FormRequest
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
            'name' => 'required|string|min:3|max:50|unique:types,name'
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
            'name.required' => 'Veuillez entrer le nom du type.',
            'name.string'   => 'Le nom du type doit être constitué uniquement de lettres.',
            'name.min'      => 'Le nom du type doit contenir au moins 3 caractères.',
            'name.max'      => 'Le nom du type ne doit pas dépasser 50 caractères.',
            'name.unique'   => 'Un type avec ce nom existe déjà. Veuillez choisir un nom différent.',
        ];
    }
}
