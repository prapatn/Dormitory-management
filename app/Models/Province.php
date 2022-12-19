<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'name_th',
        'name_en',
        'geography_id',
    ];

    public function amphure()
    {
        return $this->hasMany(Amphure::class);
    }
}
