<?php

namespace App\Livewire\State;

use App\Facades\RBAC;
use App\Services\QueryService\StateQueryService;
use Auth;
use Livewire\Component;

class StateCreate extends Component
{

    public $name,$id;

    protected $stateQueryService;

    public function boot(StateQueryService $stateQueryService): void
    {
        $this->stateQueryService = $stateQueryService;
        if(!Auth::user()->can('State.create')) {
            abort(403, 'You dont have permission to access this page!');
        }
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
