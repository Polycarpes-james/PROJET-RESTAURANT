<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PlatsRequest extends FormRequest
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
            "name" => ['required', 'string', 'min:5'],
            "description" => ['required', 'min:1'],
            "ingredients" => ['array', 'exists:ingredients,id', 'min:1'],
            "menus" => ['array', 'exists:menus,id', 'min:1', 'nullable'],
            'temps_preparation' => ['required', 'integer', 'min:2'],
            "disponibilite" => ['in:yes,no'],
            'price' => ['required', 'numeric', 'min:0'],
            'pictures' => ['array'], 
            'pictures.*' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:2048']
        ];
    }
}
