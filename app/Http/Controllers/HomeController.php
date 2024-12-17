<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class HomeController extends Controller
{
    //
    public function overview()
    {
        $title = "Overview";
        $employeeModel = new \App\Models\employeeModel();
        $totalEmployee = $employeeModel->count();
        $recent = $employeeModel::orderBy('employeeID', 'desc')->take(10)->get();
        $regularEmployee = $employeeModel->WHERE('employmentStatus','Regular')->count();
        $newEmployee = $employeeModel->WHERE('employmentStatus','Probationary')->count();
        $resignEmployee = $employeeModel->WHERE('employeeStatus','2')->count();
        $data = ['title'=>$title,'total'=>$totalEmployee,
                'regular'=>$regularEmployee,'new'=>$newEmployee,
                'resign'=>$resignEmployee,'recent'=>$recent];
        return view('hr/overview',$data);
    }

    public function deductions()
    {
        return view('hr/deductions/index');
    }

    public function loans()
    {
        return view('hr/loans/index');
    }

    //employee management
    public function employee()
    {
        return view('hr/employee/index');
    }

    public function newEmployee()
    {
        return view('hr/employee/new-employee');
    }

    public function viewEmployee($id)
    {
        return view('hr/employee/view-employee');
    }
    

    //recovery, settings and audit trail
    public function recovery()
    {
        return view('hr/recovery');
    }

    public function settings()
    {
        $title = "Settings";
        $data = ['title'=>$title];
        return view('hr/settings',$data);
    }
}
