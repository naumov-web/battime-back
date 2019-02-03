<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionAnswer extends Model
{
    protected $table = 'question_answers';

    protected $fillable = [
        'question_id',
        'name'
    ];

}