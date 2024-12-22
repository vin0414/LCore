<?php

use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\HomeController;

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
Route::get('/',[HomeController::class,'home'])->name('/');
Route::get('/login',[HomeController::class,'home'])->name('/login');
//login and logout
Route::post('login',[CustomAuthController::class,'auth'])->name('login')->middleware('throttle:5,1');
Route::get('logout', [CustomAuthController::class, 'logout'])->name('logout');
//charts
Route::get('chart-data', [HomeController::class, 'getChartData'])->name('chart-data');
//settings
Route::get('fetch-department',[EmployeeController::class,'fetchDepartment'])->name('fetch-department');
//employee
Route::post('save-employee',[EmployeeController::class,'saveEmployee'])->name('save-employee');

Route::middleware('auth:user')->group(function () {
    //navigations
    Route::get('hr/overview',[HomeController::class,'overview'])->name('hr/overview');
    Route::get('hr/deductions',[HomeController::class,'deductions'])->name('hr/deductions');
    Route::get('hr/loans',[HomeController::class,'loans'])->name('hr/loans');
    Route::get('hr/employee',[HomeController::class,'employee'])->name('hr/employee');
    Route::get('hr/memo',[HomeController::class,'memo'])->name('hr/memo');
    Route::get('hr/account',[HomeController::class,'account'])->name('hr/account');
    //memo 
    Route::get('hr/memo/new',[HomeController::class,'newMemo'])->name('hr/memo/new');
    Route::get('hr/memo/edit/{memoID}',[HomeController::class,'editMemo'])->name('hr/memo/edit');
    Route::get('hr/memo/archive',[HomeController::class,'archive'])->name('hr/memo/archive');
    //recovery and settings
    Route::get('hr/recovery',[HomeController::class,'recovery'])->name('hr/recovery');
    Route::get('hr/settings',[HomeController::class,'settings'])->name('hr/settings');
    Route::get('hr/audit-trail',[HomeController::class,'auditTrail'])->name('hr/audit-trail');
    //payroll modules
    Route::get('hr/payroll',[HomeController::class,'payroll'])->name('hr/payroll');
    Route::get('hr/payroll/attendance',[HomeController::class,'payrollAttendance'])->name('hr/payroll/attendance');
    //employee modules
    Route::get('hr/employee/new',[HomeController::class,'newEmployee'])->name('hr/employee/new');
    Route::get('hr/employee/edit/{companyID}',[HomeController::class,'editEmployee'])->name('hr/employee/edit');
    Route::get('hr/employee/view/{companyID}',[HomeController::class,'viewEmployee'])->name('hr/employee/view');
    Route::get('hr/employee/credits',[HomeController::class,'creditsEmployee'])->name('hr/employee/credits');
    Route::get('hr/employee/movement',[HomeController::class,'employeeMovement'])->name('hr/employee/movement');
});

