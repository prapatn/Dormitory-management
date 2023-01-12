<?php

namespace App\Models;

use Carbon\Carbon;
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
        'agreement_status'
    ];

    public function dormitory()
    {
        return $this->belongsTo(Dormitory::class, 'dorm_id', 'id');
    }

    public function agreement()
    {
        return $this->hasMany(Agreement::class);
    }

    public function agreementStatusCheck()
    {
        $agreements = $this->agreement;
        foreach ($agreements as $item) {
            if ($item->status == "รอยืนยัน") {
                return $item->status;
            } else if ($item->status == "ยอมรับ") {
                if (Carbon::now()->between($item->start_date, $item->end_date)) {
                    return "อยู่ในสัญญา";
                } else if (Carbon::now()->isBefore($item->end_date)) {
                    return "รอวันเริ่มสัญญา";
                }
            }
        }
        return "ห้องว่าง";
    }
}
