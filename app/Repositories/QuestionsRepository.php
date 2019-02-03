<?php

namespace App\Repositories;

use App\Question;
use App\QuestionAnswer;

class QuestionsRepository {

    /**
     * Get question items
     * 
     * @return array
     */
    public function index()
    {
        $query = Question::getQuery();
        $count = $query->count();
        return [
            'count' => $count,
            'items' => $query->get()
        ];
    }

    /**
     * Load question item
     * 
     * @param Question $model
     * @return Question
     */
    public function item(Question $model)
    {
        $model->load('answers');
        return $model;
    }

    /**
     * Create question item
     * 
     * @access public
     * @param array $fields
     * @return Question
     */
    public function create(array $fields) 
    {
        $model = new Question();
        $model->fill($fields);
        $model->save();

        $this->rewriteAnswers($model, $fields['answers']??null);

        return $model;
    }

    /**
     * Update question item
     * 
     * @access public
     * @param array $fields
     * @return Question
     */
    public function update(Question $model, array $fields) 
    {
        $model->fill($fields);
        $model->save();

        $this->rewriteAnswers($model, $fields['answers']??null);

        return $model;
    }

    /**
     * Enable question
     * 
     * @access public
     * @return Question
     */
    public function enable(Question $model)
    {
        $model->fill(
            [
                'is_enabled' => true
            ]
        );
        $model->save();

        return $model;
    }

    /**
     * Disable question
     * 
     * @access public
     * @return Question
     */
    public function disable(Question $model)
    {
        $model->fill(
            [
                'is_enabled' => false
            ]
        );
        $model->save();

        return $model;
    }

    /**
     * Rewrite question answers
     * 
     * @access protected
     * @param Question $question
     * @param array $answers
     * @return void
     */
    protected function rewriteAnswers(Question $question, array $answers)
    {

        if (!$answers) {
            return;
        }

        $question->answers()->delete();

        $records = [];
        foreach($answers as $answer) {
            $records[] = [
                'question_id' => $question->id,
                'name' => $answer['name'],
            ];
        }

        QuestionAnswer::insert($records);

    }

    /**
     * Delete questions item
     * 
     * @access public
     * @param Question $model
     * @return boolean
     */
    public function delete(Question $model) 
    {
        return $model->delete();
    }

}