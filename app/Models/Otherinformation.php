<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Otherinformation extends Model
{
    use HasFactory;
    protected $fillable = [
        'school_name',
        'school_id',
        'district',
        'division',
        'region'
    ];
}
