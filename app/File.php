<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    /**
     * Fillable fields
     * 
     * @var array
     * @access protected
     */
    protected $fillable = [
        'owner_id',
        'owner_type',
        'name',
        'size',
        'mime',
        'is_main',
        'is_mobile',
        'hash'
    ];

    /**
     * Appendable attributes
     * 
     * @var array
     * @access protected
     */
    protected $appends = [
        'url'
    ];

    /**
     * Get calculated URL attribute
     * 
     * @access public
     * @return string
     */
    public function getUrlAttribute()
    {
        return request()->getSchemeAndHttpHost() . "/api/files/" . $this->id . '/' . $this->hash;
    }

    /**
     * Get real file path
     * 
     * @access public
     * @return string
     */
    public function getPathAttribute()
    {
        return storage_path('app/' . $this->hash . '/' . $this->name);
    }

}
