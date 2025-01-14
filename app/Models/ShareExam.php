<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShareExam extends Model
{
    //
    protected $guarded = ['id'];

    public function examSchedule()
    {
        return $this->belongsTo(ExamSchedule::class);
    }

    public function class()
    {
        return $this->belongsTo(DepartementClass::class);
    }
}
