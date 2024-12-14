<?php

namespace App\Livewire\Exam;

use App\Services\QueryService\QuestionQueryService;
use Auth;
use Livewire\Component;

class QuestionEdit extends Component
{
    public $question_type,$difficulty_level;
    public $id,$question_content,$points,$type,$difficulty;

    public $option_1, $option_2 ,$option_3,$option_4,$correct_answer;


    protected $questionQueryService;


    public function  boot(QuestionQueryService $questionQueryService)
    {
        $this->questionQueryService = $questionQueryService;
        if(!Auth::user()->can('Question.edit')){
            abort(403, config('constants.no_permission_page_text'));
        }
    }

    public function __set($name, $value)
    {
        // If the property name starts with 'option_', handle it
        if (strpos($name, 'option_') === 0) {
            $this->$name = $value;
        }
    }

    public function mount($id)
    {
        $question = $this->questionQueryService->getQuestionById($id);
        $this->id = $id;

        $this->question_type = collect([
            ['id' => 'mcq', 'name' => 'Multiple Choice'],
            ['id' => 'true_false', 'name' => 'True/False']
        ])->pluck('name', 'id');

        $this->difficulty_level = collect([
            ['id' => 'easy', 'name' => 'Easy'],
            ['id' => 'medium', 'name' => 'Medium'],
            ['id' => 'hard', 'name' => 'Hard']
        ])->pluck('name', 'id');

        $this->question_content = $question->question_text;
        $this->points = $question->points;
        $this->type = $question->question_type;
        $this->difficulty = $question->difficulty;


        $options = $question->questionOptions;  //my_dd($options,true);
        foreach ($options as $index => $option) {
           $ind = $index+1;
            $this->__set('option_'.$ind, $option->options_text);
           if($option->is_correct){
               $this->correct_answer = $ind;
           }
        }
    }

    public function render()
    {
        return view('livewire.exam.question-edit');
    }

    public function updateQuestion()
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

        $stored = $this->questionQueryService->updateQuestion($this->id,$data);
        if($stored){
            return redirect()->route('admin.question-bank')->with('successMessage', 'Question updated successfully');
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
