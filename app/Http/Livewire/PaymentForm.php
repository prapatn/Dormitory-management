<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class PaymentForm extends Component
{
    use WithFileUploads;

    public $dormitory;

    public $dbphoto, $photo;
    public $bank_name, $payment_number;

    public function render()
    {
        return view('livewire.payment-form');
    }

    public function mount()
    {
        if ($this->dormitory != null) {
            $this->dbphoto = $this->dormitory->payment_image;
            $this->bank_name = $this->dormitory->bank_name;
            $this->payment_number = $this->dormitory->payment_number;
        }
    }
}
