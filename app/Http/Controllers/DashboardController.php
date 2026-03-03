<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Report;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
   public function index(Request $request)
{
    $user = Auth::user();

    if (!$user) {
        abort(403);
    }

    $classId = $user->sm_class_id;

    // ======================
    // CARD DATA
    // ======================
    $totalStudents = Student::where('sm_class_id', $classId)->count();
    $totalReports  = Report::where('sm_class_id', $classId)->count();

    // ======================
    // FILTER
    // ======================
    $studentId = $request->get('student_id');
    $range     = $request->get('range', 'all');

    $query = Report::with('details')
        ->where('sm_class_id', $classId);

    if ($studentId) {
        $query->where('student_id', $studentId);
    }

    // ======================
    // FILTER RANGE (FORMAT YYYY-MM LANGSUNG)
    // ======================
    if ($range !== 'all') {

        $months = (int) $range;

        // Ambil bulan awal dalam format Y-m
        $startMonth = Carbon::now()
            ->subMonths($months - 1)
            ->format('Y-m');

        // Karena format database Y-m, bisa dibanding langsung
        $query->where('month', '>=', $startMonth);
    }

    $reports = $query
        ->orderBy('month')
        ->get();

    // ======================
    // MAP NILAI
    // ======================
    $map = [
        'A' => 5,
        'B' => 4,
        'C' => 3,
        'D' => 2,
        'E' => 1
    ];

    // ======================
    // OLAH DATA CHART
    // ======================
    $chartData = [];

    foreach ($reports->groupBy('month') as $month => $items) {

        $values = [];

        foreach ($items as $report) {
            foreach ($report->details as $detail) {

                $grade = strtoupper(trim($detail->grade));

                if (isset($map[$grade])) {
                    $values[] = $map[$grade];
                }
            }
        }

        if (count($values)) {
            $chartData[] = [
                'month'   => $month,
                'average' => round(array_sum($values) / count($values), 2)
            ];
        }
    }

    // SORT ULANG SUPAYA BULAN RAPI
    usort($chartData, function ($a, $b) {
        return strcmp($a['month'], $b['month']);
    });

    return view('dashboard', [
        'totalStudents' => $totalStudents,
        'totalReports'  => $totalReports,
        'students'      => Student::where('sm_class_id', $classId)->orderBy('name')->get(),
        'chartData'     => $chartData
    ]);
}
}