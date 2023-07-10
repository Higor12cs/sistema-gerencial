<?php

namespace App\Http\Livewire\Trial;

use App\Models\ProductVariant;
use App\Models\Trial;
use App\Models\TrialItem;
use Livewire\Component;

class TrialItemsSection extends Component
{
    public $products;
    public $trialId;
    public $productVariantId;
    public $inputEnabled = false;

    public $listeners = ['loadVariants', 'customerSelected' => 'enableProductInput'];

    public function render()
    {
        return view('livewire.trial.trial-items-section');
    }

    public function selectProduct()
    {
        $this->validate([
            'productVariantId' => ['required', 'exists:product_variants,id']
        ]);

        $productVariant = ProductVariant::findOrFail($this->productVariantId);
        $trial = Trial::findOrfail($this->trialId);
        $quantity = 1;

        TrialItem::create([
            'trial_id' => $this->trialId,
            'product_variant_id' => $this->productVariantId,
            'transaction_type' => 'SND',
            'transaction_date' => now(),
            'quantity' => $quantity * 100,
            'unit_price' => $productVariant->price,
            'total_price' => $productVariant->price * $quantity,
        ]);

        $trial->update([
            'total_price' => $trial->total_price + ($productVariant->price * $quantity),
        ]);

        $this->productVariantId = '';
        $this->emit('trialdProductAdded');
    }

    public function enableProductInput(int $trialId)
    {
        $this->trialId = $trialId;
        $this->inputEnabled = true;
    }
}
