<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsItem extends Model
{

    protected $table = 'news';
    
    protected $fillable = [
        'name',
        'annotation',
        'text',
        'visible'
    ];

    public static function boot()
    {
        parent::boot();

        self::saving(function($model)
        {
            $user = \Auth::user();
            $model->lastEditorId = $user->id;
        });       
    }  

}
