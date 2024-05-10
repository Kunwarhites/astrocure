<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Appointment extends Model
{
    use HasFactory;
    public function getTimeAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('H:i') : null;
    }
    protected $guarded = [];
    protected $fillable = ['user_id', 'user_name', 'user_rid', 'time', 'payment_data', 'date'];

}
