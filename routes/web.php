<?php

use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MemoController;
use App\Http\Controllers\SettingController;

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
//Employee module
///ajax
Route::get('fetch-department',[EmployeeController::class,'fetchDepartment'])->name('fetch-department');
Route::get('fetch-employee-history',[EmployeeController::class,'fetchEmployeeWorkHistory'])->name('fetch-employee-history');
Route::post('save-employee-history',[EmployeeController::class,'addEmployeeWorkHistory'])->name('save-employee-history');
Route::post('remove-employee-history',[EmployeeController::class,'removeEmployeeHistory'])->name('remove-employee-history');
Route::get('edit-history',[EmployeeController::class,'editHistory'])->name('edit-history');
Route::post('update-history',[EmployeeController::class,'updateHistory'])->name('update-history');
Route::get('fetch-employee-certificates',[EmployeeController::class,'fetchEmployeeCertificates'])->name('fetch-employee-certificates');
Route::post('save-employee-certificates',[EmployeeController::class,'addEmployeeCertificates'])->name('save-employee-certificates');
Route::post('remove-employee-certificates',[EmployeeController::class,'removeEmployeeCertificates'])->name('remove-employee-certificates');
Route::get('edit-certificate',[EmployeeController::class,'editCertificate'])->name('edit-certificate');
Route::post('update-certificate',[EmployeeController::class,'updateCertificate'])->name('update-certificate');
///movement
Route::post('change-job-title',[EmployeeController::class,'changeJobTitle'])->name('change-job-title');
Route::post('new-assignment',[EmployeeController::class,'newAssignment'])->name('new-assignment');
Route::post('job-transfer',[EmployeeController::class,'jobTransfer'])->name('job-transfer');
Route::post('salary-adjustment',[EmployeeController::class,'salaryAdjustment'])->name('salary-adjustment');
Route::post('demote',[EmployeeController::class,'employeeDemotion'])->name('demote');
Route::post('change-schedule',[EmployeeController::class,'changeSchedule'])->name('change-schedule');
Route::post('promote',[EmployeeController::class,'employeePromotion'])->name('promote');
Route::post('resign',[EmployeeController::class,'employeeResign'])->name('resign');
Route::post('terminate',[EmployeeController::class,'employeeTermination'])->name('terminate');
Route::post('back-out',[EmployeeController::class,'backOut'])->name('back-out');
Route::post('failure',[EmployeeController::class,'failure'])->name('failure');
///submission of forms
Route::post('save-employee',[EmployeeController::class,'saveEmployee'])->name('save-employee');
Route::post('update-employee',[EmployeeController::class,'updateEmployee'])->name('update-employee');
Route::post('add-credit',[EmployeeController::class,'addCredit'])->name('add-credit');
Route::post('create-folder',[EmployeeController::class,'createFolder'])->name('create-folder');
//Settings module
Route::post('save',[SettingController::class,'saveLogo'])->name('save');
Route::post('reset-password',[SettingController::class,'resetPassword'])->name('reset-password');
Route::post('add-account',[SettingController::class,'addAccount'])->name('add-account');
Route::post('save-account',[SettingController::class,'saveAccount'])->name('save-account');
///ajax
Route::post('add-department',[SettingController::class,'addDepartment'])->name('add-department');
Route::get('edit-department',[SettingController::class,'editDepartment'])->name('edit-department');
Route::post('update-department',[SettingController::class,'updateDepartment'])->name('update-department');
Route::post('add-credit-leave',[SettingController::class,'addCreditLeave'])->name('add-credit-leave');
Route::get('edit-credit-leave',[SettingController::class,'editCreditLeave'])->name('edit-credit-leave');
Route::post('update-credit-leave',[SettingController::class,'updateCreditLeave'])->name('update-credit-leave');
Route::post('add-schedule',[SettingController::class,'addSchedule'])->name('add-schedule');
Route::get('edit-schedule',[SettingController::class,'editSchedule'])->name('edit-schedule');
Route::post('update-schedule',[SettingController::class,'updateSchedule'])->name('update-schedule');
Route::post('add-job',[SettingController::class,'addJob'])->name('add-job');
Route::get('edit-job',[SettingController::class,'editJob'])->name('edit-job');
Route::post('update-job',[SettingController::class,'updateJob'])->name('update-job');
//memo
Route::post('save-memo',[MemoController::class,'saveMemo'])->name('save-memo');
Route::post('edit-memo',[MemoController::class,'editMemo'])->name('edit-memo');
Route::post('save-announcement',[MemoController::class,'saveAnnouncement'])->name('save-announcement');
///ajax
Route::post('archive-memo',[MemoController::class,'archive'])->name('archive-memo');
Route::post('restore-memo',[MemoController::class,'restore'])->name('restore-memo');

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
    Route::get('hr/memo/new-announcement',[HomeController::class,'newAnnouncement'])->name('hr/memo/new-announcement');
    //recovery and settings
    //recovery module
    Route::get('hr/recovery',[HomeController::class,'recovery'])->name('hr/recovery');
    //settings module
    Route::get('hr/settings',[HomeController::class,'settings'])->name('hr/settings');
    Route::get('hr/new-account',[HomeController::class,'newAccount'])->name('hr/new-account');
    Route::get('hr/edit-account/{Token}',[HomeController::class,'editAccount'])->name('hr/edit-account');
    //audit trail module
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
    Route::get('hr/employee/documents',[HomeController::class,'employeeDocuments'])->name('hr/employee/documents');
    Route::get('hr/employee/directories',[HomeController::class,'employeeDirectories'])->name('hr/employee/directories');
    Route::get('hr/employee/re-assign/{companyID}',[HomeController::class,'reAssign'])->name('hr/employee/re-assign');
});

