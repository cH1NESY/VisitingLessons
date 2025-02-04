<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Database;

class Classroom extends Model
{



    protected $fillable = ['number'];
    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

}
