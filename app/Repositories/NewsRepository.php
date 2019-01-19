<?php

namespace App\Repositories;

use App\NewsItem;
use App\FileStorage\FileStorage;

class NewsRepository {

    /**
     * File storage instance
     * 
     * @access protected
     * @var FileStorage instance
     */
    protected $file_storage;

    /**
     * Repository Constructor
     * 
     * @param FileStorage $file_storage
     */
    public function __construct(FileStorage $file_storage)
    {
        $this->file_storage = $file_storage;
    }

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
     * Get one news item
     * 
     * @access public
     * @return NewsItem
     */
    public function item(NewsItem $item)
    {
        $item->load('files')->setAppends(['category_ids']);
        return $item;
    }

    /**
     * Create news item
     * 
     * @access public
     * @param array $fields
     * @return boolean
     */
    public function create(array $fields) {
        $model = new NewsItem();
        $model->fill($fields);
        $model->save();

        if (isset($fields['new_files'])) {
            foreach($fields['new_files'] as $f) {
                $this->file_storage->put($f, $model);
            }
        }

        $this->syncCategories($model, $fields);

        return true;
    }

    /**
     * Update news item
     * 
     * @access public
     * @param NewsItem $model
     * @param array $fields
     * @return boolean
     */
    public function update(NewsItem $model, array $fields) {
        $model->fill($fields);

        $file_ids = [];

        foreach($fields['files'] as $f) {
            $file_ids[] = $f['id'];
        }

        foreach($model->files as $file) {
            if (!in_array($file->id, $file_ids)) {
                $file->delete();
            }
        }

        $model->files()->update([
            'is_main' => false
        ]);

        if (isset($fields['new_files'])) {
            foreach($fields['new_files'] as $f) {
                $this->file_storage->put($f, $model);
            }
        }

        foreach($fields['files'] as $file) {
            if ($file['is_main'] ?? null) {
                $model->files()
                    ->where('id', $file['id'])
                    ->update(
                        [
                            'is_main' => true
                        ]
                    );
                break;
            }
        }

        $this->syncCategories($model, $fields);

        return $model->save();
    }

    /**
     * Sync news item categories
     * 
     * @access protected
     * @return true
     */
    protected function syncCategories($model, $fields)
    {
        $model->categories()->sync($fields['category_ids'] ?? []);
        return true;
    }

    /**
     * Delete news item
     * 
     * @access public
     * @param NewsItem $model
     * @return boolean
     */
    public function delete(NewsItem $model) {
        return $model->delete();
    }

}