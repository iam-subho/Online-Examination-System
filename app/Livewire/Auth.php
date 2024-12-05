<?php

namespace App\Livewire;

use Livewire\Component;

class Auth extends Component
{
    public $email,$password;
    public function render()
    {
        return view('livewire.auth');
    }
}
