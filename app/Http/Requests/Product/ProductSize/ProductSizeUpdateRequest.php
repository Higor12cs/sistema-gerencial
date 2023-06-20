<?php

namespace App\Http\Requests\Product\ProductSize;

use Illuminate\Foundation\Http\FormRequest;

class ProductSizeUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'name' => \Illuminate\Support\Str::upper($this->name),
        ]);
    }

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
