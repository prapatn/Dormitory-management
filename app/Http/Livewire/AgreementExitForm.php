<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AgreementExitForm extends Component
{
    public $annotation;
    public function render()
    {
        return view('livewire.agreement-exit-form');
    }
}
