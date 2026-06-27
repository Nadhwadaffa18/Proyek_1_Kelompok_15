<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Material;
use App\Models\Assignment;
use App\Models\Submission;
use App\Models\Quiz;
use App\Models\QuizQuestion;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
{
    // Dashboard Guru
    public function index()
    {
        $teacherId = auth()->id();
        $classes = Classes::where('teacher_id', $teacherId)->get();
        $classIds = $classes->pluck('id');

        $stats = [
            'classes' => $classes->count(),
            'materials' => Material::whereIn('class_id', $classIds)->count(),
            'assignments' => Assignment::whereIn('class_id', $classIds)->count(),
            'quizzes' => Quiz::whereIn('class_id', $classIds)->count(),
        ];

        // Recent submissions for grading
        $recentSubmissions = Submission::with(['assignment.class', 'student'])
            ->whereHas('assignment', function ($query) use ($classIds) {
                $query->whereIn('class_id', $classIds);
            })
            ->whereNull('grade')
            ->latest()
            ->take(5)
            ->get();

        return view('teacher.dashboard', compact('classes', 'stats', 'recentSubmissions'));
    }

    // Detail Kelas
    public function classShow($classId)
    {
        $class = Classes::with(['students', 'materials', 'assignments', 'quizzes'])
            ->where('teacher_id', auth()->id())
            ->findOrFail($classId);

        return view('teacher.classes.show', compact('class'));
    }

    // ----------------------------------------------------
    // MANAJEMEN MATERI
    // ----------------------------------------------------
    public function materialsIndex()
    {
        $classes = Classes::where('teacher_id', auth()->id())->get();
        $classIds = $classes->pluck('id');
        $materials = Material::with('class')->whereIn('class_id', $classIds)->latest()->paginate(15);

        return view('teacher.materials.index', compact('materials'));
    }

    public function materialsCreate()
    {
        $classes = Classes::where('teacher_id', auth()->id())->get();
        return view('teacher.materials.create', compact('classes'));
    }

    public function materialsStore(Request $request)
    {
        $request->validate([
            'class_id' => 'required|exists:classes,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,mp4,avi,mov|max:20480', // max 20MB
        ]);

        $fileUrl = null;
        if ($request->hasFile('file')) {
            $fileUrl = $request->file('file')->store('materials', 'public');
        }

        Material::create([
            'class_id' => $request->class_id,
            'title'    => $request->title,
            'description' => $request->description,
            'file_url' => $fileUrl,
        ]);

        // Kirim notifikasi ke semua siswa di kelas
        $class = Classes::with('students')->find($request->class_id);
        if ($class) {
            NotificationService::notifyClassStudents(
                $class,
                'materi_baru',
                'Materi Baru Tersedia',
                "Guru {$class->teacher->name} mengunggah materi baru: \"{$request->title}\" di kelas {$class->name}.",
                route('student.classes.show', $class->id)
            );
        }

        return redirect()->route('teacher.materials.index')->with('success', 'Materi berhasil diunggah.');
    }

    public function materialsDestroy($id)
    {
        $material = Material::findOrFail($id);
        
        // Authorization check
        if ($material->class->teacher_id !== auth()->id()) {
            abort(403);
        }

        if ($material->file_url) {
            Storage::disk('public')->delete($material->file_url);
        }

        $material->delete();

        return redirect()->back()->with('success', 'Materi berhasil dihapus.');
    }

    // ----------------------------------------------------
    // MANAJEMEN TUGAS
    // ----------------------------------------------------
    public function assignmentsIndex()
    {
        $classes = Classes::where('teacher_id', auth()->id())->get();
        $classIds = $classes->pluck('id');
        $assignments = Assignment::with('class')->whereIn('class_id', $classIds)->latest()->paginate(15);

        return view('teacher.assignments.index', compact('assignments'));
    }

    public function assignmentsCreate()
    {
        $classes = Classes::where('teacher_id', auth()->id())->get();
        return view('teacher.assignments.create', compact('classes'));
    }

    public function assignmentsStore(Request $request)
    {
        $request->validate([
            'class_id' => 'required|exists:classes,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'deadline' => 'required|date',
        ]);

        Assignment::create([
            'class_id'    => $request->class_id,
            'title'       => $request->title,
            'description' => $request->description,
            'deadline'    => $request->deadline,
        ]);

        // Kirim notifikasi ke semua siswa di kelas
        $class = Classes::with(['students', 'teacher'])->find($request->class_id);
        if ($class) {
            NotificationService::notifyClassStudents(
                $class,
                'tugas_baru',
                'Tugas Baru',
                "Ada tugas baru: \"{$request->title}\" di kelas {$class->name}. Deadline: " . \Carbon\Carbon::parse($request->deadline)->format('d M Y H:i'),
                route('student.classes.show', $class->id)
            );
        }

        return redirect()->route('teacher.assignments.index')->with('success', 'Tugas berhasil dibuat.');
    }

    public function assignmentsShow($id)
    {
        $assignment = Assignment::with(['class', 'submissions.student'])->findOrFail($id);
        
        if ($assignment->class->teacher_id !== auth()->id()) {
            abort(403);
        }

        return view('teacher.assignments.show', compact('assignment'));
    }

    public function assignmentsDestroy($id)
    {
        $assignment = Assignment::findOrFail($id);

        if ($assignment->class->teacher_id !== auth()->id()) {
            abort(403);
        }

        $assignment->delete();

        return redirect()->route('teacher.assignments.index')->with('success', 'Tugas berhasil dihapus.');
    }

    public function gradeSubmission(Request $request, $submissionId)
    {
        $request->validate([
            'grade' => 'required|integer|min:0|max:100',
            'feedback' => 'nullable|string',
        ]);

        $submission = Submission::with('assignment.class')->findOrFail($submissionId);

        if ($submission->assignment->class->teacher_id !== auth()->id()) {
            abort(403);
        }

        $submission->update([
            'grade'    => $request->grade,
            'feedback' => $request->feedback,
        ]);

        // Kirim notifikasi ke siswa yang dinilai
        NotificationService::notifyUser(
            $submission->student_id,
            'nilai_keluar',
            'Nilai Tugas Keluar',
            "Tugas \"{$submission->assignment->title}\" Anda telah dinilai. Nilai: {$request->grade}/100.",
            route('student.grades')
        );

        return redirect()->back()->with('success', 'Nilai tugas berhasil disimpan.');
    }

    // ----------------------------------------------------
    // MANAJEMEN KUIS
    // ----------------------------------------------------
    public function quizzesIndex()
    {
        $classes = Classes::where('teacher_id', auth()->id())->get();
        $classIds = $classes->pluck('id');
        $quizzes = Quiz::with('class')->whereIn('class_id', $classIds)->latest()->paginate(15);

        return view('teacher.quizzes.index', compact('quizzes'));
    }

    public function quizzesCreate()
    {
        $classes = Classes::where('teacher_id', auth()->id())->get();
        return view('teacher.quizzes.create', compact('classes'));
    }

    public function quizzesStore(Request $request)
    {
        $request->validate([
            'class_id' => 'required|exists:classes,id',
            'title' => 'required|string|max:255',
            'duration_minutes' => 'required|integer|min:1|max:300',
        ]);

        Quiz::create([
            'class_id'         => $request->class_id,
            'title'            => $request->title,
            'duration_minutes' => $request->duration_minutes,
        ]);

        // Kirim notifikasi ke semua siswa di kelas
        $class = Classes::with(['students', 'teacher'])->find($request->class_id);
        if ($class) {
            NotificationService::notifyClassStudents(
                $class,
                'kuis_baru',
                'Kuis Baru Tersedia',
                "Ada kuis baru: \"{$request->title}\" di kelas {$class->name}. Durasi: {$request->duration_minutes} menit.",
                route('student.classes.show', $class->id)
            );
        }

        return redirect()->route('teacher.quizzes.index')->with('success', 'Kuis berhasil dibuat.');
    }

    public function quizzesShow($id)
    {
        $quiz = Quiz::with(['class', 'questions', 'attempts.student'])->findOrFail($id);

        if ($quiz->class->teacher_id !== auth()->id()) {
            abort(403);
        }

        return view('teacher.quizzes.show', compact('quiz'));
    }

    public function quizzesDestroy($id)
    {
        $quiz = Quiz::findOrFail($id);

        if ($quiz->class->teacher_id !== auth()->id()) {
            abort(403);
        }

        $quiz->delete();

        return redirect()->route('teacher.quizzes.index')->with('success', 'Kuis berhasil dihapus.');
    }

    // Soal Kuis
    public function createQuestion($quizId)
    {
        $quiz = Quiz::findOrFail($quizId);
        
        if ($quiz->class->teacher_id !== auth()->id()) {
            abort(403);
        }

        return view('teacher.quizzes.create-question', compact('quiz'));
    }

    public function storeQuestion(Request $request, $quizId)
    {
        $quiz = Quiz::findOrFail($quizId);

        if ($quiz->class->teacher_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'question' => 'required|string',
            'option_a' => 'required|string|max:255',
            'option_b' => 'required|string|max:255',
            'option_c' => 'required|string|max:255',
            'option_d' => 'required|string|max:255',
            'answer' => 'required|string|in:A,B,C,D',
        ]);

        QuizQuestion::create([
            'quiz_id' => $quiz->id,
            'question' => $request->question,
            'option_a' => $request->option_a,
            'option_b' => $request->option_b,
            'option_c' => $request->option_c,
            'option_d' => $request->option_d,
            'answer' => $request->answer,
        ]);

        return redirect()->route('teacher.quizzes.show', $quiz->id)->with('success', 'Soal berhasil ditambahkan.');
    }

    public function destroyQuestion($id)
    {
        $question = QuizQuestion::findOrFail($id);

        if ($question->quiz->class->teacher_id !== auth()->id()) {
            abort(403);
        }

        $question->delete();

        return redirect()->back()->with('success', 'Soal berhasil dihapus.');
    }
}
