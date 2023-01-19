<?php

namespace App\Http\Livewire;

use Livewire\Component;

class DetailBillCard extends Component
{
    public $bill,$user;
    public function render()
    {
        return view('livewire.detail-bill-card');
    }
}
