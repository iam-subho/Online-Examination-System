<?php

namespace App\Services\QueryService;

use App\Models\State;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Mary\View\Components\Stat;

class StateQueryService
{
    public function __construct()
    {
    }

    public function getStateById($id): State
    {

        return State::query()->findOrFail($id);
    }

    public function getStates(): array|\Illuminate\Database\Eloquent\Collection|\LaravelIdea\Helper\App\Models\_IH_State_C
    {

        return State::query()->get();
    }

    public function createState($name):bool
    {
        $data = array('name' => $name);
        return State::query()->create($data)?true:false;
    }

    public function updateState($id,$name):bool
    {
        $data = array('name' => $name);
        $state = $this->getStateById($id);
        $state->fill($data);
        $state->save();
        return $state?true:false;
    }

    public function deleteState($id):bool
    {
        $state = State::query()->findOrFail($id);
        return (bool)$state->delete();
    }
}
