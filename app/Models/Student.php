<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
     use SoftDeletes;
    protected $fillable = [
        'name',
        'sm_class_id',
    ];



    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function histories()
    {
        return $this->hasMany(StudentHistory::class);
    }
}
