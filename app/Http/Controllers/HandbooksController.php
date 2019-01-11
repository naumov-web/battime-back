<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Category;

class HandbooksController extends Controller {

    /**
     * Get all categories
     * 
     * @access public
     * @return Collection
     */
    public function categories()
    {
        return Category::all();
    }

}