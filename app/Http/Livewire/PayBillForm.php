<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class PayBillForm extends Component
{
    use WithFileUploads;

    public $dbphoto, $photo;
    public function render()
    {
        return view('livewire.pay-bill-form');
    }
}
