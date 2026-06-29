<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;

    protected $table = 'classes';

    protected $fillable = [
        'name',
        'teacher_id',
    ];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'class_student', 'class_id', 'student_id')->withTimestamps();
    }

    public function materials()
    {
        return $this->hasMany(Material::class, 'class_id');
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class, 'class_id');
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class, 'class_id');
    }

    public function discussions()
    {
        return $this->hasMany(Discussion::class, 'class_id')->orderByDesc('is_pinned')->latest();
    }

    public function schedules()
    {
        return $this->hasMany(ClassSchedule::class, 'class_id')
            ->orderByRaw("FIELD(day, 'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu')")
            ->orderBy('start_time');
    }
}
