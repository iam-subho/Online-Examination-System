<?php

namespace App\Livewire\District;

use App\Services\QueryService\DistrictQueryService;
use App\Services\QueryService\StateQueryService;
use Auth;
use Livewire\Component;

class DistrictCreate extends Component
{

    public $name,$state_id;

    protected $districtsQueryService;
    protected  $stateQueryService;

    public function boot(DistrictQueryService $districtsQueryService , StateQueryService $stateQueryService){
        $this->districtsQueryService = $districtsQueryService;
        $this->stateQueryService = $stateQueryService;

        if(!Auth::user()->can('District.create')){
            abort(403, config('constants.no_permission_page_text'));
        }
    }

    public function render()
    {
        $states = $this->stateQueryService->getStates()->pluck('name','id');
        return view('livewire.district.district-create',compact('states'));
    }

    public function goBack(){
        return redirect()->route('admin.district-management');
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|unique:districts,name',
            'state_id' => 'required|numeric|exists:states,id'
        ]);

        $store = $this->districtsQueryService->create([
            'name' => $this->name,
            'state_id' => $this->state_id
        ]);
        if($store){
            return redirect()->route('admin.district-management')->with('successMessage','District Created Successfully');
        }else{
            return redirect()->route('admin.district-management')->with('errorMessage','Something Went Wrong');
        }

    }
}
