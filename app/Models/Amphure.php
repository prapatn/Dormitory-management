<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amphure extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'name_th',
        'name_en',
        'geography_id',
    ];

    public function district()
    {
        return $this->hasMany(District::class);
    }
    public function province()
    {
        return $this->belongsTo(Province::class);
    }
}
