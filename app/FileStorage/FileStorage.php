<?php 

namespace App\FileStorage;

use App\File;

class FileStorage {

    public function put($data, $owner) {

        $model = new File();

        $file_data = [
            'owner_id' => $owner->id,
            'owner_type' => get_class($owner),
            'name' => $data['name'],
            'mime' => $data['type'],
            'is_main' => $data['is_main'],
            'hash' => sha1(get_class($owner) . '_' . $owner->id . '_' . $data['content']),
        ];

        $path = storage_path('app/' . $file_data['hash']);

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        file_put_contents(
            $path . '/' . $file_data['name'],
            base64_decode($this->clearBase64($data['content']))
        );

        $file_data['size'] = filesize($path . '/' . $file_data['name']);

        $model->fill($file_data);
        $model->save();
        return $model;
    }

    /**
     * Remove base64 prefix
     * 
     * @access protected
     * @param string $base64
     * @return string
     */
    protected function clearBase64($base64) {
        $parts = explode(';base64,', $base64);
        if (isset($parts[1])) {
            return $parts[1];
        }
        return $base64;
    }

}