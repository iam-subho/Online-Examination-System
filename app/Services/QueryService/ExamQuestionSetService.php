<?php

namespace App\Services\QueryService;

use App\Models\ExamQuestionMap;

class ExamQuestionSetService
{
    public function __construct()
    {
    }

    public function getExamQuestionSet($id,$paginate=10){

        $examQuestionSet = ExamQuestionMap::query();
        $examQuestionSet = $examQuestionSet->where('id',$id);
        $examQuestionSet = $examQuestionSet->with('question');
        $examQuestionSet = $examQuestionSet->paginate($paginate);
        return $examQuestionSet;
    }
}
