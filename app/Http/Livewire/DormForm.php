<?php

namespace App\Http\Livewire;

use App\Models\Amphure;
use App\Models\District;
use App\Models\Province;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class DormForm extends Component
{
    use WithFileUploads;

    public $photo;

    public $province, $amphure, $district;

    public $provinces = [], $amphures = [], $districts = [];

    public function render()
    {
        return view('livewire.dorm-form');
    }


    /**
     * Prepare the component.
     *
     * @return void
     */
    public function mount()
    {
        $this->province = Auth::user()->province_id;
        $this->amphure = Auth::user()->amphure_id;
        $this->district = Auth::user()->district_id;

        $this->provinces = Province::all();
        if ($this->province != '') {
            $this->amphures = Amphure::where('province_id', $this->province)->get();
        }
        if ($this->amphure != '') {
            $this->districts = District::where('amphure_id', $this->amphure)->get();
        }
    }


    public function updatedProvince($value)
    {
        $this->province = $value;
        $this->amphures = Amphure::where('province_id', $this->province)->get();
        $this->district = [];
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
