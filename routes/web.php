<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

Route::get('/', [AuthController::class, 'loadLogin'])->name('loadLogin');
Route::post('/login', [AuthController::class, 'userLogin'])->name('userLogin');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'loadRegister'])->name('loadRegister');
Route::post('/register', [AuthController::class, 'studentRegister'])->name('studentRegister');

Route::group(['middleware' => ['web', 'checkAdmin']], function () {
    Route::get('/admin/dashboard', [AuthController::class, 'adminDashboard'])->name('adminDashboard');
    
    // Subject routes
    Route::post('/add-subject', [AdminController::class, 'addSubject'])->name('addSubject');
    Route::post('/edit-subject', [AdminController::class, 'editSubject'])->name('editSubject');
    Route::post('/delete-subject', [AdminController::class, 'deleteSubject'])->name('deleteSubject');
    
    // Exam routes
    Route::get('/admin/exam', [AdminController::class, 'examDashboard'])->name('examDashboard');
    Route::post('/add-exam', [AdminController::class, 'addExam'])->name('addExam');
    Route::get('/get-exam-detail/{id}', [AdminController::class, 'getExamDetail'])->name('getExamDetail');
    Route::post('/update-exam', [AdminController::class, 'updateExam'])->name('updateExam');
    Route::post('/delete-exam', [AdminController::class, 'deleteExam'])->name('deleteExam');
    
    // Students routing
    Route::get('/admin/students', [AdminController::class, 'studentsDashboard'])->name('studentsDashboard');
});

Route::group(['middleware' => ['web', 'checkStudent']], function () {
    Route::get('/dashboard', [AuthController::class, 'loadDashboard'])->name('loadDashboard');
});
