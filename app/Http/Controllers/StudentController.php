<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $students = Student::where('sm_class_id', $user->sm_class_id)
            ->orderBy('name')
            ->get();

        return view('students.index', compact('students', 'user'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        if ($user->role !== 'ketua_kelas') {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Student::create([
            'name' => $request->name,
            'sm_class_id' => $user->sm_class_id,
        ]);

        return back()->with('success', 'Murid berhasil ditambahkan');
    }

    public function update(Request $request, Student $student)
    {
        $user = Auth::user();

        if ($user->role !== 'ketua_kelas') abort(403);
        if ($student->sm_class_id !== $user->sm_class_id) abort(403);

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $student->update([
            'name' => $request->name,
        ]);

        return back()->with('success', 'Data murid diperbarui');
    }

    public function destroy(Student $student)
    {
        $user = Auth::user();

        if ($user->role !== 'ketua_kelas') abort(403);
        if ($student->sm_class_id !== $user->sm_class_id) abort(403);

        $student->delete();

        return back()->with('success', 'Murid dihapus');
    }
}