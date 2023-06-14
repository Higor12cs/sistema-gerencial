<?php

namespace App\Http\Requests\Product\ProductVariant;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductVariantUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Handle a passed validation attempt.
     */
    protected function passedValidation(): void
    {
        $this->replace(['price' => $this->price * 100]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
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
