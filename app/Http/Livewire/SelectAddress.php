<?php

namespace App\Http\Livewire;

use App\Models\Amphure;
use App\Models\District;
use App\Models\Province;
use Livewire\Component;

class SelectAddress extends Component
{

    public $province, $amphure, $district, $address;

    public $provinces=[], $amphures=[], $districts=[];

    public function mount()
    {
        $this->provinces = Province::all();

        if ($this->province != '') {
            $this->amphures = Amphure::where('province_id', $this->province)->get();
        }

        if ($this->amphure != '') {
            $this->districts = District::where('amphure_id', $this->amphure)->get();
        }
    }

    public function render()
    {

        return view('livewire.select-address');
    }


    public function updatedProvince($value)
    {
        $this->province = $value;
        $this->amphures = Amphure::where('province_id', $this->province)->get();
        $this->districts = [];
    }

    public function updatedAmphure($value)
    {
        $this->amphure = $value;
        $this->districts =  District::where('amphure_id', $this->amphure)->get();
    }

    public function updatedDistrict($value)
    {
        $this->district = $value;
    }

    public function updatedAddress($value)
    {
        $this->address = $value;
    }
}
