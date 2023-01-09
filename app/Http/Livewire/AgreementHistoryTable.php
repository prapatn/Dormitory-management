<?php

namespace App\Http\Livewire;

use App\Models\Agreement;
use Carbon\Carbon;
use Livewire\Component;

class AgreementHistoryTable extends Component
{
    public $room_id;
    protected $queryString = ['search'];
    public $search = '';

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
        $check = Carbon::now()->between($start, $end);

        if ($check) {
            return "ปัจจุบัน";
        } else {
            "";
        }
    }
}
