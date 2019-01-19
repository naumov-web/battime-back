<?php

namespace App\Repositories;

use App\Banner;
use App\FileStorage\FileStorage;

class BannersRepository {

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
     * Get all banners
     * 
     * @return array
     */
    public function index(){
        $query = Banner::query();
        $query->with('image')->orderBy('updated_at', 'desc');
        $count = $query->count();
        return [
            'count' => $count,
            'items' => $query->get()
        ];
    }

    /**
     * Create banner item
     * 
     * @access public
     * @param array $fields
     * @return boolean
     */
    public function create(array $fields) {
        $model = new Banner();
        $model->fill($fields);
        $model->save();

        if (isset($fields['new_file'])) {
            $this->file_storage->put($fields['new_file'], $model);
        }

        if (isset($fields['new_file_mobile'])) {
            $this->file_storage->put(array_merge(
                $fields['new_file_mobile'],
                [
                    'is_mobile' => true
                ]
            ), $model);
        }

        return true;
    }

    /**
     * Update banner item
     * 
     * @access public
     * @param Banner $model
     * @param array $fields
     * @return Banner
     */
    public function update(Banner $model, array $fields)
    {
        $model->fill($fields);
        $model->save();

        if (isset($fields['new_file'])) {

            if ($image = $model->image) {
                $image->delete();
            }

            $this->file_storage->put($fields['new_file'], $model);
        }

        if (isset($fields['new_file_mobile'])) {

            if ($image_mobile = $model->image_mobile) {
                $image_mobile->delete();
            }

            $this->file_storage->put(array_merge(
                $fields['new_file_mobile'],
                [
                    'is_mobile' => true
                ]
            ), $model);
        }

        return true;

    }

    /**
     * Get banner item
     * 
     * @access public
     * @param Banner $banner
     * @return Banner
     */
    public function item(Banner $banner)
    {
        return $banner->load('image', 'image_mobile');
    }

    /**
     * Delete banner
     * 
     * @access public
     * @param Banner $model
     * @return boolean
     */
    public function delete(Banner $model) {
        return $model->delete();
    }

}