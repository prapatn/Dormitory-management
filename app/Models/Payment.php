<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'bill_id',
        "image",
    ];

    public function bill()
    {
        return $this->belongsTo(Bill::class, 'bill_id', 'id');
    }
}
