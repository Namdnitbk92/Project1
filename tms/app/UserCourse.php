<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserCourse extends Model
{

    protected $table = 'course_user';

    protected $fillable = [
        'user_id',
        'course_id',
        'progress',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function subject()
    {
        return $this->belongsToMany(Subject::class);
    }

    public function user_subjects()
    {
        return $this->hasMany(UserSubject::class);
    }
}
