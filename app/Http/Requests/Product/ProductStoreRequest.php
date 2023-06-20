<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
            'name' => ['required'],
            'product_brand_id' => ['nullable', 'exists:product_brands,id'],
            'product_category_id' => ['nullable', 'exists:product_categories,id'],
            'product_season_id' => ['nullable', 'exists:product_seasons,id'],
        ];
    }
}
