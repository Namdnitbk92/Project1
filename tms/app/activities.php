<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class activities extends Model
{
    protected $fillable = [
        'user_id',
        'target_id',
        'target_class',
        'action_type',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
