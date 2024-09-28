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
            'email'    => 'required|email',
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
            'email.required' => 'Le champ email est obligatoire.',
            'email.email'    => 'Veuillez entrer une adresse email valide.',

            /*
            |--------------------------------------------------------------------------|
            |   messages PASSWORD                                                      |
            |--------------------------------------------------------------------------|
            */
            'password.required' => 'Le champ mot de passe est obligatoire.',
        ];
    }
}
