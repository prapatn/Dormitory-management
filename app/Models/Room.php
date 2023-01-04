<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'id',
        'dorm_id',
        'name',
        'price',
        'floor',
    ];

    public function dormitory()
    {
        return $this->belongsTo(Dormitory::class);
    }
}
