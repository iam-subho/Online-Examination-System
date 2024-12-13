<?php

namespace App\Livewire\State;

use App\Services\QueryService\StateManageService;
use Livewire\Component;

class StateEdit extends Component
{
    protected $stateQueryService;
    public $name,$id;

    public function boot(StateManageService $stateQueryService): void
    {
        $this->stateQueryService = $stateQueryService;
    }

    public function mount($id)
    {
        $selectedState = $this->stateQueryService->getStateById($id);
        $this->name = $selectedState->name;
        $this->id=$selectedState->id;
    }


    public function updateState()
    {
        $this->validate([
            'name' => 'required|string|max:255|unique:states,name,'.$this->id,
        ]);

        $update = $this->stateQueryService->updateState($this->id,$this->name);

        $this->name = "";
        $this->id = "";
        if($update){
            $this->dispatch('showSuccessMessage', 'State updated Successfully!');
        }else{
            $this->dispatch('showErrorMessage', 'State updated failed!');
        }
        $this->goBack();
    }


    public function goBack()
    {
        return redirect()->route('admin.states-management');
    }


    public function render()
    {
        return view('livewire.state.state-edit');
    }
}
