<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSubject extends Model
{
    public function user_course()
    {
        return $this->belongsTo(UserCourse::class);
    }
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
