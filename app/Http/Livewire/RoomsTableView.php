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
        $results =  Room::where('dorm_id', $this->dorm_id)
            ->where('name', 'like', '%' . $this->search . '%')
            ->paginate(10);
        return view('livewire.rooms-table-view', ['rooms' => $results]);
    }

    public function mount()
    {
    }
}
