<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UpdatePasswordRequest extends FormRequest
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
            'oldPassword' => 'required',
            'newPassword' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->mixedCase()
                    ->letters()
                    ->numbers()
                    ->symbols()
            ],
        ];
    }

    public function messages(): array
    {
        return [
            /*
            |--------------------------------------------------------------------------|
            |   messages OLD PASSWORD                                                  |
            |--------------------------------------------------------------------------|
            */
            'oldPassword.required' => 'Le mot de passe actuel est requis.',
            'oldPassword.string'   => 'Le mot de passe actuel doit être une chaîne de caractères.',

            /*
            |--------------------------------------------------------------------------|
            |   messages NEW PASSWORD                                                  |
            |--------------------------------------------------------------------------|
            */
            'newPassword.required'  => 'Le nouveau mot de passe est requis.',
            'newPassword.confirmed' => 'Les mots de passe ne correspondent pas.',
            'newPassword.min'       => 'Le nouveau mot de passe doit comporter au moins 8 caractères.',
            'newPassword.mixedCase' => 'Le nouveau mot de passe doit contenir des lettres minuscules et majuscules.',
            'newPassword.letters'   => 'Le nouveau mot de passe doit contenir au moins une lettre.',
            'newPassword.numbers'   => 'Le nouveau mot de passe doit contenir au moins un chiffre.',
            'newPassword.symbols'   => 'Le nouveau mot de passe doit contenir au moins un caractère spécial.',
        ];
    }
}
