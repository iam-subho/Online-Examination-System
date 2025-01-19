<?php

namespace App\Services\QueryService;

use App\Models\Candidate;

class CandidateQueryService
{
    public function __construct()
    {
    }

    public function getAllCandidates(){

        $candidates = Candidate::query();
        return  $candidates->with('school')->with('district')->with('state')->paginate(10);
    }

    public function getCandidateById($id){
        return Candidate::query()->findOrFail($id);
    }

    public function deleteCandidate($id)
    {
        $candidate = Candidate::query()->findOrFail($id);
        return $candidate->delete();
    }
}
