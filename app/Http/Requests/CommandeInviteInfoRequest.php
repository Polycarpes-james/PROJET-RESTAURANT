<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommandeInviteInfoRequest extends FormRequest
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
            "name" => 'required|string',
            "lastname" => 'required|string',
            "email" => 'required|email',
            "address" => 'required|string',
            "phone" => 'required|strin',
            "instructions" => 'required|string',
            "total_quantite" => 'required|integer',
            "total_prix" =>'required|integer'
        ];
    }
}
