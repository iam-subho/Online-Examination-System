<?php

namespace App\Livewire\Exam;

use App\Services\QueryService\ExamQuestionMapService;
use Auth;
use Developermithu\Tallcraftui\Traits\WithTcToast;
use Livewire\Component;
use Livewire\WithPagination;

class ExamQuestionMapForm extends Component
{
    use WithPagination;
    use WithTcToast;

    protected $paginationTheme = 'tailwind';
    public $id=null;

    protected $examQuestionMapService;

    public function boot(ExamQuestionMapService $examQuestionMapService): void
    {
        $this->examQuestionMapService = $examQuestionMapService;

        if(!Auth::user()->can('ExamQuestionMap.view')){
            abort(403, config('constants.no_permission_page_text'));
        }
    }


    public function mount($id){
        if(!$id){
            $this->error('Invalid Request');
        }
        $this->id = $id;
    }

    public function addQuestion($questionId){

        $add = $this->examQuestionMapService->addQuestion($this->id,$questionId);
        if($add){
            $this->success('Question added successfully');
        }else{
            $this->error('Something went wrong');
        }
    }

    public function deleteQuestion($questionId){

        $add = $this->examQuestionMapService->deleteQuestion($this->id,$questionId);
        if($add){
            $this->success('Question deleted successfully');
        }else{
            $this->error('Something went wrong');
        }
    }


    public function render()
    {
        $questionsList = $this->examQuestionMapService->getQuestionsList($this->id);
        return view('livewire.exam.exam-question-map-form',compact('questionsList'));
    }
}
