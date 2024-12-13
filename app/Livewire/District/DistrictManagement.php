<?php

namespace App\Livewire\District;

use App\Services\QueryService\DistrictQueryService;
use Auth;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class DistrictManagement extends Component
{
    use WithPagination;
    use WithoutUrlPagination;
    public $perPage = 10;
    protected $districtsQueryService;
    protected $paginationTheme = 'tailwind';


    public function boot(DistrictQueryService $districtsQueryService){
        $this->districtsQueryService = $districtsQueryService;
        if(!Auth::user()->can('District.delete') && !Auth::user()->can('District.view')){
            abort(403, config('constants.no_permission_page_text'));
        }
    }

    public function render()
    {
        $districts = $this->districtsQueryService->getDistricts($this->perPage);
        return view('livewire.district.district-management',compact('districts'));
    }

    public function delete($id){

        if(Auth::user()->can('District.view')){
            $this->dispatch(config('constants.errorEvent'),config('constants.no_permission_action_text'));
            return;
        }

        $delete = $this->districtsQueryService->deleteDistrict($id);
        if($delete){
          $this->dispatch(config('constants.successEvent'),"District deleted successfully");
        }else{
            $this->dispatch(config('constants.errorEvent'),"Failed to delete district");
        }
    }
}
