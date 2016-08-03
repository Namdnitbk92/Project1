<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'courses';

    protected $fillable = [
        'id',
        'name',
        'description',
        'start_date',
        'end_date',
        'image_url',
        'status',
    ];

    protected $dates = ['start_date', 'end_date'];

    public function getColumn()
    {
        return $this->fillable;
    }

    public function course_subject()
    {
        return $this->hasMany(CourseSubject::class);
    }

}
