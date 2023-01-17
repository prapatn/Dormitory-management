<?php

namespace App\Http\Livewire;

use App\Models\Bill;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class BillTable extends Component
{
    use WithPagination;

    protected $queryString = ['search'];
    public $search = '';
    public $user;
    public $agreement;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        if (Auth::user()->role == "owner") {
            $bills = Bill::where('agreement_id', $this->agreement->id)->paginate(10);
            $results =  Bill::where('agreement_id', $this->agreement->id)
                ->where('status', 'like', '%' . $this->search . '%')->orderBy('id', 'DESC')
                ->paginate(10);
        } else if (Auth::user()->role == "renter") {
            $bills = Bill::join('agreements', 'bills.agreement_id', '=', 'agreements.id')
                ->join('users', 'agreements.user_id', '=', 'users.id')
                ->where('users.id', Auth::user()->id)
                ->select('bills.*')->paginate(10);
            $results = Bill::join('agreements', 'bills.agreement_id', '=', 'agreements.id')
                ->join('users', 'agreements.user_id', '=', 'users.id')
                ->where('users.id', Auth::user()->id)
                ->select('bills.*')
                ->where('bills.status', 'like', '%' . $this->search . '%')->orderBy('id', 'DESC')
                ->paginate(10);
        }

        return view('livewire.bill-table', ['bills' => $bills, 'results' => $results]);
    }

    public function mount()
    {
        $this->user = Auth::user();
    }
}
