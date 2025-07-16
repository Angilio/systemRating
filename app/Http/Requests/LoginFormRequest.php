<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginFormRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Autoriser tout le monde à envoyer ce formulaire
    }

    public function rules()
    {
        return [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:8',
        ];
    }

    public function messages()
    {
        return [
            'email.exists' => 'Aucun compte ne correspond à cette adresse e-mail.',
            'email.required' => 'L\'adresse e-mail est obligatoire.',
            'password.required' => 'Le mot de passe est obligatoire.',
        ];
    }
}
