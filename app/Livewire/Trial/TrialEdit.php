<?php

namespace App\Livewire\Trial;

use App\Models\Customer;
use App\Models\Product;
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

    public $trialItems;

    public $index = 1;

    public $totalAmount = 0;

    public $customer_id;

    public $product_id;

    public $quantity = 1;

    public $unit_price = 0;

    public $total_price = 0;

    public function mount(Trial $trial)
    {
        $this->trial = $trial;
        $this->customers = Customer::orderBy('name')->get();
        $this->products = Product::where('active', true)
            ->with('productSize')
            ->orderBy('name')
            ->get();

        $this->customer_id = $trial->customer_id;
        $this->trialItems = $trial->trialItems->map(function ($item, $index) {
            $this->index += 1;

            return [
                'id' => $item->id,
                'index' => $index + 1,
                'product_id' => $item->product_id,
                'name' => $item->product->name,
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
        if (is_null($this->product_id) || $this->product_id == '') {
            $this->unit_price = 0;
            $this->total_price = 0;

            return;
        }

        $product = Product::findOrFail($this->product_id);

        $this->trialItems[] = [
            'id' => null,
            'index' => $this->index,
            'product_id' => $product->id,
            'name' => $product->name,
            'quantity' => $this->quantity * 100,
            'unit_price' => $product->price,
            'total_price' => $product->price * $this->quantity,
        ];

        $this->totalAmount += $product->price * $this->quantity;
        $this->index++;

        $this->product_id = null;
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
        $product = Product::find($this->product_id);

        if (! $product) {
            return;
        }

        $this->unit_price = number_format($product->price / 100, 2, ',', '.');
        $this->total_price = number_format(($product->price * $this->quantity) / 100, 2, ',', '.');
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
                        'product_id' => $item['product_id'],
                    ]));
                }

                Stock::where('product_id', $item['product_id'])->update([
                    'quantity_on_trials' => DB::raw('quantity_on_trials - '.$item['quantity']),
                ]);
            }
        });

        return to_route('app.trials.index')->with('success', 'Condicional atualizado com sucesso!');
    }
}
