<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\ClassSchedule;
use Illuminate\Http\Request;

class ClassScheduleController extends Controller
{
    private const DAYS = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];

    // ================================================================
    // ADMIN — kelola hari & jam saja
    // ================================================================

    public function index(int $classId)
    {
        $class = Classes::with(['schedules', 'teacher'])->findOrFail($classId);
        $days  = self::DAYS;
        return view('admin.schedules.index', compact('class', 'days'));
    }

    public function store(Request $request, int $classId)
    {
        Classes::findOrFail($classId);

        $request->validate([
            'day'        => 'required|in:' . implode(',', self::DAYS),
            'start_time' => 'required|date_format:H:i',
            'end_time'   => 'required|date_format:H:i|after:start_time',
        ]);

        ClassSchedule::create([
            'class_id'   => $classId,
            'day'        => $request->day,
            'start_time' => $request->start_time,
            'end_time'   => $request->end_time,
            // meeting_link dikosongkan — guru yang mengisi
        ]);

        return redirect()->route('admin.schedules.index', $classId)
            ->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function edit(int $classId, int $scheduleId)
    {
        $class    = Classes::findOrFail($classId);
        $schedule = ClassSchedule::where('class_id', $classId)->findOrFail($scheduleId);
        $days     = self::DAYS;
        return view('admin.schedules.edit', compact('class', 'schedule', 'days'));
    }

    public function update(Request $request, int $classId, int $scheduleId)
    {
        Classes::findOrFail($classId);
        $schedule = ClassSchedule::where('class_id', $classId)->findOrFail($scheduleId);

        $request->validate([
            'day'        => 'required|in:' . implode(',', self::DAYS),
            'start_time' => 'required|date_format:H:i',
            'end_time'   => 'required|date_format:H:i|after:start_time',
        ]);

        $schedule->update([
            'day'        => $request->day,
            'start_time' => $request->start_time,
            'end_time'   => $request->end_time,
            // meeting_link tidak diubah admin
        ]);

        return redirect()->route('admin.schedules.index', $classId)
            ->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroy(int $classId, int $scheduleId)
    {
        $schedule = ClassSchedule::where('class_id', $classId)->findOrFail($scheduleId);
        $schedule->delete();
        return redirect()->route('admin.schedules.index', $classId)
            ->with('success', 'Jadwal berhasil dihapus.');
    }

    // ================================================================
    // GURU — hanya update link GMeet per jadwal
    // ================================================================

    /**
     * Halaman guru kelola link meeting per jadwal.
     */
    public function teacherIndex(int $classId)
    {
        $class = Classes::with(['schedules', 'teacher'])
            ->where('teacher_id', auth()->id())
            ->findOrFail($classId);

        return view('teacher.schedules.index', compact('class'));
    }

    /**
     * Guru update link GMeet pada satu jadwal.
     */
    public function updateLink(Request $request, int $classId, int $scheduleId)
    {
        // Pastikan kelas milik guru yang login
        $class = Classes::where('teacher_id', auth()->id())->findOrFail($classId);

        $request->validate([
            'meeting_link' => 'nullable|url|max:500',
        ]);

        $schedule = ClassSchedule::where('class_id', $class->id)->findOrFail($scheduleId);
        $schedule->update(['meeting_link' => $request->meeting_link]);

        return redirect()->route('teacher.schedules.index', $classId)
            ->with('success', 'Link pertemuan berhasil diperbarui.');
    }
}
