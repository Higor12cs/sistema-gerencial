<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'product_brand_id' => ['nullable', 'exists:product_brands,id'],
            'product_category_id' => ['nullable', 'exists:product_categories,id'],
            'product_season_id' => ['nullable', 'exists:product_seasons,id'],
            'active' => ['sometimes', 'boolean'],
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
            'product_brand_id' => 'marca',
            'product_category_id' => 'categoria',
            'product_season_id' => 'estação',
            'active' => 'ativo',
        ];
    }
}
