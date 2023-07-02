<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionSubject extends Model
{
    use HasFactory;
    protected $fillable = [
        'section_id',
        'subject_code',
        'subject',
        'default',
        'teacher_id'
    ];
}
