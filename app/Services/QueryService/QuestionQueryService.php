<?php

namespace App\Services\QueryService;

use App\Models\Question;
use App\Models\QuestionOption;
use DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Str;

class QuestionQueryService
{
    public function __construct()
    {
    }

    public function getQuestions($perPage = 10,$searchText=null,$type=null):LengthAwarePaginator
    {
        $questions = Question::query();
        if($searchText){
            $questions = $questions->where('question_text', 'like', '%'.$searchText.'%')->orWhere('question_id', 'like', '%'.$searchText.'%');
        }
        if($type){
            $questions = $questions->where('question_type', $type);
        }
        return $questions->paginate($perPage);
    }

    public function getQuestionById($id): Question
    {
        $question = Question::query()->with('questionOptions')->findOrFail($id);
        return $question;
    }

    public function createQuestion($data)
    {

        DB::beginTransaction();
        try{
            $question = new Question();
            $question->question_uid  = Str::uuid()->toString();
            $question->question_text = $data['question_content'];
            $question->question_type = $data['type'];
            $question->difficulty    = $data['difficulty'];
            $question->points        = $data['points'];
            $question->save();

            foreach ($data['answers'] as $index => $answer) {
                if($answer){
                    $questionOption = new QuestionOption([
                        'option_uid'   => Str::uuid()->toString(),
                        'options_text' => $answer,
                        'is_correct'   => ($data['correct_answer'] == $index+1) ? true : false,
                    ]);
                    $question->questionOptions()->save($questionOption);
                }
            }
        }catch (\Exception $e){
            DB::rollBack();
            throw $e;
            return false;
        }
        DB::commit();
        return true;

    }

    public function deleteQuestion($id):bool
    {
        $question = Question::query()->findOrFail($id);
        return $question->delete()?true:false;
    }
}
