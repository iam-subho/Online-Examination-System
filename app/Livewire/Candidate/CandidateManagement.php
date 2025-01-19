<?php

namespace App\Livewire\Candidate;

use App\Services\QueryService\CandidateQueryService;
use Auth;
use Developermithu\Tallcraftui\Traits\WithTcToast;
use Livewire\Component;

class CandidateManagement extends Component
{

    use WithTcToast;

    protected $candidateQueryService;

    public function boot(CandidateQueryService  $candidateQueryService){
        if(!Auth::user()->can('Candidate.view')){
            abort(403, config('constants.no_permission_page_text'));
        }
        $this->candidateQueryService = $candidateQueryService;
    }
    public function render()
    {
        $allCandidates = $this->candidateQueryService->getAllCandidates();
        return view('livewire.candidate.candidate-management',compact('allCandidates'));
    }

    public function delete($id){
        $add = $this->candidateQueryService->deleteCandidate($id);
        if($add){
            $this->success('Candidate deleted successfully');
        }else{
            $this->error('Something went wrong');
        }
    }

    public function gotoCreate(){
        redirect(route('admin.candidate.create'));
    }
}
