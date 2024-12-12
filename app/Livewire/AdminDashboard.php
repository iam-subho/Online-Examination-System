<?php

namespace App\Livewire;

use App\Facades\RBAC;
use Livewire\Component;

class AdminDashboard extends Component
{
    public function render()
    {
        RBAC::hasPermission('dashboard.view');

        return view('livewire.admin-dashboard');
    }
}
