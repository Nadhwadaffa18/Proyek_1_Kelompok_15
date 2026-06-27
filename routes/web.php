<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\DiscussionController;
use App\Http\Controllers\NotificationController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $role = auth()->user()->role;
    if ($role === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif ($role === 'guru') {
        return redirect()->route('teacher.dashboard');
    } else {
        return redirect()->route('student.dashboard');
    }
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Grup Rute Admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::resource('users', UserController::class);
    Route::resource('classes', ClassController::class);
});

// Grup Rute Guru
Route::middleware(['auth', 'role:guru'])->prefix('teacher')->name('teacher.')->group(function () {
    Route::get('/dashboard', [TeacherController::class, 'index'])->name('dashboard');
    Route::get('/classes/{class}', [TeacherController::class, 'classShow'])->name('classes.show');

    // Materi
    Route::get('/materials', [TeacherController::class, 'materialsIndex'])->name('materials.index');
    Route::get('/materials/create', [TeacherController::class, 'materialsCreate'])->name('materials.create');
    Route::post('/materials', [TeacherController::class, 'materialsStore'])->name('materials.store');
    Route::delete('/materials/{material}', [TeacherController::class, 'materialsDestroy'])->name('materials.destroy');

    // Tugas & Penilaian
    Route::get('/assignments', [TeacherController::class, 'assignmentsIndex'])->name('assignments.index');
    Route::get('/assignments/create', [TeacherController::class, 'assignmentsCreate'])->name('assignments.create');
    Route::post('/assignments', [TeacherController::class, 'assignmentsStore'])->name('assignments.store');
    Route::get('/assignments/{assignment}', [TeacherController::class, 'assignmentsShow'])->name('assignments.show');
    Route::delete('/assignments/{assignment}', [TeacherController::class, 'assignmentsDestroy'])->name('assignments.destroy');
    Route::post('/submissions/{submission}/grade', [TeacherController::class, 'gradeSubmission'])->name('submissions.grade');

    // Kuis
    Route::get('/quizzes', [TeacherController::class, 'quizzesIndex'])->name('quizzes.index');
    Route::get('/quizzes/create', [TeacherController::class, 'quizzesCreate'])->name('quizzes.create');
    Route::post('/quizzes', [TeacherController::class, 'quizzesStore'])->name('quizzes.store');
    Route::get('/quizzes/{quiz}', [TeacherController::class, 'quizzesShow'])->name('quizzes.show');
    Route::delete('/quizzes/{quiz}', [TeacherController::class, 'quizzesDestroy'])->name('quizzes.destroy');
    Route::get('/quizzes/{quiz}/questions/create', [TeacherController::class, 'createQuestion'])->name('quizzes.questions.create');
    Route::post('/quizzes/{quiz}/questions', [TeacherController::class, 'storeQuestion'])->name('quizzes.questions.store');
    Route::delete('/questions/{question}', [TeacherController::class, 'destroyQuestion'])->name('quizzes.questions.destroy');
});

// Grup Rute Siswa
Route::middleware(['auth', 'role:siswa'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', [StudentController::class, 'index'])->name('dashboard');
    
    // Daftar Kelas & Join
    Route::get('/classes', [StudentController::class, 'classesIndex'])->name('classes.index');
    Route::post('/classes/join', [StudentController::class, 'joinClass'])->name('classes.join');
    Route::get('/classes/{class}', [StudentController::class, 'classShow'])->name('classes.show');

    // Materi (Download)
    Route::get('/materials/{material}/download', [StudentController::class, 'downloadMaterial'])->name('materials.download');

    // Pengumpulan Tugas
    Route::post('/assignments/{assignment}/submit', [StudentController::class, 'submitAssignment'])->name('assignments.submit');

    // Pengerjaan Kuis
    Route::get('/quizzes/{quiz}/attempt', [StudentController::class, 'attemptQuiz'])->name('quizzes.attempt');
    Route::post('/quizzes/{quiz}/submit', [StudentController::class, 'submitQuiz'])->name('quizzes.submit');

    // Rekap Nilai
    Route::get('/grades', [StudentController::class, 'gradesIndex'])->name('grades');
});

// Forum Diskusi — diakses guru & siswa (auth saja, validasi di controller)
Route::middleware('auth')->prefix('forum')->name('forum.')->group(function () {
    Route::get('/{classId}', [DiscussionController::class, 'index'])->name('index');
    Route::get('/{classId}/create', [DiscussionController::class, 'create'])->name('create');
    Route::post('/{classId}', [DiscussionController::class, 'store'])->name('store');
    Route::get('/{classId}/{discussionId}', [DiscussionController::class, 'show'])->name('show');
    Route::delete('/{classId}/{discussionId}', [DiscussionController::class, 'destroy'])->name('destroy');
    Route::patch('/{classId}/{discussionId}/pin', [DiscussionController::class, 'togglePin'])->name('pin');
    // Reply
    Route::post('/{classId}/{discussionId}/reply', [DiscussionController::class, 'storeReply'])->name('reply.store');
    Route::delete('/{classId}/{discussionId}/reply/{replyId}', [DiscussionController::class, 'destroyReply'])->name('reply.destroy');
});

// Notifikasi
Route::middleware('auth')->prefix('notifications')->name('notifications.')->group(function () {
    Route::get('/', [NotificationController::class, 'index'])->name('index');
    Route::get('/{id}/read', [NotificationController::class, 'read'])->name('read');
    Route::post('/mark-all-read', [NotificationController::class, 'markAllRead'])->name('markAllRead');
});

require __DIR__.'/auth.php';
