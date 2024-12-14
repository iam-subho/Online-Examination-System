<?php

namespace App\Livewire\Exam;

use App\Models\Exam;
use App\Models\ExamCategory;
use App\Services\QueryService\ExamcategoryQueryService;
use App\Services\QueryService\ExamQueryService;
use Carbon\Carbon;
use Developermithu\Tallcraftui\Traits\WithTcToast;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ExamForm extends Component
{
    use WithTcToast;


    public $id;
    public $exam_uid;
    public $title;
    public $description;
    public $exam_date;
    public $exam_expire_date;
    public $duration;
    public $total_question;
    public $passing_percentage;
    public $total_score;
    public $status = 'draft';
    public $exam_category_id;
    public $time_limit_per_question;
    public $result_published = false;


    public $exam_categories = [];
    public $status_options = [];


    protected $rules = [
        'title' => 'required|max:255',
        'description' => 'nullable',
        'exam_date' => 'required|date|after:today',
        'exam_expire_date' => 'required|date|after:today',
        'duration' => 'required|integer|min:0|max:300',
        'total_question' => 'required|integer|min:1|max:100',
        'passing_percentage' => 'required|numeric|between:0,100',
        'exam_category_id' => 'required|exists:exam_categories,id',
        'status' => 'required|in:draft,scheduled,active,completed',
        'time_limit_per_question' => 'nullable|integer|min:0|max:60',
    ];

    protected $queryService,$categoryQueryService;

    public function boot(ExamQueryService $queryService, ExamCategoryQueryService $categoryQueryService)
    {
        $this->queryService = $queryService;
        $this->categoryQueryService = $categoryQueryService;
        if(!Auth::user()->can('Exam.create') && !Auth::user()->can('Exam.update')){
            abort(403, config('constants.no_permission_page_text'));
        }
    }

    public function mount($id = null)
    {

        $this->exam_categories = $this->categoryQueryService->getExamcategoryList()->pluck('name', 'id');

        $this->status_options = collect([
            ['id'=>'active','name'=>'Active'],
            ['id'=>'inactive','name'=>'Inactive'],
            ['id'=>'completed','name'=>'Completed'],
        ])->pluck('name', 'id');


        if ($id) {
            $exam = $this->queryService->getExamById($id);

            if (!Carbon::now()->isBefore(Carbon::parse($exam->exam_date))) {
                return redirect()->route('admin.exam-management')->with('errorMessage', 'You cannot edit this exam');
            }

            $this->fillFormFields($exam);
        } else {
            $this->exam_uid = Str::random(36);
        }
    }

    private function fillFormFields(Exam $exam)
    {
        $this->fill($exam->only([
            'exam_uid', 'title', 'description', 'exam_date','exam_expire_date', 'duration',
            'total_question', 'passing_percentage', 'total_score',
            'status', 'exam_category_id', 'time_limit_per_question',
            'result_published'
        ]));
    }

    public function render()
    {
        return view('livewire.exam.exam-create');
    }

    public function store()
    {

        if(!Auth::user()->can('Exam.create')){
            abort(403, config('constants.no_permission_action_text'));
        }

        if($this->id && !Auth::user()->can('Exam.update')){
            abort(403, config('constants.no_permission_action_text'));
        }

        $validatedData = $this->validate();

        $create = $this->queryService->updateOrCreateExam($validatedData,$this->exam_uid,$this->id);

        if($create){
            return redirect()->route('admin.exam-management')->with('successMessage', 'Exam ' .($this->id ? 'updated' : 'created') . ' successfully.');
        }else{
            return $this->error("Something went wrong");
        }

    }

}
