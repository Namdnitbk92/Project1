<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function user_course()
    {
        return $this->hasMany(UserCourse::class);
    }

    public function user_subjects()
    {
        return $this->belongsToMany(UserSubject::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }
}
