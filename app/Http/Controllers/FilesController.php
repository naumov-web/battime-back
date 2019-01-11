<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\File;

class FilesController extends Controller {

    public function get(File $file, string $hash)
    {
        if ($file->hash != $hash) {
            abort(403);
        }

        if (!file_exists($file->path)) {
            abort(404);
        }

        header("Cache-Control: public");
        header("Content-Type: " . $file->mime);
        header("Content-Transfer-Encoding: Binary");
        header("Content-Length:".$file->size);
        header("Content-Disposition: attachment; filename=" . $file->name);
        readfile($file->path);

    }

}