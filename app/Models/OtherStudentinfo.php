<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherStudentinfo extends Model
{
    use HasFactory;
    protected $fillable = [
        'lrn',
        'pept_rating',
        'pept_date_assestment',
        'als_rating',
        'als_name_address',
        'others'
    ];

    public function studentinfo()
    {
        return $this->belongsTo(Studentinfo::class, 'lrn', 'lrn');
    }
}
