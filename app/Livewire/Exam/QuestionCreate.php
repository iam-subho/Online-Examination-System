<?php

namespace App\Livewire\Exam;

use App\Services\QueryService\QuestionQueryService;
use Auth;
use Livewire\Component;

class QuestionCreate extends Component
{
    public $question_type,$difficulty_level;
    public $question_content,$points,$type,$difficulty;

    public $option_1, $option_2 ,$option_3,$option_4,$correct_answer;


    protected $questionQueryService;


    public function  boot(QuestionQueryService $questionQueryService)
    {
        $this->questionQueryService = $questionQueryService;
        if(!Auth::user()->can('Question.create')){
            abort(403, config('constants.no_permission_page_text'));
        }
    }



    public function mount()
    {

        $this->question_type = collect([
            ['id' => 'mcq', 'name' => 'Multiple Choice'],
            ['id' => 'true_false', 'name' => 'True/False']
        ])->pluck('name', 'id');

        $this->difficulty_level = collect([
            ['id' => 'easy', 'name' => 'Easy'],
            ['id' => 'medium', 'name' => 'Medium'],
            ['id' => 'hard', 'name' => 'Hard']
        ])->pluck('name', 'id');

    }

    public function updatedType($value)
    {
         if($value == 'true_false'){
             $this->option_1 = 'True';
             $this->option_2 = 'False';
         }else{
             $this->option_1 = '';
             $this->option_2 = '';
         }
    }

    public function render()
    {
        return view('livewire.exam.question-create');
    }

    public function goBack()
    {
        return redirect()->route('admin.question-management');
    }

    public function store()
    {
        $this->validateInputs();
        $data = [
            'question_content' => $this->question_content,
            'points' => $this->points,
            'type' => $this->type,
            'difficulty' => $this->difficulty,
            'answers' => array(
                $this->option_1,$this->option_2,$this->option_3,$this->option_4,
            ),
            'correct_answer' => $this->correct_answer
        ];

        $stored = $this->questionQueryService->createQuestion($data);
        if($stored){
            return redirect()->route('admin.question-bank')->with('successMessage', 'Question created successfully');
        }else{
            return $this->dispatch(config('constants.errorEvent'),"Something went wrong");
        }
    }

    public function validateInputs()
    {
        $this->validate([
            'question_content' => 'required',
            'points' => 'required|numeric',
            'type' => 'required|in:mcq,true_false',
            'difficulty' => 'required|in:easy,medium,hard',
            'correct_answer' => 'required',
            'option_1' => 'required',
            'option_2' => 'required',
            'option_3' => 'required_if:type,mcq',
            'option_4' => 'required_if:type,mcq',
        ],[
            'question_content.required' => 'Question content is required.',
            'points.required' => 'Points is required.',
            'type.required' => 'Question type is required.',
            'difficulty.required' => 'Difficulty is required.',
            'correct_answer.required' => 'Correct Answer is required.',
            'option_1.required' => 'Option 1 is required.',
            'option_2.required' => 'Option 2 is required.',
            'option_3.required' => 'Option 3 is required.',
            'option_4.required' => 'Option 4 is required.',

        ]);
    }

}
