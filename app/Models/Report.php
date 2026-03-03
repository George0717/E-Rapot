<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends Model
{

 protected $fillable = [
        'student_id',
        'sm_class_id',
        'month',
        'created_by',
        'status'
    ];
    public function details()
    {
        return $this->hasMany(ReportDetail::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function histories()
    {
        return $this->hasMany(ReportHistory::class);
    }
}
