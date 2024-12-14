<?php

namespace App\Services\QueryService;

use App\Models\Exam;
use Auth;
use Illuminate\Pagination\LengthAwarePaginator;

class ExamQueryService
{
    public function __construct()
    {
    }

    public function getExamsList($perPage = 10,$search=null):LengthAwarePaginator
    {
        $exam  = Exam::query();
        $exam = $exam->with('examCategory')->with('createdBy');
        if($search){
            $exam = $exam->where('title','like','%'.$search.'%');
        }
        $exam = $exam->paginate($perPage);
        return $exam;
    }

    public function getExamById($id):Exam
    {
        return Exam::query()->findOrFail($id);
    }

    public function deleteExamById($id):bool
    {
        return Exam::query()->findOrFail($id)->delete()?true:false;
    }

    public function updateOrCreateExam(array $validatedData, string $examUid, ?int $examId = null): bool
    {
        // Set additional fields
        $validatedData['total_score'] = 0;
        $validatedData['created_by'] = Auth::user()->id;
        $validatedData['exam_uid'] = $examUid;

        // Update or create the exam
        return Exam::updateOrCreate(['id' => $examId],$validatedData)?true:false;
    }

}
