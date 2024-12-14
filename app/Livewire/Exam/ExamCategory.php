<?php

namespace App\Livewire\Exam;

use App\Services\QueryService\ExamcategoryQueryService;
use Auth;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class ExamCategory extends Component
{
    use WithPagination;
    use WithoutUrlPagination;
    public $perPage = 10;
    protected $queryService;

    public function boot(ExamcategoryQueryService $queryService)
    {
        $this->queryService = $queryService;
        if(!Auth::user()->can('ExamCategory.view') && !Auth::user()->can('ExamCategory.delete')){
            abort(403, config('constants.no_permission_page_text'));
        }
    }

    public function render()
    {
        $categories = $this->queryService->getExamcategoryList($this->perPage);
        return view('livewire.exam.exam-category',compact('categories'));
    }

    public function delete($id)
    {
        $deleted = $this->queryService->deleteExamCategory($id);
    }
}
