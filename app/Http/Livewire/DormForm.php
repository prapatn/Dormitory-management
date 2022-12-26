<?php

namespace App\Http\Livewire;

use App\Models\Amphure;
use App\Models\District;
use App\Models\Dormitory;
use App\Models\Province;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class DormForm extends Component
{
    use WithFileUploads;

    public $dorm_id;

    public $dbphoto, $photo;

    public $name, $phone, $electricity_per_unit, $water_per_unit, $water_pay_min, $water_min_unit;

    public $province, $amphure, $district, $address;

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

        if ($this->dorm_id == null) {
            $this->phone = Auth::user()->phone;
            $this->address = Auth::user()->address;
            $this->province = Auth::user()->province_id;
            $this->amphure = Auth::user()->amphure_id;
            $this->district = Auth::user()->district_id;
        } else {

            $model = Dormitory::where([
                'id' => $this->dorm_id,
                'user_id' => Auth::user()->id,
            ])->first();

            if (!$model) {
                abort(404);
            }

            $this->dbphoto = $model->image;
            $this->name = $model->name;
            $this->phone = $model->phone;
            $this->electricity_per_unit = $model->electricity_per_unit;
            $this->water_per_unit = $model->water_per_unit;
            $this->water_pay_min = $model->water_pay_min;
            $this->water_min_unit = $model->water_min_unit;
            $this->address =  $model->address;
            $this->province =  $model->province_id;
            $this->amphure =  $model->amphure_id;
            $this->district =  $model->district_id;
        }


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
