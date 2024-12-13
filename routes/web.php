<?php

use App\Http\Middleware\LivewireDynamicLayoutMiddleware;
use App\Livewire\AdminDashboard;
use App\Livewire\Login;
use App\Livewire\LogoutComponent;
use App\Livewire\State\StateCreate;
use App\Livewire\State\StateEdit;
use App\Livewire\State\StatesManagement;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('admin.login');
});

Route::group(['prefix'=>'admin','as'=>'admin.','middleware' => [LivewireDynamicLayoutMiddleware::class]],function(){

    Route::get('login', Login::class)->name('login');

    Route::group(['middleware'=>'auth:admin'],function(){

       Route::get('dashboard', AdminDashboard::class)->name('dashboard');
       Route::get('logout', LogoutComponent::class)->name('logout');


       Route::get('states-management', StatesManagement::class)->name('states-management');
       Route::get('states-create', StateCreate::class)->name('states-create');
       Route::get('states-edit/{id}', StateEdit::class)->name('states-edit');

    });
});


