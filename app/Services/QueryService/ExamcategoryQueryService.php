<?php

namespace App\Services\QueryService;

use App\Models\ExamCategory;
use Illuminate\Database\Eloquent\Collection;
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

    public function getExamcategoryList($perPage=null):LengthAwarePaginator|Collection
    {
       $categoryList = ExamCategory::query();
       if($perPage) {
           $categoryList = $categoryList->paginate($perPage);
       }else{
           $categoryList = $categoryList->get();
       }
       return $categoryList;
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
