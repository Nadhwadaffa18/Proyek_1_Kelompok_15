<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_id',
        'title',
        'description',
        'file_url',
    ];

    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }
}
