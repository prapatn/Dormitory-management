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

    public function updatedSearch()
    {
        $this->resetPage();
    }
    public function render()
    {
        $rooms = Room::where('dorm_id', $this->dorm_id)->paginate(10);
        $results =  Room::where('dorm_id', $this->dorm_id)
            ->where('name', 'like', '%' . $this->search . '%')->orderBy('name', 'ASC')
            ->paginate(10);
        foreach ($results as $item) {
            $agreement =  $item->findAgreementNow($item->id);
            if ($agreement)
                $item->agreement_status = $agreement->status;
            else
                $item->agreement_status = "ห้องว่าง";
        }
        return view('livewire.rooms-table-view', ['rooms' => $rooms, 'results' => $results]);
    }

    public function mount()
    {
    }
}
