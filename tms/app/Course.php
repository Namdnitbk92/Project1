<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'courses';

    protected $fillable = [
                            'name',
                            'description',
                            'start_date',
                            'end_date',
                            'image_url',
                            'status',
                          ];

}
