<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'price',
        'floor',
    ];

    public function dormitory()
    {
        return $this->belongsTo(Dormitory::class);
    }
}
