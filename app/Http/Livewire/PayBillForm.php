<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class PayBillForm extends Component
{
    use WithFileUploads;

    public $dbphoto, $photo, $bill;
    public function render()
    {
        return view('livewire.pay-bill-form');
    }

    public function mount()
    {
        if ($this->bill->payment) {
            $this->dbphoto = $this->bill->payment->image;
        }
    }
}
