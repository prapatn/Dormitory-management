<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bill extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'id',
        'agreement_id',
        'status',
        'pay_last_date',
        'electricity_unit',
        'water_unit',
        'electricity_unit_last',
        'water_unit_last',
        'pay_other',
        "image",
    ];

    protected $dates = ['pay_last_date'];

    public function agreement()
    {
        return $this->belongsTo(Agreement::class);
    }

    public function calElectricityUnit()
    {
        return $this->electricity_unit - $this->electricity_unit_last;
    }

    public function calElectricity()
    {
        return $this->calElectricityUnit() * $this->agreement->room->dormitory->electricity_per_unit;
    }

    public function calElectricityText()
    {

        return $this->calElectricityUnit() . " x " . $this->agreement->room->dormitory->electricity_per_unit . " = " .  $this->calElectricity();
    }

    public function calWaterUnit()
    {
        return $this->water_unit - $this->water_unit_last;
    }

    public function calWater()
    {
        return $this->calWaterUnit() * $this->agreement->room->dormitory->water_per_unit;
    }

    public function calWaterText()
    {
        return $this->calWaterUnit() . " x " . $this->agreement->room->dormitory->water_per_unit . " = " .  $this->calWater();
    }

    public function calAll()
    {
        return $this->calElectricity() + $this->calWater() + $this->pay_other;
    }
}
