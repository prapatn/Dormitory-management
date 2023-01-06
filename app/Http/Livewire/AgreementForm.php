<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Cookie;
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

    public function updatedRenter()
    {
        Cookie::queue('renter',  $this->renter, 10);

    }

    public function updatedSearch()
    {
        if ($this->search != "") {
            $this->results =  User::where(['role' => 'renter'])->where(
                'email',
                'like',
                '%' . $this->search . '%'
            )->orWhere('phone', 'like', '%' . $this->search . '%')->limit(3)->get();
            $this->user =  User::where(['role' => 'renter'])->where(
                'email',
                'like',
                '%' . $this->search . '%'
            )->orWhere('phone', 'like', '%' . $this->search . '%')->first();
        } else {
            $this->results = [];
            $this->user = null;
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
