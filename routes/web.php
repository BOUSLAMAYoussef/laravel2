<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [AuthController::class, 'loadRegister'])->name('loadRegister');
Route::post('/register', [AuthController::class, 'studentRegister'])->name('studentRegister');
Route::get('/login',function(){
    return redirect('/');

});
Route::get('/',[Authcontroller::class,'loadLogin']);
Route::post('/login',[Authcontroller::class,'userLogin'])->name('userLogin');
Route::get('/logout',[AuthController::class,'logout']);
Route::group(['middleware'=>['web','checkAdmin']],function(){
    Route::get('/admin/dashboard',[AuthController::class,'adminDashboard']);
    //subject route
    Route::post('/add-subject',[AdminController::class,'addSubject'])->name('addSubject');
    Route::post('/edit-subject',[AdminController::class,'editSubject'])->name('editSubject');
    Route::post('/delete-subject',[AdminController::class,'deleteSubject'])->name('deleteSubject');
    //exam route
    Route::get('/admin/exam',[AdminController::class,'examDashboard']);
    Route::post('/add-exam',[AdminController::class,'addExam'])->name('addExam');
});
Route::group(['middleware'=>['web','checkStudent']],function(){
    Route::get('/dashboard',[AuthController::class,'loadDashboard']);
    
});


