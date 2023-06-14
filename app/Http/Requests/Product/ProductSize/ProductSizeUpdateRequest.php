<?php

namespace App\Http\Requests\Product\ProductSize;

use Illuminate\Foundation\Http\FormRequest;

class ProductSizeUpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'max:255'],
            'active' => ['required', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'boolean' => 'O campo :attribute deve conter um valor verdadeiro ou falso.',
            'max' => 'O campo :attribute deve ter no máximo :max caracteres.',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'nome',
            'active' => 'ativo',
        ];
    }
}
