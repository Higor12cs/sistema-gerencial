<?php

namespace App\Http\Livewire\Trial;

use App\Models\TrialItem;
use Livewire\Component;

class TrialItemsTable extends Component
{
    public $trialId;
    public $trialItems;

    protected $listeners = ['trialdProductAdded' => 'render', 'customerSelected'];

    public function render()
    {
        $this->trialItems = TrialItem::where('trial_id', $this->trialId)
            ->with('productVariant')
            ->with('productVariant.product')
            ->get();

        return view('livewire.trial.trial-items-table');
    }

    public function customerSelected(int $trialId)
    {
        $this->trialId = $trialId;
        $this->render();
    }

    public function test()
    {
        $this->render();
    }
}
