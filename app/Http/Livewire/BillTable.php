<?php

namespace App\Http\Livewire;

use App\Models\Bill;
use Livewire\Component;
use Livewire\WithPagination;

class BillTable extends Component
{
    use WithPagination;

    protected $queryString = ['search'];
    public $search = '';

    public $agreement;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $bills = Bill::where('agreement_id', $this->agreement->id)->paginate(10);
        $results =  Bill::where('agreement_id', $this->agreement->id)
            ->where('status', 'like', '%' . $this->search . '%')->orderBy('id', 'DESC')
            ->paginate(10);
        return view('livewire.bill-table', ['bills' => $bills, 'results' => $results]);
    }
}
