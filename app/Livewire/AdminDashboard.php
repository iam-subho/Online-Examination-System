<?php

namespace App\Livewire;

use App\Facades\RBAC;
use App\Models\District;
use App\Models\School;
use App\Models\State;
use Livewire\Component;




class AdminDashboard extends Component
{
    public $state,$district,$school,$students;
    public $questions,$exam,$competition;



    public function mount(){
        $this->state = State::all()->count();
        $this->district = District::all()->count();
        $this->school = School::all()->count();
    }


    public function render()
    {
        RBAC::hasPermission('dashboard.view');


        return view('livewire.admin-dashboard');
    }
}
