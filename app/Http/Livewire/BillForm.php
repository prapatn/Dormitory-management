<?php

namespace App\Http\Livewire;

use App\Models\Bill;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;

class BillForm extends Component
{
    use WithFileUploads;

    public $agreement, $bill, $photo, $dbphoto;
    public $electricity_unit, $water_unit;
    public $electricity_unit_last, $water_unit_last, $pay_other, $pay_last_date;

    public function render()
    {
        return view('livewire.bill-form');
    }

    public function mount()
    {
        $last = Bill::where(['agreement_id' => $this->agreement->id])->latest('id')->first();
        if ($last) {
            $this->electricity_unit_last = $last->electricity_unit;
            $this->water_unit_last = $last->water_unit;
        }
    }
}
