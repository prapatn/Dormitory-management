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
        'address',
        'province_id',
        'amphure_id',
        'district_id',
        'electricity_per_unit',
        'water_per_unit',
        'water_min_unit',
        'water_pay_min',
        'image',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
