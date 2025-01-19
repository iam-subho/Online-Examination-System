<?php

namespace App\Livewire\Exam;

use App\Services\QueryService\ExamQuestionSetService;
use Auth;
use Developermithu\Tallcraftui\Traits\WithTcToast;
use Livewire\Component;
use Livewire\WithPagination;

class ExamQuestionSet extends Component
{
    use WithPagination;
    use WithTcToast;

    protected $paginationTheme = 'tailwind';
    public $id=null;

    protected $examquestionQueryService;

    public function boot(ExamQuestionSetService $examquestionSetService){
        $this->examquestionQueryService = $examquestionSetService;

        if(!Auth::user()->can('ExamQuestionSet.view')){
            abort(403, config('constants.no_permission_page_text'));
        }
    }

    public function render()
    {
        $questions_list = $this->examquestionQueryService->getExamQuestionSet($this->id);
        return view('livewire.exam.exam-question-set',compact('questions_list'));
    }

    public function gotoCreate(){
        return redirect()->route('admin.exam-question-map-create',['id'=>$this->id]);
    }


    public function mount($id){
        if(!$id){
           $this->error('Invalid Request');
        }
        $this->id = $id;
    }

}
