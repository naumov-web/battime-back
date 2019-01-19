<?php

namespace App\Http\Controllers;

use AuthManager;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\BannersRepository;
use App\Http\Requests\UpdateBannerRequest;
use App\Banner;

class BannersController extends Controller
{
    /**
     * @var \App\Repositories\BannersRepository;
     */
    protected $repository;

    public function __construct(Request $request, BannersRepository $repository) {
        parent::__construct($request);
        $this->repository = $repository;
    }

    /**
     * Get banners list
     * 
     * @access public
     * @return array
     */
    public function index()
    {
        return $this->repository->index();
    }

    /**
     * Create banner item
     * 
     * @access public
     * @param UpdateBannerRequest $request
     * @return array
     */
    public function create(UpdateBannerRequest $request)
    {
        return [
            'success' => $this->repository->create($request->all())
        ];
    }

    /**
     * Load banner item
     * 
     * @access public
     * @param Banner $item
     * @return Banner
     */
    public function item(Banner $item)
    {
        return $this->repository->item($item);
    }

    /**
     * Update banner item
     * 
     * @access public
     * @param Banner $item
     * @param UpdateBannerRequest $request
     * @return array
     */
    public function update(Banner $item, UpdateBannerRequest $request) 
    {
        return [
            'success' => $this->repository->update(
                $item, 
                $request->all()
            )
        ];
    }

    /**
     * Delete banner
     * 
     * @access public
     * @param Banner $item
     * @return array
     */
    public function delete(Banner $item)
    {
        return [
            'success' => $this->repository->delete($item)
        ];
    }

}