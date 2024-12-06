<?php

use App\Http\Middleware\LivewireDynamicLayoutMiddleware;
use App\Livewire\AdminDashboard;
use App\Livewire\Login;
use App\Livewire\LogoutComponent;
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

    });
});


