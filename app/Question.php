<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'name',
        'is_enabled'
    ];

    public function answers()
    {
        return $this->hasMany(QuestionAnswer::class);
    }
}