<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BannerPlace extends Model
{
    /**
     * Fillable fields
     * 
     * @access protected
     * @var array
     */
    protected $fillable = [
        'id',
        'name'
    ];
}