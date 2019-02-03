<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\QuestionsRepository;
use App\Question;
use App\Http\Requests\UpdateQuestionRequest;

class QuestionsController extends Controller
{
    /**
     * @var \App\Repositories\QuestionsRepository;
     */
    protected $repository;

    public function __construct(Request $request, QuestionsRepository $repository) {
        parent::__construct($request);
        $this->repository = $repository;
    }

    /**
     * Get questions list
     * 
     * @return array
     */
    public function index()
    {
        return $this->repository->index();
    }

    /**
     * Get one question item
     * 
     * @access public
     * @param Questions $item
     * @return Questions
     */
    public function item(Question $item)
    {
        return $this->repository->item($item);
    }

    /**
     * Create questions item
     * 
     * @access public
     * @param UpdateQuestionRequest $request
     * @return array
     */
    public function create(UpdateQuestionRequest $request)
    {
        return [
            'success' => $this->repository->create($request->all())
        ];
    }

    /**
     * Update questions item
     * 
     * @access public
     * @param UpdateQuestionRequest $request
     * @param Question $item
     * @return array
     */
    public function update(UpdateQuestionRequest $request, Question $item)
    {
        return [
            'success' => $this->repository->update($item, $request->all())
        ];
    }

    /**
     * Enable questions item
     * 
     * @access public
     * @param Question $item
     * @return array
     */
    public function enable(Question $item)
    {
        return [
            'success' => $this->repository->enable($item)
        ];
    }

    /**
     * Disable questions item
     * 
     * @access public
     * @param Question $item
     * @return array
     */
    public function disable(Question $item)
    {
        return [
            'success' => $this->repository->disable($item)
        ];
    }

    /**
     * Delete question item
     * 
     * @access public
     * @param Question $item
     * @return array
     */
    public function delete(Question $item)
    {
        return [
            'success' => $this->repository->delete($item)
        ];
    }
    
}