<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'pseudo' => 'nullable|string|alpha_dash|min:3|max:25|unique:users,pseudo',
            'email'  => 'nullable|email|unique:users,email|max:255',
            'image'  => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            /*
            |--------------------------------------------------------------------------|
            |   Messages Pseudo                                                        |
            |--------------------------------------------------------------------------|
            */
            'pseudo.nullable'   => 'Le pseudo est facultatif.',
            'pseudo.string'     => 'Le pseudo doit être une chaîne de caractères.',
            'pseudo.alpha_dash' => 'Le pseudo ne peut contenir que des lettres, des chiffres, des tirets et des underscores.',
            'pseudo.min'        => 'Le pseudo doit contenir au moins 3 caractères.',
            'pseudo.max'        => 'Le pseudo ne peut pas dépasser 25 caractères.',
            'pseudo.unique'     => 'Ce pseudo est déjà utilisé par un autre utilisateur.',

            /*
            |--------------------------------------------------------------------------|
            |   Messages Email                                                         |
            |--------------------------------------------------------------------------|
            */
            'email.nullable' => 'L\'adresse e-mail est facultative.',
            'email.email'    => 'L\'adresse e-mail doit être valide.',
            'email.unique'   => 'Cette adresse e-mail est déjà utilisée par un autre utilisateur.',
            'email.max'      => 'L\'adresse e-mail ne peut pas dépasser 255 caractères.',

            /*
            |--------------------------------------------------------------------------|
            |   Messages Image                                                         |
            |--------------------------------------------------------------------------|
            */
            'image.nullable' => 'L\'image est facultative.',
            'image.image'    => 'Le fichier doit être une image.',
            'image.mimes'    => 'L\'image doit être au format jpeg, png, jpg, gif ou svg.',
            'image.max'      => 'L\'image ne peut pas dépasser 2 Mo.',
        ];
    }
}
