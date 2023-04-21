<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'teacher_id',
        'teacher_name',
        'section',
        'grade_level',
        'school_year'
    ];
}
