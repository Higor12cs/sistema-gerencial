<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductVariantRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'price' => $this->price * 100,
            'name' => \Illuminate\Support\Str::upper($this->name),
        ]);
    }

    public function rules(): array
    {
        return [
            'product_id' => ['required', 'exists:products,id'],
            'sku' => ['nullable', 'max:255', Rule::unique('product_variants', 'sku')->ignore($this->product_variant)],
            'barcode' => ['nullable', 'max:255', Rule::unique('product_variants', 'barcode')->ignore($this->product_variant)],
            'price' => ['required', 'numeric', 'gt:0'],
            'product_size_id' => ['nullable', 'exists:product_sizes,id'],
            'active' => ['sometimes', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'unique' => 'O valor informado no campo :attribute já existe.',
            'numeric' => 'O campo :attribute deve ser somente numérico.',
            'max' => 'O campo :attribute deve ter no máximo :max caracteres.',
            'gt' => 'O campo :attribute deve ser mairo do que 0,00.',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'nome',
            'price' => 'valor de venda',
        ];
    }
}
