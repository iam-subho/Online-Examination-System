<?php

namespace App\Services\QueryService;

use App\Models\District;
use Illuminate\Pagination\LengthAwarePaginator;

class DistrictQueryService
{
    public function __construct()
    {
    }

    public function getDistricts($paginate = 10 ,$state_id=null):LengthAwarePaginator
    {

        $districts = District::query();
        if($state_id){
            $districts = $districts->StateId($state_id);
        }

        return $districts->with('state')->paginate($paginate);
    }

    public function getDistrictById($id): District
    {
        return District::find($id);
    }

    public function create($data):bool
    {
        return District::create($data)?true:false;
    }

    public function update($id,$data):bool
    {
        $district = District::find($id);
        return $district->update($data)?true:false;
    }
}
