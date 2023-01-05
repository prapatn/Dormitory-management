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
        $results =  Room::where('dorm_id', $this->dorm_id)
            ->where('name', 'like', '%' . $this->search . '%')->orderBy('name', 'ASC')
            ->paginate(10);
        return view('livewire.rooms-table-view', ['rooms' => $rooms, 'results' => $results]);
    }

    public function mount()
    {
    }
}
