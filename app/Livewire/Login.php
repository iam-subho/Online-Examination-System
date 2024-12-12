<?php

namespace App\Livewire;

use App\Models\Admin;
use App\Services\EmailPasswordLoginService;
use Livewire\Component;

class Login extends Component
{
    public $email,$password;
    protected $emailpasswordlogin;

    public function render()
    {
        return view('livewire.auth');
    }

    public function boot(EmailPasswordLoginService $emailpasswordlogin)
    {
        $this->emailpasswordlogin = $emailpasswordlogin;

    }

    public function login(){

        $this->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);

        $user = $this->emailpasswordlogin->login($this->email, $this->password);
        if($user instanceof Admin){
            session()->put('admin',$user);

            return redirect()->route('admin.dashboard')->with('successMessage','Login successfully');
        }

        /*session()->flash('message', [
            'type' => 'error', // success, error, info
            'title' => 'Login Failed!',
            'content' => 'Email or password is wrong!'
        ]);*/

        return redirect()->route('admin.login')->with('errorMessage', 'The email or password is incorrect.');
    }
}
