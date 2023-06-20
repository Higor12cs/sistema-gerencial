<?php

namespace App\Http\Requests\Product\ProductVariant;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductVariantUpdateRequest extends FormRequest
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
            'sku' => ['nullable', Rule::unique('product_variants', 'sku')->ignore($this->product_variant)],
            'barcode' => ['nullable', Rule::unique('product_variants', 'barcode')->ignore($this->product_variant)],
            'price' => ['required', 'numeric'],
            'name' => ['required', 'max:255'],
            'product_color_id' => ['nullable', 'exists:product_colors,id'],
            'product_size_id' => ['nullable', 'exists:product_sizes,id'],
            'active' => ['required', 'boolean'],
        ];
    }
}
