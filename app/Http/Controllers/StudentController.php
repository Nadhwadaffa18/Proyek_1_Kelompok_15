<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Material;
use App\Models\Assignment;
use App\Models\Submission;
use App\Models\Quiz;
use App\Models\QuizQuestion;
use App\Models\QuizAttempt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    // Dashboard Siswa
    public function index()
    {
        $student = auth()->user();
        $classes = $student->studentClasses()->with('teacher')->get();
        $classIds = $classes->pluck('id');

        $stats = [
            'classes' => $classes->count(),
            'assignments' => Assignment::whereIn('class_id', $classIds)->count(),
            'quizzes' => Quiz::whereIn('class_id', $classIds)->count(),
        ];

        // Pending assignments (deadline in future, not submitted yet)
        $submittedAssignmentIds = Submission::where('student_id', $student->id)->pluck('assignment_id');
        
        $pendingAssignments = Assignment::with('class')
            ->whereIn('class_id', $classIds)
            ->whereNotIn('id', $submittedAssignmentIds)
            ->where('deadline', '>', now())
            ->latest()
            ->take(5)
            ->get();

        return view('student.dashboard', compact('classes', 'stats', 'pendingAssignments'));
    }

    // Daftar Semua Kelas & Join
    public function classesIndex()
    {
        $student = auth()->user();
        $joinedClassIds = $student->studentClasses()->pluck('classes.id')->toArray();
        
        // Classes the student has NOT joined yet
        $availableClasses = Classes::with('teacher')
            ->whereNotIn('id', $joinedClassIds)
            ->get();

        $joinedClasses = Classes::with('teacher')
            ->whereIn('id', $joinedClassIds)
            ->get();

        return view('student.classes.index', compact('availableClasses', 'joinedClasses'));
    }

    // Join ke Kelas
    public function joinClass(Request $request)
    {
        $request->validate([
            'class_id' => 'required|exists:classes,id',
        ]);

        $student = auth()->user();
        
        // Attach student to class in pivot table (class_student)
        // using syncWithoutDetaching to prevent duplicates
        $student->studentClasses()->syncWithoutDetaching([$request->class_id]);

        return redirect()->route('student.classes.index')->with('success', 'Berhasil bergabung dengan kelas.');
    }

    // Tampilan Detail Kelas bagi Siswa
    public function classShow($classId)
    {
        $student = auth()->user();
        $class = Classes::with(['teacher', 'materials', 'assignments.submissions' => function($q) use ($student) {
                $q->where('student_id', $student->id);
            }, 'quizzes.attempts' => function($q) use ($student) {
                $q->where('student_id', $student->id);
            }])
            ->findOrFail($classId);

        // Authorization check - make sure student is enrolled in this class
        if (!$class->students()->where('users.id', $student->id)->exists()) {
            abort(403, 'Anda belum bergabung dengan kelas ini.');
        }

        return view('student.classes.show', compact('class'));
    }

    // Mengunduh Materi
    public function downloadMaterial($id)
    {
        $material = Material::findOrFail($id);
        
        // Ensure student is in this class
        $student = auth()->user();
        if (!$material->class->students()->where('users.id', $student->id)->exists()) {
            abort(403);
        }

        if (!$material->file_url || !Storage::disk('public')->exists($material->file_url)) {
            abort(404, 'Berkas tidak ditemukan.');
        }

        return Storage::disk('public')->download($material->file_url);
    }

    // Pengumpulan Tugas
    public function submitAssignment(Request $request, $assignmentId)
    {
        $request->validate([
            'file' => 'required|file|mimes:pdf,zip,rar,doc,docx,xls,xlsx,jpg,png|max:10240', // max 10MB
        ]);

        $assignment = Assignment::findOrFail($assignmentId);
        $student = auth()->user();

        // Check if student enrolled in this class
        if (!$assignment->class->students()->where('users.id', $student->id)->exists()) {
            abort(403);
        }

        // Check if deadline passed
        if (now()->isAfter($assignment->deadline)) {
            return redirect()->back()->with('error', 'Batas waktu pengumpulan tugas sudah habis.');
        }

        $fileUrl = $request->file('file')->store('submissions', 'public');

        // Create or update submission
        Submission::updateOrCreate(
            [
                'assignment_id' => $assignment->id,
                'student_id' => $student->id,
            ],
            [
                'file_url' => $fileUrl,
                'grade' => null, // reset grade if re-submitting
                'feedback' => null,
            ]
        );

        return redirect()->back()->with('success', 'Tugas berhasil dikumpulkan.');
    }

    // Pengerjaan Kuis (Form Soal)
    public function attemptQuiz($quizId)
    {
        $quiz = Quiz::with('questions')->findOrFail($quizId);
        $student = auth()->user();

        // Ensure student enrolled in class
        if (!$quiz->class->students()->where('users.id', $student->id)->exists()) {
            abort(403);
        }

        // Check if already attempted
        $existingAttempt = QuizAttempt::where('quiz_id', $quiz->id)->where('student_id', $student->id)->first();
        if ($existingAttempt) {
            return redirect()->route('student.classes.show', $quiz->class_id)->with('error', 'Anda sudah mengerjakan kuis ini.');
        }

        return view('student.quizzes.attempt', compact('quiz'));
    }

    // Penilaian Kuis Otomatis
    public function submitQuiz(Request $request, $quizId)
    {
        $quiz = Quiz::with('questions')->findOrFail($quizId);
        $student = auth()->user();

        // Check attempt
        $existingAttempt = QuizAttempt::where('quiz_id', $quiz->id)->where('student_id', $student->id)->first();
        if ($existingAttempt) {
            return redirect()->route('student.classes.show', $quiz->class_id)->with('error', 'Anda sudah mengerjakan kuis ini.');
        }

        $answers = $request->input('answers', []);
        $correctCount = 0;
        $totalQuestions = $quiz->questions->count();

        foreach ($quiz->questions as $question) {
            $submittedAnswer = $answers[$question->id] ?? null;
            if ($submittedAnswer === $question->answer) {
                $correctCount++;
            }
        }

        // Score scale 0-100
        $score = $totalQuestions > 0 ? round(($correctCount / $totalQuestions) * 100) : 0;

        QuizAttempt::create([
            'quiz_id' => $quiz->id,
            'student_id' => $student->id,
            'score' => $score,
        ]);

        return redirect()->route('student.classes.show', $quiz->class_id)->with('success', "Kuis berhasil dikirim! Nilai Anda: $score");
    }

    // Rekap Nilai Siswa
    public function gradesIndex()
    {
        $student = auth()->user();
        $classIds = $student->studentClasses()->pluck('classes.id');

        $submissions = Submission::with('assignment.class')
            ->where('student_id', $student->id)
            ->get();

        $quizAttempts = QuizAttempt::with('quiz.class')
            ->where('student_id', $student->id)
            ->get();

        return view('student.grades.index', compact('submissions', 'quizAttempts'));
    }
}
