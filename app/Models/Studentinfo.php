<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Studentinfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'lrn', 'firstname', 'middlename', 'lastname', 'name_ext', 'birthdate',
        'sex',
        'elem_school', 'elem_school_citation', 'elem_school_id', 'elem_school_address', 'gen_ave'
    ];

    public function otherinfo()
    {
        return $this->hasOne(OtherStudentinfo::class, 'lrn', 'lrn');
    }

    public function student_record()
    {
        return $this->hasMany(Record::class, 'lrn', 'lrn');
    }

    public static function boot()
    {
        # code...
        parent::boot();
        self::deleting(function ($studentinfo) {
            $studentinfo->otherinfo()->each(function ($info) {
                $info->delete();
            });
        });
    }
}
