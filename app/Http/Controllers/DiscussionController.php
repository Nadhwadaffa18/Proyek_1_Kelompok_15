<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Discussion;
use App\Models\DiscussionReply;
use App\Services\NotificationService;
use Illuminate\Http\Request;

class DiscussionController extends Controller
{
    /**
     * Halaman daftar thread forum untuk satu kelas.
     * Bisa diakses guru (pemilik kelas) dan siswa (anggota kelas).
     */
    public function index(int $classId)
    {
        $class = $this->resolveClass($classId);
        $discussions = $class->discussions()->with(['user', 'replies'])->get();

        return view('forum.index', compact('class', 'discussions'));
    }

    /**
     * Form buat thread baru.
     */
    public function create(int $classId)
    {
        $class = $this->resolveClass($classId);
        return view('forum.create', compact('class'));
    }

    /**
     * Simpan thread baru ke database.
     */
    public function store(Request $request, int $classId)
    {
        $class = $this->resolveClass($classId);

        $request->validate([
            'title' => 'required|string|max:255',
            'body'  => 'required|string',
        ]);

        $discussion = Discussion::create([
            'class_id' => $class->id,
            'user_id'  => auth()->id(),
            'title'    => $request->title,
            'body'     => $request->body,
        ]);

        return redirect()->route('forum.show', [$classId, $discussion->id])
            ->with('success', 'Topik diskusi berhasil dibuat!');
    }

    /**
     * Detail thread + semua balasan.
     */
    public function show(int $classId, int $discussionId)
    {
        $class = $this->resolveClass($classId);
        $discussion = Discussion::with(['user', 'replies.user'])
            ->where('class_id', $class->id)
            ->findOrFail($discussionId);

        return view('forum.show', compact('class', 'discussion'));
    }

    /**
     * Hapus thread (guru bisa hapus semua, siswa hanya miliknya).
     */
    public function destroy(int $classId, int $discussionId)
    {
        $this->resolveClass($classId);
        $discussion = Discussion::findOrFail($discussionId);

        $user = auth()->user();
        if ($user->role !== 'guru' && $discussion->user_id !== $user->id) {
            abort(403);
        }

        $discussion->delete();

        return redirect()->route('forum.index', $classId)
            ->with('success', 'Topik diskusi dihapus.');
    }

    /**
     * Pin / Unpin thread (khusus guru).
     */
    public function togglePin(int $classId, int $discussionId)
    {
        $class = Classes::findOrFail($classId);

        if (auth()->user()->role !== 'guru' || $class->teacher_id !== auth()->id()) {
            abort(403);
        }

        $discussion = Discussion::where('class_id', $classId)->findOrFail($discussionId);
        $discussion->update(['is_pinned' => !$discussion->is_pinned]);

        return redirect()->back()->with('success', $discussion->is_pinned ? 'Thread di-pin.' : 'Thread di-unpin.');
    }

    /**
     * Simpan balasan (reply) pada sebuah thread.
     */
    public function storeReply(Request $request, int $classId, int $discussionId)
    {
        $this->resolveClass($classId);

        $request->validate([
            'body' => 'required|string',
        ]);

        $discussion = Discussion::where('class_id', $classId)->findOrFail($discussionId);

        $reply = DiscussionReply::create([
            'discussion_id' => $discussion->id,
            'user_id'       => auth()->id(),
            'body'          => $request->body,
        ]);

        // Kirim notifikasi ke pembuat thread (jika bukan diri sendiri)
        if ($discussion->user_id !== auth()->id()) {
            $replierName = auth()->user()->name;
            NotificationService::notifyUser(
                $discussion->user_id,
                'reply_forum',
                'Balasan Baru di Forum',
                "{$replierName} membalas topik \"{$discussion->title}\"",
                route('forum.show', [$classId, $discussion->id])
            );
        }

        return redirect()->route('forum.show', [$classId, $discussionId])
            ->with('success', 'Balasan berhasil dikirim!');
    }

    /**
     * Hapus balasan (guru bisa hapus semua, siswa hanya miliknya).
     */
    public function destroyReply(int $classId, int $discussionId, int $replyId)
    {
        $this->resolveClass($classId);
        $reply = DiscussionReply::findOrFail($replyId);

        $user = auth()->user();
        if ($user->role !== 'guru' && $reply->user_id !== $user->id) {
            abort(403);
        }

        $reply->delete();

        return redirect()->route('forum.show', [$classId, $discussionId])
            ->with('success', 'Balasan dihapus.');
    }

    /**
     * Resolve kelas dan verifikasi bahwa user berhak mengakses.
     */
    private function resolveClass(int $classId): Classes
    {
        $class = Classes::with('students')->findOrFail($classId);
        $user  = auth()->user();

        $hasAccess = match ($user->role) {
            'guru'  => $class->teacher_id === $user->id,
            'siswa' => $class->students->contains('id', $user->id),
            'admin' => true,
            default => false,
        };

        if (!$hasAccess) abort(403);

        return $class;
    }
}
