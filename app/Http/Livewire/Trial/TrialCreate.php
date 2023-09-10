<?php

namespace App\Http\Livewire\Trial;

use App\Models\Customer;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Stock;
use App\Models\Trial;
use App\Models\TrialItem;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TrialCreate extends Component
{
    public Collection $customers;
    public Collection $products;

    public $trialItems = [];
    public $index = 1;
    public $totalAmount = 0;

    public $customer_id;
    public $product_variant_id;
    public $quantity = 1;
    public $unit_price = 0;
    public $total_price = 0;

    public function mount()
    {
        $this->customers = Customer::orderBy('name')->get();
        $this->products = Product::where('active', true)
            ->with('productVariants')
            ->with('productVariants.productSize')
            ->orderBy('name')
            ->get();
    }

    public function render()
    {
        return view('livewire.trial.trial-create');
    }

    public function addProduct()
    {
        if (is_null($this->product_variant_id) || $this->product_variant_id == "") return;

        $productVariant = ProductVariant::findOrFail($this->product_variant_id);

        $this->trialItems[] = [
            'index' => $this->index,
            'product_variant_id' => $productVariant->id,
            'name' => $productVariant->product->name,
            'quantity' => $this->quantity * 100,
            'unit_price' => $productVariant->price,
            'total_price' => $productVariant->price * $this->quantity,
        ];

        $this->totalAmount += $productVariant->price * $this->quantity;
        $this->index++;

        $this->product_variant_id = null;
        $this->quantity = 1;
    }

    public function removeProduct($index)
    {
        $indexToRemove = array_search($index, array_column($this->trialItems, 'index'));

        $this->totalAmount -= $this->trialItems[$indexToRemove]['total_price'];

        unset($this->trialItems[$indexToRemove]);

        $this->trialItems = array_values($this->trialItems);
        $this->resetItemsIndexes();

        if (empty($this->trialItems)) {
            $this->index = 1;
        } else {
            $this->index = max(array_column($this->trialItems, 'index')) + 1;
        }
    }

    public function resetItemsIndexes()
    {
        $newTrialProducts = [];
        $currentIndex = 1;

        foreach ($this->trialItems as $product) {
            $newTrialProducts[] = [
                'index' => $currentIndex,
                'product_variant_id' => $product['product_variant_id'],
                'name' => $product['name'],
                'quantity' => $product['quantity'],
                'unit_price' => $product['unit_price'],
                'total_price' => $product['total_price'],
            ];

            $currentIndex++;
        }

        $this->trialItems = $newTrialProducts;
    }

    public function updateSelectedProduct()
    {
        $productVariant = ProductVariant::find($this->product_variant_id);

        if (!$productVariant) return;

        $this->unit_price = number_format($productVariant->price / 100, 2, ',', '.');
        $this->total_price = number_format(($productVariant->price * $this->quantity) / 100, 2, ',', '.');
    }

    public function finishTrial()
    {
        $this->validate([
            'customer_id' => 'required',
        ], [
            'required' => 'Selecione um cliente para finalizar o condicional.',
        ]);

        DB::transaction(function () {
            $totalPrice = array_reduce($this->trialItems, function ($carry, $product) {
                return $carry + $product['total_price'];
            }, 0);

            $trial = Trial::create([
                'customer_id' => $this->customer_id,
                'date' => now()->format('Y-m-d'),
                'return_date' => now()->format('Y-m-d'),
                'total_price' => $totalPrice,
            ]);

            foreach ($this->trialItems as $item) {
                TrialItem::create([
                    'trial_id' => $trial->id,
                    'product_variant_id' => $item['product_variant_id'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                    'total_price' => $item['total_price'],
                ]);

                Stock::where('product_variant_id', $item['product_variant_id'])->update([
                    'quantity_on_trials' => DB::raw('quantity_on_trials - ' . $item['quantity'])
                ]);
            }
        });

        return to_route('app.trials.index')->with('success', 'Condicional criado com sucesso!');
    }
}
