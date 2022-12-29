<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dormitory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'address',
        'province_id',
        'amphure_id',
        'district_id',
        'electricity_per_unit',
        'water_per_unit',
        'water_min_unit',
        'water_pay_min',
        'image',
        'payment_number',
        'bank_name',
        'payment_image'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFullAddress()
    {
        $province = Province::find($this->province_id)->name_th;
        $amphure = Amphure::find($this->amphure_id)->name_th;
        $district = District::find($this->district_id);
        if (!$district) {
            $fullAddress = $this->address .  "," . $amphure . "," . $province;
        } else {
            $fullAddress = $this->address . "," . $district->name_th . "," . $amphure . "," . $province . " " .  $district->zip_code;
        }

        return $fullAddress;
    }

    public function room()
    {
        return $this->hasMany(Room::class);
    }

    // public function province()
    // {
    //     return $this->belongsTo(Province::class);
    // }

    // public function amphure()
    // {
    //     return $this->belongsTo(Amphure::class);
    // }

    // public function district()
    // {
    //     return $this->belongsTo(District::class);
    // }
}
