<?php

namespace App\Policies;

use App\Models\Report;
use App\Models\User;

class ReportPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function update(User $user, Report $report)
    {
        return $user->role === 'ketua_kelas'
            && $user->school_class_id === $report->school_class_id;
    }
}
