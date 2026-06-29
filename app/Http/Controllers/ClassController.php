<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\User;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function index()
    {
        $classes = Classes::with('teacher')->paginate(10);
        return view('admin.classes.index', compact('classes'));
    }

    public function create()
    {
        $teachers = User::where('role', 'guru')->get();
        return view('admin.classes.create', compact('teachers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'teacher_id' => ['required', 'exists:users,id'],
        ]);

        Classes::create([
            'name' => $request->name,
            'teacher_id' => $request->teacher_id,
        ]);

        return redirect()->route('admin.classes.index')->with('success', 'Kelas berhasil dibuat.');
    }

    public function edit(Classes $class)
    {
        $teachers = User::where('role', 'guru')->get();
        return view('admin.classes.edit', compact('class', 'teachers'));
    }

    public function update(Request $request, Classes $class)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'teacher_id' => ['required', 'exists:users,id'],
        ]);

        $class->update([
            'name' => $request->name,
            'teacher_id' => $request->teacher_id,
        ]);

        return redirect()->route('admin.classes.index')->with('success', 'Kelas berhasil diperbarui.');
    }

    public function destroy(Classes $class)
    {
        $class->delete();
        return redirect()->route('admin.classes.index')->with('success', 'Kelas berhasil dihapus.');
    }

    /**
     * Halaman kelola siswa per kelas.
     */
    public function manageStudents(Classes $class)
    {
        $class->load(['students', 'teacher']);

        // Siswa yang BELUM masuk kelas ini
        $availableStudents = User::where('role', 'siswa')
            ->whereNotIn('id', $class->students->pluck('id'))
            ->orderBy('name')
            ->get();

        return view('admin.classes.students', compact('class', 'availableStudents'));
    }

    /**
     * Tambahkan satu atau beberapa siswa ke kelas.
     */
    public function addStudent(Request $request, Classes $class)
    {
        $request->validate([
            'student_ids'   => 'required|array|min:1',
            'student_ids.*' => 'exists:users,id',
        ]);

        $class->students()->syncWithoutDetaching($request->student_ids);

        $count = count($request->student_ids);
        return redirect()->route('admin.classes.students', $class->id)
            ->with('success', "{$count} siswa berhasil ditambahkan ke kelas.");
    }

    /**
     * Keluarkan siswa dari kelas.
     */
    public function removeStudent(Classes $class, User $student)
    {
        $class->students()->detach($student->id);

        return redirect()->route('admin.classes.students', $class->id)
            ->with('success', "{$student->name} berhasil dikeluarkan dari kelas.");
    }
}

