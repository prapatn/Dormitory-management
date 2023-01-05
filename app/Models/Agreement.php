<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agreement extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'id',
        'room_id',
        'user_id',
        'start_date',
        'end_date',
        'price_guarantee',
        'price_other',
        'image',
        'status',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
