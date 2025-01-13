<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamSchedule extends Model
{
    //
    protected $guarded = ['id'];

    public function examBank()
    {
        return $this->belongsTo(ExamBank::class);
    }
}
