<?php

use App\Http\Controllers\Auth\CompanyAuth;
use App\Http\Controllers\CompanyController;
use Illuminate\Support\Facades\Route;


Route::get('company-login', [CompanyAuth::class, 'login'])->name('company.login');
Route::post('company-login', [CompanyAuth::class, 'signIn'])->name('company.login.post');
Route::get('company-register', [CompanyAuth::class, 'register'])->name('company.register');
Route::post('/comapny-register', [CompanyAuth::class, 'signUp'])->name('company.register.post');

Route::middleware("auth:company")->group(function () {

    Route::resource('/company', CompanyController::class);
    Route::post('/logout', [CompanyAuth::class, 'logout'])->name('company.logout');

});


Route::get('learn-grid', function () {
    return view('learn-grid');
});
