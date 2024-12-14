<?php

namespace App\Livewire\Exam;

use App\Services\QueryService\ExamcategoryQueryService;
use Auth;
use Livewire\Component;

class ExamCategoryCreate extends Component
{
    public $name;
    protected $queryService;

    public function boot(ExamcategoryQueryService $queryService)
    {
        $this->queryService = $queryService;
        if(!Auth::user()->can('ExamCategory.create')){
            abort(403, config('constants.no_permission_page_text'));
        }
    }
    public function render()
    {
        return view('livewire.exam.exam-category-create');
    }

    public function storeCategory()
    {
        $this->validate([
            'name' => 'required|unique:exam_categories,name'
        ]);

        $stored = $this->queryService->createCategory($this->name);
        if($stored){
            return redirect()->route('admin.exam-category')->with('successMessage','Category Created Successfully');
        }else{
            return redirect()->route('admin.exam-category')->with('errorMessage','Something Went Wrong');
        }
    }
}
