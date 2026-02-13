<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class IngredientRequest extends FormRequest
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
            "name" => ["required", 'unique:ingredients,name', "min:3", "string"],
            "price" => ["required", "min:3", "numeric"]
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => "Vous ne pourvez enregistrer deux ingredients avec le même nom !",
            'name.required' => "Vous devez remplir le nom de l'ingredient !",
            'price.required' => "Vous devez remplir le prix de l'ingredient !"
        ];
    }
}
