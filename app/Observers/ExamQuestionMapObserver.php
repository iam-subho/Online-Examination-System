<?php

namespace App\Observers;

use App\Models\ExamQuestionMap;
use App\Models\Question;
use Cache;

class ExamQuestionMapObserver
{

    private function updateCacheForExam(int $examId, int $questionPointsAdjustment, bool $incrementQuestion): void
    {
        // Update the total number of questions in the cache
        if (Cache::get("exam_total_question" . $examId)) {
            $value = Cache::get("exam_total_question" . $examId);
            Cache::forget("exam_total_question" . $examId);
            Cache::forever("exam_total_question" . $examId, $incrementQuestion ? $value + 1 : max(0, $value - 1));
        }

        // Update the total points in the cache
        if (Cache::get("exam_total_points" . $examId)) {
            $value = Cache::get("exam_total_points" . $examId);
            Cache::forget("exam_total_points" . $examId);
            Cache::forever("exam_total_points" . $examId, $value + $questionPointsAdjustment);
        }
    }


    private function handleExamQuestionMap(ExamQuestionMap $examQuestionMap, int $pointsAdjustment, bool $incrementQuestion): void
    {

        $question = Question::select('points')->findOrFail($examQuestionMap->question_id);
        $this->updateCacheForExam($examQuestionMap->exam_id,$pointsAdjustment * $question->points,$incrementQuestion);
    }

    public function created(ExamQuestionMap $examQuestionMap): void
    {

        $this->handleExamQuestionMap($examQuestionMap, 1, true);
    }

    public function updated(ExamQuestionMap $examQuestionMap): void
    {
          $this->handleExamQuestionMap($examQuestionMap, 1, false);
    }

    public function deleted(ExamQuestionMap $examQuestionMap): void
    {
        $this->handleExamQuestionMap($examQuestionMap, -1, false);
    }

    public function restored(ExamQuestionMap $examQuestionMap): void
    {
        $this->handleExamQuestionMap($examQuestionMap, 1, true);
    }
}
