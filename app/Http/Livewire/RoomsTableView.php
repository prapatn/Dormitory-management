<?php

namespace App\Http\Livewire;

use App\Models\Room;
use Livewire\Component;
use Livewire\WithPagination;

class RoomsTableView extends Component
{
    use WithPagination;

    public $dorm_id;

    protected $queryString = ['search'];
    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function render()
    {
        $rooms = Room::where('dorm_id', $this->dorm_id)->paginate(10);
        if ($this->search != '') {
            $results =  Room::where('dorm_id', $this->dorm_id)
                ->where('name', 'like', '%' . $this->search . '%')
                ->paginate(10);

        } else {
            $results =  $rooms;
        }
        return view('livewire.rooms-table-view', ['rooms' => $results]);
    }

    public function mount()
    {
    }
}
