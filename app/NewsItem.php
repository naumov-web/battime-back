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
        'visible',
        'is_main',
        'is_day_main'
    ];

    /**
     * Category ids attribute accessor
     * 
     * @access public
     * @return array
     */
    public function getCategoryIdsAttribute()
    {
        $ids = [];
        foreach($this->categories as $category) {
            $ids[] = $category->id;
        }
        return $ids;
    }

    /**
     * Get images relation
     *
     * @access public
     * @return Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function files()
    {
        return $this->morphMany(File::class, 'owner');
    }

    /**
     * Get categories relation
     *
     * @access public
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(
            Category::class,
            'news_categories',
            'news_item_id',
            'category_id'
        );
    }

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
