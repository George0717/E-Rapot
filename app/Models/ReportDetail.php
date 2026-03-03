<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReportDetail extends Model
{
    
        public $timestamps = false;

    protected $fillable = [
        'report_id',
        'subject',
        'grade'
    ];

    public function report()
    {
        return $this->belongsTo(Report::class);
    }
}
