<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'assistant_id',
        'date',
        'entrance',
        'exit',
        'total_hours',
        'locker_number',
    ];

    public function assistant()
    {
        return $this->belongsTo(Assistant::class, 'assistant_id');
    }
}
