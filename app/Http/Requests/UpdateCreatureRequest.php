<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCreatureRequest extends FormRequest
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
            'name'         => 'nullable|string|alpha_dash|min:3|max:25|unique:creatures,name',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'pv'           => 'nullable|integer|min:0|max:100',
            'atk'          => 'nullable|integer|min:0|max:100',
            'def'          => 'nullable|integer|min:0|max:100',
            'speed'        => 'nullable|integer|min:0|max:100',
            'capture_rate' => 'nullable|integer|min:0|max:100',
            'type_id'      => 'nullable|exists:types,id',
            'race_id'      => 'nullable|exists:races,id',
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
            'name.unique'     => 'Le nom de la créature est déjà utilisé. Veuillez en choisir un autre.',
            'name.alpha_dash' => 'Le nom ne peut contenir que des lettres, des chiffres, des tirets et des underscores.',
            'name.min'        => 'Le nom de la créature doit comporter au moins 3 caractères.',
            'name.max'        => 'Le nom de la créature ne peut pas dépasser 25 caractères.',

            /*
            |--------------------------------------------------------------------------|
            |   messages IMAGE                                                         |
            |--------------------------------------------------------------------------|
            */
            'image.image' => 'Le fichier doit être une image.',
            'image.mimes' => 'L\'image doit être au format jpeg, png, jpg ou gif.',
            'image.max'   => 'L\'image ne peut pas dépasser 2 Mo.',

            /*
            |--------------------------------------------------------------------------|
            |   messages PV                                                            |
            |--------------------------------------------------------------------------|
            */
            'pv.integer' => 'Le nombre de points de vie (PV) doit être un entier.',
            'pv.min'     => 'Les points de vie (PV) doivent être au moins de 0.',
            'pv.max'     => 'Les points de vie (PV) ne peuvent pas dépasser 100.',

            /*
            |--------------------------------------------------------------------------|
            |   messages ATK                                                           |
            |--------------------------------------------------------------------------|
            */
            'atk.integer' => 'La valeur d\'attaque (ATK) doit être un entier.',
            'atk.min'     => 'La valeur d\'attaque (ATK) doit être au moins de 0.',
            'atk.max'     => 'La valeur d\'attaque (ATK) ne peut pas dépasser 100.',

            /*
            |--------------------------------------------------------------------------|
            |   messages DEF                                                           |
            |--------------------------------------------------------------------------|
            */
            'def.integer' => 'La valeur de défense (DEF) doit être un entier.',
            'def.min'     => 'La valeur de défense (DEF) doit être au moins de 0.',
            'def.max'     => 'La valeur de défense (DEF) ne peut pas dépasser 100.',

            /*
            |--------------------------------------------------------------------------|
            |   messages SPEED                                                         |
            |--------------------------------------------------------------------------|
            */
            'speed.integer' => 'La vitesse (SPEED) doit être un entier.',
            'speed.min'     => 'La vitesse (SPEED) doit être au moins de 0.',
            'speed.max'     => 'La vitesse (SPEED) ne peut pas dépasser 100.',

            /*
            |--------------------------------------------------------------------------|
            |   messages CAPTURE_RATE                                                  |
            |--------------------------------------------------------------------------|
            */
            'capture_rate.integer' => 'Le taux de capture doit être un entier.',
            'capture_rate.min'     => 'Le taux de capture doit être au moins de 0.',
            'capture_rate.max'     => 'Le taux de capture ne peut pas dépasser 100.',

            /*
            |--------------------------------------------------------------------------|
            |   messages TYPE                                                          |
            |--------------------------------------------------------------------------|
            */
            'type_id.exists' => 'Le type sélectionné est invalide.',

            /*
            |--------------------------------------------------------------------------|
            |   messages RACE                                                          |
            |--------------------------------------------------------------------------|
            */
            'race_id.exists' => 'La race sélectionnée est invalide.',
        ];
    }
}
