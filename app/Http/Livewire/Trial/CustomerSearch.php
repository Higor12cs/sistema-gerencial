<?php

namespace App\Http\Livewire\Trial;

use App\Models\Trial;
use App\Models\TrialItem;
use Livewire\Component;

class CustomerSearch extends Component
{
    public bool $selected = false;
    public $trialId;
    public $customerId;
    public $customers;

    public function render()
    {
        return view('livewire.trial.customer-search');
    }

    public function selectCustomer()
    {
        $this->validate([
            'customerId' => ['required', 'exists:customers,id']
        ]);

        $trial = Trial::create([
            'customer_id' => $this->customerId,
            'date' => now()->format('Y-m-d'),
        ]);

        $this->selected = true;
        $this->trialId = $trial->id;
        $this->emit('customerSelected', $trial->id);
    }

    public function discardTrial()
    {
        if ($this->trialId) {
            Trial::destroy($this->trialId);
            TrialItem::where('trial_id', $this->trialId)->delete();
        }

        return to_route('app.trials.index')->with('success', 'Condicional excluído com sucesso!');
    }
}
