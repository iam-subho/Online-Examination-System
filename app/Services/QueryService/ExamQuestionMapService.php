<?php

namespace App\Services\QueryService;

use App\Models\ExamQuestionMap;
use App\Models\Question;
use DB;


class ExamQuestionMapService
{
    public function __construct()
    {
    }

    public function getQuestionsList($id){

        $results = DB::table('questions')
            ->select('questions.*', 'exam_question_maps.id as map_id')
            ->leftJoin('exam_question_maps', function ($join) use ($id) {
                $join->on('exam_question_maps.question_id', '=', 'questions.id')
                    ->where('exam_question_maps.exam_id', '=', $id)
                    ->where('exam_question_maps.deleted_at', '=', NULL);
            })
            ->paginate(10);  // Paginate the results with 10 items per page

        return $results;

    }

    public function addQuestion($exam_id, $question_id){

        $added = ExamQuestionMap::withTrashed()
            ->firstOrCreate(
                [
                    'question_id' => $question_id,
                    'exam_id' => $exam_id,
                ],
            );
        if($added->trashed()){
            $added->restore();
        }
        return $added;
    }

    public function deleteQuestion($exam_id,$question_id){
        //return DB::table('exam_question_maps')->where('question_id', $question_id)->where('exam_id',$exam_id)->delete();

        return ExamQuestionMap::where('exam_id',$exam_id)->where('question_id',$question_id)->delete();
    }


}
