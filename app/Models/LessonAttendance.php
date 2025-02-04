<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LessonAttendance extends Model
{
    protected $table = 'lesson_attendance';

    protected $fillable = [
        'lesson_id',
        'student_email',
        'student_name',
        'student_group',
        'check_in_time'
    ];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}
