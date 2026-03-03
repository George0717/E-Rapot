<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReportHistory extends Model
{
    protected $fillable = [
        'model_type',
        'model_id',
        'report_id',
        'user_id',
        'action',
        'before',
        'after'
    ];

    protected $casts = [
        'before' => 'array',
        'after' => 'array',
    ];

    public function report()
    {
        return $this->belongsTo(Report::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
