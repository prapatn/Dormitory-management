<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ShowAgreementNow extends Component
{
    public $agreement, $room , $page;
    public function render()
    {
        return view('livewire.show-agreement-now');
    }
}
