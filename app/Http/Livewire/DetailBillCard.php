<?php

namespace App\Http\Livewire;

use Livewire\Component;

class DetailBillCard extends Component
{
    public $bill;
    public function render()
    {
        return view('livewire.detail-bill-card');
    }
}
