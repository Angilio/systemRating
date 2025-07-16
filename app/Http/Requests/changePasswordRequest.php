<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class changePasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        // L'utilisateur doit être connecté pour changer son mot de passe
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'current_password' => 'required|string|min:8',
            'new_password' => 'required|string|min:8|confirmed|different:current_password',
        ];
    }

    public function messages(): array
    {
        return [
            'current_password.required' => 'Veuillez entrer votre mot de passe actuel.',
            'new_password.required' => 'Le nouveau mot de passe est requis.',
            'new_password.confirmed' => 'La confirmation ne correspond pas au nouveau mot de passe.',
            'new_password.different' => 'Le nouveau mot de passe doit être différent de l\'ancien.',
        ];
    }
}
