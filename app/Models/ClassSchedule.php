<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassSchedule extends Model
{
    use HasFactory;

    protected $fillable = ['class_id', 'day', 'start_time', 'end_time', 'meeting_link'];

    // Urutan hari
    const DAY_ORDER = ['Senin' => 1, 'Selasa' => 2, 'Rabu' => 3, 'Kamis' => 4, 'Jumat' => 5, 'Sabtu' => 6, 'Minggu' => 7];

    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }

    public function getFormattedTimeAttribute(): string
    {
        return substr($this->start_time, 0, 5) . ' – ' . substr($this->end_time, 0, 5);
    }
}
