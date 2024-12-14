<?php

use App\Http\Middleware\LivewireDynamicLayoutMiddleware;
use App\Livewire\AdminDashboard;
use App\Livewire\District\DistrictCreate;
use App\Livewire\District\DistrictEdit;
use App\Livewire\District\DistrictManagement;
use App\Livewire\Exam\ExamCategory;
use App\Livewire\Exam\ExamCategoryCreate;
use App\Livewire\Exam\ExamCategoryEdit;
use App\Livewire\Exam\ExamForm;
use App\Livewire\Exam\ExamManagement;
use App\Livewire\Exam\QuestionBank;
use App\Livewire\Exam\QuestionCreate;
use App\Livewire\Exam\QuestionEdit;
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

       Route::get('exam-management', ExamManagement::class)->name('exam-management');
       Route::get('exam-create', ExamForm::class)->name('exam-create');
       Route::get('exam-edit/{id}', ExamForm::class)->name('exam-edit');

       Route::get('exam-category', ExamCategory::class)->name('exam-category');
       Route::get('examcategory-create', ExamCategoryCreate::class)->name('examcategory-create');
       Route::get('examcategory-edit/{id}', ExamCategoryEdit::class)->name('examcategory-edit');

       Route::get('question-bank', QuestionBank::class)->name('question-bank');
       Route::get('question-create', QuestionCreate::class)->name('question-create');
       Route::get('question-edit/{id}', QuestionEdit::class)->name('question-edit');


       Route::get('states-management', StatesManagement::class)->name('states-management');
       Route::get('states-create', StateCreate::class)->name('states-create');
       Route::get('states-edit/{id}', StateEdit::class)->name('states-edit');

       Route::get('district-management', DistrictManagement::class)->name('district-management');
       Route::get('district-create', DistrictCreate::class)->name('district-create');
       Route::get('district-edit/{id}', DistrictEdit::class)->name('district-edit');

    });
});


