<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{


    protected $fillable = [
        'week',
        'day_of_week',
        'time',
        'subject',
        'groups',
        'classroom_id'
    ];

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }
    public $timestamps = false;
}
