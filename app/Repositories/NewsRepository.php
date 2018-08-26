<?php

namespace App\Repositories;

use App\NewsItem;

class NewsRepository {

    /**
     * Get news items
     * 
     * @return array
     */
    public function index(){
        $query = NewsItem::getQuery();
        $count = $query->count();
        return [
            'count' => $count,
            'items' => $query->get()
        ];
    }

    /**
     * Create news item
     * 
     * @param array $fields
     * 
     * @return boolean
     */
    public function create(array $fields) {
        $model = new NewsItem();
        $model->fill($fields);
        return $model->save();
    }

    /**
     * Update news item
     * 
     * @param NewsItem $model
     * @param array $fields
     * 
     * @return boolean
     */
    public function update(NewsItem $model, array $fields) {
        $model->fill($fields);
        return $model->save();
    }

    /**
     * Delete news item
     * 
     * @param NewsItem $model
     * 
     * @return boolean
     */
    public function delete(NewsItem $model) {
        return $model->delete();
    }

}