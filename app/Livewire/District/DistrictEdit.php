<?php

namespace App\Livewire\District;

use App\Services\QueryService\DistrictQueryService;
use App\Services\QueryService\StateQueryService;
use Auth;
use Livewire\Component;

class DistrictEdit extends Component
{
    public $name,$state_id,$id,$states;

    protected $districtsQueryService;
    protected  $stateQueryService;

    public function boot(DistrictQueryService $districtsQueryService , StateQueryService $stateQueryService){
        $this->districtsQueryService = $districtsQueryService;
        $this->stateQueryService = $stateQueryService;

        if(!Auth::user()->can('District.edit')){
            abort(403, config('constants.no_permission_page_text'));
        }
    }

    public function mount($id)
    {
        $this->id = $id;
        $district = $this->districtsQueryService->getDistrictById($id);
        $this->states = $this->stateQueryService->getStates()->pluck('name','id');

        $this->name = $district->name;
        $this->state_id = $district->state_id;
    }

    public function render()
    {
        return view('livewire.district.district-edit');
    }

    public function goBack(){
        return redirect()->route('admin.district-management');
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|unique:districts,name,'.$this->id,
            'state_id' => 'required|numeric|exists:states,id'
        ]);

        $store = $this->districtsQueryService->update($this->id,[
            'name' => $this->name,
            'state_id' => $this->state_id
        ]);
        if($store){
            return redirect()->route('admin.district-management')->with('successMessage','District Updated Successfully');
        }else{
            return redirect()->route('admin.district-management')->with('errorMessage','Something Went Wrong');
        }

    }
}
