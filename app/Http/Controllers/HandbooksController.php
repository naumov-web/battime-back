<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Category;
use App\BannerPlace;

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

    /**
     * Get all banner places
     * 
     * @access public
     * @return Collection
     */
    public function bannerPlaces()
    {
        return BannerPlace::all();
    }

}