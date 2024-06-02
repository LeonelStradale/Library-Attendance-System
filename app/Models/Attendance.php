<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'assistant_id',
        'attendance_date',
        'entry_time',
        'departure_time',
        'total_hours',
        'locker',
    ];
}
