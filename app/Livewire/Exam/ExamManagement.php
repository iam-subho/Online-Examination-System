<?php

namespace App\Livewire\Exam;

use App\Models\Exam;
use App\Services\QueryService\ExamQueryService;
use Auth;
use Developermithu\Tallcraftui\Traits\WithTcToast;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class ExamManagement extends Component
{
    use WithPagination;
    use WithoutUrlPagination;
    use WithTcToast;
    public $perPage = 10;
    public $myModal = false;
    public $selectedExam = null;

    // Sorting and Search
    public $search = '';
    public $sortField = 'id';
    public $sortDirection = 'desc';

    protected $queryService;

    public function boot(ExamQueryService $queryService)
    {
        $this->queryService = $queryService;
        if(!Auth::user()->can('Exam.view') && !Auth::user()->can('Exam.delete')){
            abort(403, config('constants.no_permission_page_text'));
        }
    }

    public function render()
    {
        $exams = $this->queryService->getExamsList($this->perPage,$this->search);
        return view('livewire.exam.exam-management',compact('exams'));
    }

    public function delete($id)
    {
        if (!Auth::user()->can('Exam.delete')) {
            abort(403, config('constants.no_permission_action_text'));
        }

        $delete = $this->queryService->deleteExamById($id);
        if($delete){
            $this->render();
            return $this->success("Exam deleted successfully");
        }else{
            return $this->error("Something went wrong");
        }
    }

    public function viewDetails(Exam $exam)
    {
        $this->selectedExam = $exam;
        $this->myModal = true;
    }


    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

}
