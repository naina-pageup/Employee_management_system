<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminMasterController;
use App\Http\Controllers\DepartmentMasterController;
use App\Http\Controllers\DesignationMasterController;
use App\Http\Controllers\EmployeeMasterController;
use App\Http\Controllers\SuperAdminMasterController;
use App\Http\Controllers\imageController;


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

Route::get('/index', function () {
    return view('welcome');
});
//**************************** Registration and login View And Action**********************************/
Route::get('/admin/registration',[AdminMasterController::class,'create']);
Route::post('/admin/registration',[AdminMasterController::class,'store']);
Route::get('/admin/login/index',[AdminMasterController::class,'loginView']);
Route::post('/admin/login',[AdminMasterController::class,'loginAction']);
Route::get('/upload', [imageController::class, 'create'])->name('images.create');
Route::post('/upload', [ImageController::class, 'store'])->name('images.store');
Route::get('/images', [ImageController::class, 'index']);
Route::post('/images/delete', [ImageController::class, 'delete'])->name('images.delete');
//****************************Super Admin And Admin Authenticate**********************************/
Route::group(['prefix' => 'admin','middleware' => ['web','isadmin']],function(){

Route::get('/dashboard',[AdminMasterController::class,'dashboard']);
Route::get('/registration/requests',[SuperAdminMasterController::class,'getAllRequest']);
Route::get('/request/action/{id}/{status}',[SuperAdminMasterController::class,'approvedOrRejectRequest']);
Route::get('/department',[DepartmentMasterController::class,'index']);
Route::get('/department/create',[DepartmentMasterController::class,'create']);
Route::post('/department/store',[DepartmentMasterController::class,'store']);
Route::get('/department/edit/{id}',[DepartmentMasterController::class,'edit']);
Route::post('/department/update/{id}',[DepartmentMasterController::class,'update']);
Route::post('/department/destroy/{id}',[DepartmentMasterController::class,'destroy']);
Route::get('/designation',[DesignationMasterController::class,'index']);
Route::get('/designation/create',[DesignationMasterController::class,'create']);
Route::post('/designation/store',[DesignationMasterController::class,'store']);
Route::get('/designation/edit/{id}',[DesignationMasterController::class,'edit']);
Route::post('/designation/update/{id}',[DesignationMasterController::class,'update']);
Route::post('/designation/destroy/{id}',[DesignationMasterController::class,'destroy']);
Route::get('/employee',[EmployeeMasterController::class,'index']);
Route::get('/employee/datatable',[EmployeeMasterController::class,'datatable']);
Route::get('/employee/pagination',[EmployeeMasterController::class,'pagination']);
Route::get('/employee/create',[EmployeeMasterController::class,'create']);
Route::post('/employee/store',[EmployeeMasterController::class,'store']);
Route::get('/employee/show/{id}',[EmployeeMasterController::class,'show']);
Route::get('/employee/edit/{id}',[EmployeeMasterController::class,'edit']);
Route::post('/employee/update/{id}',[EmployeeMasterController::class,'update']);
Route::post('/employee/destroy/{id}',[EmployeeMasterController::class,'destroy']);
Route::get('/employee/load_designation/{id}',[EmployeeMasterController::class,'getDesignation']);
Route::get('/logout',[AdminMasterController::class,'logout']);


});



