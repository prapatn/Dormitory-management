<?php

namespace App\Http\Livewire;

use Livewire\Component;

class RoomForm extends Component
{
    public $room;
    public $num_start,$num_end;


    public function render()
    {
        return view('livewire.room-form');
    }

    public function mount()
    {
        if ($this->room != null) {
        }
    }
}
