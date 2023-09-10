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

class TrialEdit extends Component
{
    public Collection $customers;
    public Collection $products;

    public $trial;
    public $trialItems = [];
    public $index = 1;
    public $totalAmount = 0;

    public $customer_id;
    public $product_variant_id;
    public $quantity = 1;
    public $unit_price = 0;
    public $total_price = 0;

    public function mount(Trial $trial)
    {
        $this->trial = $trial;
        $this->customers = Customer::orderBy('name')->get();
        $this->products = Product::where('active', true)
            ->with('productVariants')
            ->with('productVariants.productSize')
            ->orderBy('name')
            ->get();

        $this->customer_id = $trial->customer_id;
        $this->trialItems = $trial->trialItems->map(function ($item, $index) {
            $this->index += 1;
            return [
                'id' => $item->id,
                'index' => $index + 1,
                'product_variant_id' => $item->product_variant_id,
                'name' => $item->productVariant->product->name,
                'quantity' => $item->quantity,
                'unit_price' => $item->unit_price,
                'total_price' => $item->total_price,
            ];
        })->values();

        $this->totalAmount = $this->trialItems->sum('total_price');
    }

    public function render()
    {
        return view('livewire.trial.trial-edit');
    }

    public function addProduct()
    {
        if (is_null($this->product_variant_id) || $this->product_variant_id == "") return;

        $productVariant = ProductVariant::findOrFail($this->product_variant_id);

        $this->trialItems[] = [
            'id' => null,
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
        $this->trialItems = $this->trialItems->map(function ($item) use ($index) {
            if ($item['index'] == $index) {
                $item['deleted'] = true;
                $this->totalAmount -= $item['total_price'];
            }
            return $item;
        });

        $this->trialItems = $this->trialItems->values();
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
            $totalPrice = $this->totalAmount;

            $this->trial->update([
                'customer_id' => $this->customer_id,
                'total_price' => $totalPrice,
            ]);

            foreach ($this->trialItems as $item) {
                if (isset($item['deleted']) && $item['deleted']) {
                    if (isset($item['id'])) {
                        TrialItem::destroy($item['id']);
                    }
                    continue;
                }

                $existingItem = $this->trial->trialItems->where('id', $item['id'])->first();

                $itemData = [
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                    'total_price' => $item['total_price'],
                ];

                if ($existingItem) {
                    $existingItem->update($itemData);
                } else {
                    TrialItem::create(array_merge($itemData, [
                        'trial_id' => $this->trial->id,
                        'product_variant_id' => $item['product_variant_id'],
                    ]));
                }

                Stock::where('product_variant_id', $item['product_variant_id'])->update([
                    'quantity_on_trials' => DB::raw('quantity_on_trials - ' . $item['quantity'])
                ]);
            }
        });

        return to_route('app.trials.index')->with('success', 'Condicional atualizado com sucesso!');
    }
}
