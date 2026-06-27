<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'role'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function studentClasses()
    {
        return $this->belongsToMany(Classes::class, 'class_student', 'student_id', 'class_id')->withTimestamps();
    }

    public function teacherClasses()
    {
        return $this->hasMany(Classes::class, 'teacher_id');
    }

    public function appNotifications()
    {
        return $this->hasMany(AppNotification::class)->latest();
    }

    public function unreadNotificationsCount(): int
    {
        return $this->appNotifications()->whereNull('read_at')->count();
    }

    public function discussions()
    {
        return $this->hasMany(Discussion::class);
    }

    public function discussionReplies()
    {
        return $this->hasMany(DiscussionReply::class);
    }
}
