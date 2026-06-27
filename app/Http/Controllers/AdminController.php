<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Classes; // We will define this model
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'users' => User::count(),
            'teachers' => User::where('role', 'guru')->count(),
            'students' => User::where('role', 'siswa')->count(),
            'classes' => Classes::count(),
        ];

        $users = User::latest()->take(5)->get();
        $classes = Classes::with('teacher')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'users', 'classes'));
    }
}
