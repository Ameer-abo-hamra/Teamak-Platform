<?php

use App\Http\Controllers\Auth\CompanyAuth;
use App\Http\Controllers\Auth\EmployeeAuth;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;


Route::get('company-login', [CompanyAuth::class, 'login'])->name('company.login');
Route::post('company-login', [CompanyAuth::class, 'signIn'])->name('company.login.post');
Route::get('company-register', [CompanyAuth::class, 'register'])->name('company.register');
Route::post('/comapny-register', [CompanyAuth::class, 'signUp'])->name('company.register.post');

Route::middleware("auth:company")->group(function () {

    Route::resource('/company', CompanyController::class);

    Route::get('company-employee', [CompanyController::class, "companyEmployee"])->name("company.employee.index");

    Route::post('/invitations', [InvitationController::class, 'store']);

    Route::post('/logout', [CompanyAuth::class, 'logout'])->name('company.logout');

    Route::get('company/employees/search', [CompanyController::class, 'search']);

    Route::get('company-projects', [CompanyController::class, 'companyProjects'])->name('company.projects.index');

    Route::get('company/projects/search', [CompanyController::class, 'searchProjects']);

    Route::get('company-tasks' , [CompanyController::class , 'tasks'])->name('company.tasks') ;

    Route::resource('task' , TaskController::class) ;

    Route::resource('project' , ProjectController::class) ;
});



Route::get('accept-invitation/{token}', [EmployeeController::class, 'acceptInvitation'])->name('accept');

Route::get('employee/login', [EmployeeAuth::class, 'login'])->name('employee.login');
Route::post('employee/register', [EmployeeAuth::class, 'signUp'])->name('employee.register.post');
Route::middleware('auth:employee')->group(function () {

    Route::resource('employee', EmployeeController::class);

});
