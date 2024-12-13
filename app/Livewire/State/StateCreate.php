<?php

namespace App\Livewire\State;

use App\Facades\RBAC;
use App\Services\QueryService\StateManageService;
use Auth;
use Livewire\Component;

class StateCreate extends Component
{

    public $name,$id;

    protected $stateQueryService;

    public function boot(StateManageService $stateQueryService): void
    {
        $this->stateQueryService = $stateQueryService;
    }

    public function mount()
    {
        RBAC::hasPermission('State.create');
    }


    public function storeState()
    {
        $this->validate([
            'name' => 'required|string|max:255|unique:states,name,',
        ]);

        $store = $this->stateQueryService->createState($this->name);
        $this->name = "";
        if($store){
            $this->dispatch('showSuccessMessage', 'State added Successfully!');
        }else{
            $this->dispatch('showErrorMessage', 'State add failed!');
        }
        $this->goBack();
    }

    public function goBack()
    {
        return redirect()->route('admin.states-management');
    }


    public function render()
    {
        return view('livewire.state.state-create');
    }
}
