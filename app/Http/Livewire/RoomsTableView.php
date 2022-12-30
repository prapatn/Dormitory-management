<?php

namespace App\Http\Livewire;

use App\Models\Room;
use Livewire\Component;
use Livewire\WithPagination;

class RoomsTableView extends Component
{
    use WithPagination;

    public $dorm_id;
    public function render()
    {
        $rooms = Room::where('dorm_id', $this->dorm_id)->paginate(10);
        return view('livewire.rooms-table-view', ['rooms' => $rooms]);
    }

    public function mount()
    {
    }
}
