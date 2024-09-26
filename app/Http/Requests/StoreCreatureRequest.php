<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCreatureRequest extends FormRequest
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
            'name'         => 'required|string|alpha_dash|min:3|max:25|unique:creatures,name',
            'pv'           => 'required|integer|max:100',
            'atk'          => 'required|integer|max:100',
            'def'          => 'required|integer|max:100',
            'speed'        => 'required|integer|max:100',
            'capture_rate' => 'required|integer|max:100',
            'type'         => 'required|exists:types,id',
            'race'         => 'required|exists:races,id',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'user_id'      => 'required'
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
            'name.required'    => 'Le nom de la créature est requis.',
            'name.string'      => 'Le nom de la créature doit être une chaîne de caractères.',
            'name.alpha_dash'  => 'Le nom ne peut contenir que des lettres, des chiffres, des tirets et des underscores.',
            'name.min'         => 'Le nom de la créature doit comporter au moins 3 caractères.',
            'name.max'         => 'Le nom de la créature ne peut pas dépasser 25 caractères.',
            'name.unique'      => 'Ce nom de créature est déjà pris. Veuillez en choisir un autre.',

            /*
            |--------------------------------------------------------------------------|
            |   messages PV                                                            |
            |--------------------------------------------------------------------------|
            */
            'pv.required'      => 'Les points de vie (PV) sont requis.',
            'pv.integer'       => 'Les points de vie (PV) doivent être un nombre entier.',
            'pv.max'           => 'Les points de vie (PV) ne peuvent pas dépasser 100.',

            /*
            |--------------------------------------------------------------------------|
            |   messages ATK                                                           |
            |--------------------------------------------------------------------------|
            */
            'atk.required'     => 'La valeur d\'attaque est obligatoire.',
            'atk.integer'      => 'La valeur d\'attaque doit être un nombre entier.',
            'atk.max'          => 'La valeur d\'attaque ne peut pas dépasser 100.',

            /*
            |--------------------------------------------------------------------------|
            |   messages DEF                                                           |
            |--------------------------------------------------------------------------|
            */
            'def.required'     => 'La valeur de défense est obligatoire.',
            'def.integer'      => 'La valeur de défense doit être un nombre entier.',
            'def.max'          => 'La valeur de défense ne peut pas dépasser 100.',

            /*
            |--------------------------------------------------------------------------|
            |   messages SPEED                                                         |
            |--------------------------------------------------------------------------|
            */
            'speed.required'   => 'La vitesse est requise.',
            'speed.integer'    => 'La vitesse doit être un nombre entier.',
            'speed.max'        => 'La vitesse ne peut pas dépasser 100.',

            /*
            |--------------------------------------------------------------------------|
            |   messages CAPTURE_RATE                                                  |
            |--------------------------------------------------------------------------|
            */
            'capture_rate.required' => 'Le taux de capture est requis.',
            'capture_rate.integer'  => 'Le taux de capture doit être un nombre entier.',
            'capture_rate.max'      => 'Le taux de capture ne peut pas dépasser 100.',

            /*
            |--------------------------------------------------------------------------|
            |   messages TYPE                                                          |
            |--------------------------------------------------------------------------|
            */
            'type.required'    => 'Le type de créature est obligatoire.',
            'type.exists'      => 'Le type sélectionné est invalide.',

            /*
            |--------------------------------------------------------------------------|
            |   messages RACE                                                          |
            |--------------------------------------------------------------------------|
            */
            'race.required'    => 'La race de créature est obligatoire.',
            'race.exists'      => 'La race sélectionnée est invalide.',

            /*
            |--------------------------------------------------------------------------|
            |   messages IMAGE                                                         |
            |--------------------------------------------------------------------------|
            */
            'image.image'      => 'Le fichier téléchargé doit être une image.',
            'image.mimes'      => 'L\'image doit être au format jpeg, png, jpg, gif ou svg.',
            'image.max'        => 'L\'image ne doit pas dépasser 2 Mo.',

            /*
            |--------------------------------------------------------------------------|
            |   messages USER_ID                                                       |
            |--------------------------------------------------------------------------|
            */
            'user_id.required' => 'L\'identifiant de l\'utilisateur est requis.',
        ];
    }
}
