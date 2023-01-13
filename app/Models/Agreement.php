<?php

namespace App\Models;

use Carbon\Carbon;
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
        "penalty_per_day",
    ];

    protected $dates = ['start_date', 'end_date'];

    public function bill()
    {
        return $this->hasMany(Bill::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function agreementShowStatus()
    {
        if ($this->status == "รอยืนยัน" || $this->status == "ปฏิเสธ") {
            return $this->status;
        } else if ($this->status == "ยอมรับ") {
            if (Carbon::now()->between($this->start_date, $this->end_date)) {
                return "อยู่ในสัญญา";
            } else if (Carbon::now()->isBefore($this->end_date)) {
                return "รอวันเริ่มสัญญา";
            } else {
                return "สิ้นสุดสัญญา";
            }
        }
    }
}
