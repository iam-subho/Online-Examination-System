<?php

namespace App\Livewire;

use App\Facades\RBAC;
use App\Models\District;
use App\Models\School;
use App\Models\State;
use Illuminate\Http\Request;
use Livewire\Component;
use Session;


class AdminDashboard extends Component
{
    public $state,$district,$school,$students;
    public $questions,$exam,$competition;



    public function mount(Request $request){

        //$currentGuard = Session::get('current_active_guard');
        //my_dd($currentGuard,true);


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
