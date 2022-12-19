<?php

namespace App\Http\Livewire;

use App\Models\Amphure;
use App\Models\District;
use App\Models\Province;
use Livewire\Component;

class SelectAddress extends Component
{

    public $province, $amphure, $district;


    public $provinces, $amphures, $districts;

    public function mount()
    {
        $this->provinces = Province::all();

        if ($this->province != '') {
            $this->amphures = Amphure::where('province_id', $this->province)->get();
        } else {
            $this->amphures = [];
            $this->districts = [];
        }

        if ($this->amphure != '') {
            $this->districts = District::where('amphure_id', $this->amphure)->get();
        } else {
            $this->districts = [];
        }
    }

    public function render()
    {
        return view('livewire.select-address');
    }


    public function updatedProvince()
    {
        $this->amphures = Amphure::where('province_id', $this->province)->get();
        $this->districts = [];
    }

    public function updatedAmphure()
    {
        $this->districts =  District::where('amphure_id', $this->amphure)->get();
    }
}
