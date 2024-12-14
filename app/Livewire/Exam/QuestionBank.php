<?php

namespace App\Livewire\Exam;

use App\Services\QueryService\QuestionqueryService;
use Auth;
use Developermithu\Tallcraftui\Traits\WithTcToast;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class QuestionBank extends Component
{
    use WithPagination;
    use WithoutUrlPagination;
    use WithTcToast;

    public $perPage = 10;
    public $question_type,$diffculty_type;
    public $selectedQuestion;
    public bool $myModal = false;


    protected $questionBank;

    public function boot(QuestionqueryService $questionqueryService){
        $this->questionBank = $questionqueryService;

        if(!Auth::user()->can('Question.delete') && !Auth::user()->can('Question.view')){
            abort(403, config('constants.no_permission_page_text'));
        }
    }

    public function viewDetails($questionId)
    {
        $this->myModal = true;
        $this->selectedQuestion = $this->questionBank->getQuestionById($questionId);
        $this->dispatch('open-question-modal');
    }


    public function gotoCreate()
    {
        return redirect()->route('admin.question-create');
    }

    public function delete($id)
    {
        $delete = $this->questionBank->deleteQuestion($id);
        if($delete){
            $this->success('Question deleted successfully');
        }else{
           $this->error('Something went wrong');
        }
    }

    public function render()
    {
        $questions = $this->questionBank->getQuestions($this->perPage);
        return view('livewire.exam.question-bank',compact('questions'));
    }
}
