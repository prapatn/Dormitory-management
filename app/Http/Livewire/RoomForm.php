<?php

namespace App\Http\Livewire;

use Livewire\Component;

class RoomForm extends Component
{
    public $room, $name, $floor, $price;
    public $num_start, $num_end;


    public function render()
    {
        return view('livewire.room-form');
    }

    public function mount()
    {
        if ($this->room) {
            $this->name = $this->room->name;
            $this->floor = $this->room->floor;
            $this->price = $this->room->price;
        }
    }
}
