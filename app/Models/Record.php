<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;
    protected $fillable = [
        'lrn',
        'sex',
        'age',
        'school',
        'school_id',
        'division',
        'district',
        'region',
        'classified_grade',
        'section',
        'section_id',
        'school_year',
        'adviser',
        'data',
        'remedial_date_from',
        'remedial_date_to',
        'remedials',
        'gen_ave',
        'default',
        'attendance',
        'observed_values'

    ];


    protected function data(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value)
        );
    }

    protected function remedials(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value)
        );
    }

    protected function attendance(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value)
        );
    }

    protected function observed_Values(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value)
        );
    }
}
