<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;

class AgreementForm extends Component
{
    use WithFileUploads;
    public $room;
    public $renter;
    public $end_date, $start_date;
    public $dbphoto, $photo;
    public $nameUser;
    public $search, $user, $results;

    protected $listeners = ['selectUser'];

    public function render()
    {
        return view('livewire.agreement-form');
    }

    public function updatedSearch()
    {
        if ($this->search != "") {
            $this->results =  User::where(['role' => 'renter'])->where(
                'email',
                'like',
                '%' . $this->search . '%'
            )->orWhere('phone', 'like', '%' . $this->search . '%')->limit(3)->get();
        } else {
            $this->results = [];
        }
    }

    public function selectUser($id)
    {
        $this->user = User::find($id);
        $this->search = $this->user->email . " (" . $this->user->phone . ")";
        $this->resetSearch();
    }

    public function resetSearch()
    {
        $this->results = [];
    }
}
