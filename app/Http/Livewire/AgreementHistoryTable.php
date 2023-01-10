<?php

namespace App\Http\Livewire;

use App\Models\Agreement;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class AgreementHistoryTable extends Component
{
    use WithPagination;
    public $room_id;
    protected $queryString = ['search'];
    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $agreements = Agreement::where(['room_id' => $this->room_id])->orderBy('end_date', 'ASC')->paginate(10);
        $results =  Agreement::where('room_id', $this->room_id)
            ->join('users', function ($join) {
                $join->on('agreements.user_id', '=', 'users.id')
                    ->where('users.name', 'like', '%' . $this->search . '%');
            })
            ->orderBy('end_date', 'ASC')
            ->paginate(10);
        return view('livewire.agreement-history-table', ['agreements' => $agreements, 'results' => $results]);
    }

    public function mount()
    {
    }

    public function checkDateBetween($start, $end)
    {

        if (Carbon::now()->between($start, $end)) {
            return "ปัจจุบัน";
        } else if (Carbon::now()->isBefore($start)) {
            return "รอวันเริ่มสัญญา";
        } else {
            return "";
        }
    }
}
