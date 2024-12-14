<?php

namespace App\Livewire\Exam;

use App\Services\QueryService\ExamcategoryQueryService;
use Auth;
use Livewire\Component;

class ExamCategoryEdit extends Component
{

    public $name,$id;
    protected $queryService;

    public function boot(ExamcategoryQueryService $queryService)
    {
        $this->queryService = $queryService;
        if(!Auth::user()->can('ExamCategory.edit')){
            abort(403, config('constants.no_permission_page_text'));
        }
    }

    public function mount($id)
    {
        $category = $this->queryService->getExamCategoryById($id);
        $this->name = $category->name;
        $this->id = $category->id;
    }

    public function render()
    {
        return view('livewire.exam.exam-category-edit');
    }

    public function updateCategory()
    {
        $this->validate([
            'name' => 'required|unique:exam_categories,name,'.$this->id
        ]);

        $stored = $this->queryService->updateCategory($this->id,$this->name);
        if($stored){
            return redirect()->route('admin.exam-category')->with('successMessage','Category updated Successfully');
        }else{
            return redirect()->route('admin.exam-category')->with('errorMessage','Something Went Wrong');
        }
    }

}
