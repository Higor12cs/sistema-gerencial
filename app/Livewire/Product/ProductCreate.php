<?php

namespace App\Livewire\Product;

use App\Models\Product;
use App\Models\ProductVariant;
use Livewire\Component;

class ProductCreate extends Component
{
    public $productBrands;
    public $productCategories;
    public $productSeasons;
    public $productSizes;

    public $name;
    public $product_brand_id;
    public $product_category_id;
    public $product_season_id;

    public $productVariants = [];

    public $index = 1;
    public $product_size_id;
    public $sku;
    public $barcode;
    public $cost;
    public $price;

    public function render()
    {
        return view('livewire.product.product-create');
    }

    public function addProductVariant()
    {
        $this->validate([
            'sku' => 'required',
            'barcode' => 'required',
            'product_size_id' => 'required',
            'cost' => 'required|numeric|gt:0',
            'price' => 'required|numeric|gt:0',
        ], [
            'required' => 'O campo :attribute é obrigatório.',
            'numeric' => 'O campo :attribute deve conter apenas números.'
        ], [
            'sku' => 'SKU',
            'barcode' => 'código de barras',
            'product_size_id' => 'tamanho',
            'cost' => 'custo',
            'price' => 'preço',
        ]);

        // to do
        // unique sku and barcode in the product variants table and the current array

        $this->productVariants[] = [
            'index' => $this->index,
            'product_size_id' => $this->product_size_id,
            'sku' => $this->sku,
            'barcode' => $this->barcode,
            'cost' => $this->cost * 100,
            'price' => $this->price * 100,
        ];

        $this->index++;
    }

    public function removeProductVariant($index)
    {
        unset($this->productVariants[$index]);
        $this->productVariants = array_values($this->productVariants);
    }

    public function save()
    {
        $this->validate([
            'name' => 'required',
            'product_brand_id' => 'nullable',
            'product_category_id' => 'nullable',
            'product_season_id' => 'nullable',
        ], [
            'required' => 'O campo :attribute é obrigatório.',
        ], [
            'name' => 'nome',
            'product_brand_id' => 'marca',
            'product_category_id' => 'categoria',
            'product_season_id' => 'temporada',
        ]);

        $product = Product::create([
            'name' => $this->name,
            'product_brand_id' => $this->product_brand_id,
            'product_category_id' => $this->product_category_id,
            'product_season_id' => $this->product_season_id,
        ]);

        foreach ($this->productVariants as $variant) {
            ProductVariant::create([
                'product_id' => $product->id,
                'product_size_id' => $variant['product_size_id'],
                'sku' => $variant['sku'],
                'barcode' => $variant['barcode'],
                'cost' => $variant['cost'],
                'price' => $variant['price'],
            ]);
        }

        return to_route('app.products.index')->with('success', __('Produto cadastrado com sucesso!'));
    }
}
