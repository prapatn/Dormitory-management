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
        'penalty_per_day',
        'electricity_unit',
        'pay_other',
    ];

    protected $dates = ['pay_last_date'];

    public function agreement()
    {
        return $this->belongsTo(Agreement::class);
    }
}
