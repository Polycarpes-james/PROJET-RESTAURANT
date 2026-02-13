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
            'email' => ['required', 'email', 'min:5'],
            'password' => ['required', 'min:4']
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Vous devez remplir votre adresse email !',
            'email.min' => 'Votre email est trop courte !',
            'password.required' => 'Vous devez remplir votre mot de passe !',
            'password.min' => 'Votre mot de passe est trop courte!',
            'email.email' => 'Vous email est incorrecte !',
        ];
    }
}
