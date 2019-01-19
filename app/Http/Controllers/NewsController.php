<?php

namespace App\Http\Controllers;

use AuthManager;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\NewsRepository;
use App\Http\Requests\UpdateNewsItemRequest;
use App\NewsItem;

class NewsController extends Controller
{

    /**
     * @var \App\Repositories\NewsRepository;
     */
    protected $repository;

    public function __construct(Request $request, NewsRepository $repository) {
        parent::__construct($request);
        $this->repository = $repository;
    }

    /**
     * Get news list
     * 
     * @return array
     */
    public function index()
    {
        return $this->repository->index();
    }

    /**
     * Get one news item
     * 
     * @access public
     * @param NewsItem $item
     * @return NewsItem
     */
    public function item(NewsItem $item)
    {
        return $this->repository->item($item);
    }

    /**
     * Create news item
     * 
     * @access public
     * @param UpdateNewsItemRequest $request
     * @return array
     */
    public function create(UpdateNewsItemRequest $request)
    {
        return [
            'success' => $this->repository->create($request->all())
        ];
    }

    /**
     * Update news item
     * 
     * @param UpdateNewsItemRequest $request
     * @param NewsItem $item
     * 
     * @return array
     */
    public function update(UpdateNewsItemRequest $request, NewsItem $item)
    {
        return [
            'success' => $this->repository->update($item, $request->all())
        ];
    }

    /**
     * Delete news item
     * 
     * @access public
     * @param NewsItem $item
     * @return array
     */
    public function delete(NewsItem $item)
    {
        return [
            'success' => $this->repository->delete($item)
        ];
    }

}