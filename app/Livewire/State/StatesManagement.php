<?php

namespace App\Livewire\State;

use App\Services\QueryService\StateManageService;
use Auth;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class StatesManagement extends Component
{
    protected $stateQueryService;

    public $headers,$name,$id;

    public function boot(StateManageService $stateQueryService): void
    {
        $this->stateQueryService = $stateQueryService;
    }


    public function mount(){

       $this->headers = [
           ['key' => 'id', 'label' => '#'],
           ['key' => 'name', 'label' => 'State Name'],
       ];
    }

    public function delete($id){

        if(!Auth::user()->can('State.delete')){
            $this->dispatch('showErrorMessage', 'You dont have permission to access this page!');
            return;
        }

        $deleted = $this->stateQueryService->deleteState($id);
        if($deleted){
            $this->dispatch('showSuccessMessage', 'State deleted Successfully!');
        }else{
            $this->dispatch('showErrorMessage', 'State deleted failed!');
        }

    }

    public function render()
    {
        $states = $this->stateQueryService->getStates();
        return view('livewire.state.states-management')->with(['states' => $states]);
    }
}
