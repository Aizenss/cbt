<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DepartementClass extends Model
{
    //
    protected $guarded = ['id'];

    public function departement()
    {
        return $this->belongsTo(Department::class);
    }
}
