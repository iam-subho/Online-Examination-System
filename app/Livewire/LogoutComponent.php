<?php

namespace App\Livewire;

use Auth;
use Livewire\Component;

class LogoutComponent extends Component
{

    public function mount()
    {
        // Perform logout
        Auth::logout();

        // Invalidate the session
        request()->session()->invalidate();

        // Regenerate CSRF token
        request()->session()->regenerateToken();

        // Redirect to login page
        return redirect()->route('admin.login');
    }

    public function render()
    {
        return view('livewire.logout-component');
    }
}
