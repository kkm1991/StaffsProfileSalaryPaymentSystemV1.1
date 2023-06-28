<?php

use App\Http\Controllers\educationController;
use App\Http\Controllers\positionController;
use App\Http\Controllers\reservationController;
use App\Http\Controllers\salaryController;
use App\Http\Controllers\WorkingDepController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaffProfileController;
 

 

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

 

Auth::routes();

Route::get('/', [StaffProfileController::class, 'index']);
Route::post('/{id}',[StaffProfileController::class,'index']);
Route::get('/profile/add',[StaffProfileController::class,'add']);
Route::post('/profile/add',[StaffProfileController::class,'create']);
Route::get('/profile/edit/{id}',[StaffProfileController::class,'editprofile']);
Route::post('/profile/edit/{id}',[StaffProfileController::class,'updateprofile']);
Route::get('/profile/delete/{id}',[StaffProfileController::class,'deleteprofile']);

Route::get('/status/change/{id}',[StaffProfileController::class,'statuschange']);

Route::get('/paymentlist',[StaffProfileController::class,'showstatuslist']);
Route::get('/deductandadd',[StaffProfileController::class,'deductionadding']);



Route::get('/reservation/{id}',[reservationController::class,'show']);
Route::post('/reservation/add',[reservationController::class,'create']);
Route::post('/reservation/update',[reservationController::class,'update']);
 



Route::post('/department/add',[WorkingDepController::class,'add']);
Route::post('/position/add',[positionController::class,'add']);
Route::post('/education/add',[educationController::class,'add']);

Route::get('/paysalary/{id}',[salaryController::class,'addsalary']);

Route::get('/salaries',[salaryController::class,'showsalary']);
Route::get('/salary/delete/{id}',[salaryController::class,'deletesalary']);