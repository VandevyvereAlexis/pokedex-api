<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email'    => 'required|email|exists:users,email',
            'password' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            /*
            |--------------------------------------------------------------------------|
            |   messages EMAIL                                                         |
            |--------------------------------------------------------------------------|
            */
            'email.required' => 'L\'adresse e-mail est requise.',
            'email.email'    => 'Veuillez entrer une adresse e-mail valide.',
            'email.exists'   => 'Aucun compte n\'est associé à cette adresse e-mail. Veuillez vérifier et réessayer.',

            /*
            |--------------------------------------------------------------------------|
            |   messages PASSWORD                                                      |
            |--------------------------------------------------------------------------|
            */
            'password.required' => 'Le champ mot de passe est obligatoire.',
        ];
    }
}
