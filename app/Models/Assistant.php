<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assistant extends Model
{
    use HasFactory;

    protected $fillable = [
        'number_id',
        'cycle',
        'first_name',
        'paternal_surname',
        'maternal_surname',
        'career',
        'degree',
        'area',
        'gender',
        'user_type',
    ];
}
