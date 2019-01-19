<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    /**
     * Fillable fields
     * 
     * @access protected
     * @var array
     */
    protected $fillable = [
        'name',
        'company_name',
        'link',
        'is_enabled',
        'place_id',
    ];

    /**
     * Get image relation
     *
     * @access public
     * @return Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function image()
    {
        return $this->morphOne(File::class, 'owner')->where('is_mobile', false);
    }

    /**
     * Get mobile image relation
     *
     * @access public
     * @return Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function image_mobile()
    {
        return $this->morphOne(File::class, 'owner')->where('is_mobile', true);
    }

}
