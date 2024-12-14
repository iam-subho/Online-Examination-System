<?php

namespace App\Services\QueryService;

use App\Models\ExamCategory;
use Illuminate\Pagination\LengthAwarePaginator;

class ExamcategoryQueryService
{
    public function __construct()
    {
    }

    public function getExamCategoryById($id): ExamCategory
    {
        return ExamCategory::find($id);
    }

    public function getExamcategoryList($perPage = 10):LengthAwarePaginator
    {
       $categoryList = ExamCategory::query();
       return $categoryList->paginate($perPage);
    }

    public function createCategory($name):bool
    {
        return ExamCategory::create(['name'=>$name])?true:false;
    }

    public function updateCategory($id,$name):bool
    {
        return ExamCategory::where('id', $id)->update(['name' => $name])?true:false;
    }

    public function deleteExamCategory($id):bool
    {
        return ExamCategory::where('id', $id)->delete()?true:false;
    }
}
