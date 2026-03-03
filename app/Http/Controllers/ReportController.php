<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\ReportDetail;
use App\Models\ReportHistory;
use App\Models\Student;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        $month = $request->month ?? now()->format('m');
        $year  = $request->year ?? now()->format('Y');

        $reports = Report::where('sm_class_id', $user->sm_class_id)
            ->where('month', $year . '-' . str_pad($month, 2, '0', STR_PAD_LEFT))
            ->with('student')
            ->latest()
            ->get();

        return view('reports.index', compact('reports', 'month', 'year'));
    }

    public function create(Request $request)
    {
        $user = auth()->user();

        $month = $request->month;

        $studentsQuery = Student::where('sm_class_id', $user->sm_class_id);

        if ($month) {
            $studentsQuery->whereDoesntHave('reports', function ($q) use ($month) {
                $q->where('month', $month);
            });
        }

        $students = $studentsQuery->get();

        return view('reports.create', compact('students', 'month'));
    }

    public function store(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'month'      => 'required',
            'subjects'   => 'required|array'
        ]);

        $status = $user->role === 'ketua_kelas' ? 'approved' : 'pending';

        $exists = Report::where('student_id', $validated['student_id'])
            ->where('month', $validated['month'])
            ->exists();

        if ($exists) {
            return back()->with('error', 'Raport bulan ini sudah dibuat.');
        }

        $report = Report::create([
            'student_id' => $validated['student_id'],
            'sm_class_id' => $user->sm_class_id,
            'month' => $validated['month'],
            'created_by' => $user->id,
            'status' => $status
        ]);

        foreach ($validated['subjects'] as $subject => $grade) {
            ReportDetail::create([
                'report_id' => $report->id,
                'subject' => $subject,
                'grade' => $grade
            ]);
        }

        // 🔥 Simpan history CREATE
        ReportHistory::create([
            'model_type' => 'Report',
            'model_id'   => $report->id,
            'report_id' => $report->id,
            'user_id' => $user->id,
            'action' => 'created',
            'after' => $report->load('details')->toArray()
        ]);

        return back()->with('success', 'Raport berhasil dibuat.');
    }

    public function update(Request $request, Report $report)
    {
        $user = $request->user();

        $validated = $request->validate([
            'subjects' => 'required|array'
        ]);

        $before = $report->load('details')->toArray();


        // update detail nilai
        foreach ($validated['subjects'] as $subject => $grade) {
            ReportDetail::updateOrCreate(
                [
                    'report_id' => $report->id,
                    'subject' => $subject
                ],
                [
                    'grade' => $grade
                ]
            );
        }

        $after = $report->fresh()->load('details')->toArray();

        // 🔥 Simpan history UPDATE
        ReportHistory::create([
            'model_type' => 'Report',
            'model_id'   => $report->id,
            'report_id' => $report->id,
            'user_id' => $user->id,
            'action' => 'created',
            'after' => $report->load('details')->toArray()
        ]);

        return back()->with('success', 'Raport berhasil diperbarui.');
    }

    public function approve(Report $report, Request $request)
    {
        $user = $request->user();

        if (auth()->user()->role !== 'ketua_kelas') {
            abort(403);
        }

        $before = $report->toArray();

        $report->update([
            'status' => 'approved'
        ]);

        // 🔥 Simpan history APPROVE
        ReportHistory::create([
            'model_type' => 'Report',
            'model_id'   => $report->id,
            'report_id' => $report->id,
            'user_id' => $user->id,
            'action' => 'created',
            'after' => $report->load('details')->toArray()
        ]);

        return back()->with('success', 'Raport berhasil divalidasi.');
    }

    public function reject(Report $report, Request $request)
    {
        $user = $request->user();

        if (auth()->user()->role !== 'ketua_kelas') {
            abort(403);
        }

        $before = $report->toArray();

        $report->update([
            'status' => 'rejected'
        ]);

        // 🔥 Simpan history REJECT
        ReportHistory::create([
            'model_type' => 'Report',
            'model_id'   => $report->id,
            'report_id' => $report->id,
            'user_id' => $user->id,
            'action' => 'created',
            'after' => $report->load('details')->toArray()
        ]);

        return back()->with('success', 'Raport ditolak.');
    }

    public function history(Request $request)
    {
        $user = $request->user();

        $user = auth()->user();

        $query = ReportHistory::with(['report.student', 'user'])
            ->whereHas('report', function ($q) use ($user) {
                $q->where('sm_class_id', $user->sm_class_id);
            });

        if ($user->role !== 'ketua_kelas') {
            $query->where('user_id', $user->id);
        }

        if ($request->filled('month')) {
            $query->whereHas('report', function ($q) use ($request) {
                $q->where('month', $request->month);
            });
        }

        $histories = $query->latest()->paginate(10);

        return view('reports.history', compact('histories'));
    }

    public function historyDetail(ReportHistory $history)
    {
        $history->load(['report.student', 'user']);
        return view('reports.history-detail', compact('history'));
    }

    public function show(Report $report)
    {
        $report->load('student', 'details');

        return view('reports.partials.detail', compact('report'));
    }



    public function pdf(Report $report)
    {
        Carbon::setLocale('id');

        // Ambil semua report dengan periode yang sama
        $reports = Report::where('sm_class_id', $report->sm_class_id)
            ->where('month', $report->month)
            ->with(['student', 'details'])
            ->get();

        if ($reports->isEmpty()) {
            return back()->with('error', 'Data tidak ditemukan.');
        }

        $subjects = $reports
            ->flatMap(fn($r) => $r->details->pluck('subject'))
            ->unique()
            ->values();

        $periode = Carbon::parse($report->month . '-01')
            ->translatedFormat('F Y');

        $pdf = Pdf::loadView('reports.pdf', compact('reports', 'subjects', 'periode'))
            ->setPaper('a4', 'landscape');

        return $pdf->download("Rekap-Raport-{$periode}.pdf");
    }

    public function destroy(Report $report)
    {
        $user = auth()->user();

        // Optional: batasi hanya pembuat atau ketua_kelas yang bisa hapus
        if ($user->role !== 'ketua_kelas' && $report->created_by !== $user->id) {
            abort(403);
        }

        // Ambil data sebelum dihapus
        $before = $report->load('details', 'student')->toArray();

        // Simpan history DELETE
        ReportHistory::create([
            'model_type' => 'Report',
            'model_id'   => $report->id,
            'report_id' => $report->id,
            'user_id' => $user->id,
            'action' => 'created',
            'after' => $report->load('details')->toArray()
        ]);

        // Hapus detail dulu (kalau tidak pakai cascade)
        $report->details()->delete();

        // Hapus report
        $report->delete();

        return response()->noContent();
    }

    public function restore($id, Request $request)
    {
        $user = $request->user();

        $report = Report::withTrashed()->findOrFail($id);

        $before = $report->toArray();

        $report->restore();

        ReportHistory::create([
            'model_type' => 'Report',
            'model_id'   => $report->id,
            'report_id' => $report->id,
            'user_id' => $user->id,
            'action' => 'created',
            'after' => $report->load('details')->toArray()
        ]);

        return back()->with('success', 'Raport berhasil direstore.');
    }
}
