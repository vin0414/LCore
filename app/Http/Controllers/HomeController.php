<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    //
    public function home()
    {
        $aboutModel = new \App\Models\aboutModel();
        $about = $aboutModel->first();
        $data = ['about'=>$about];
        return view('login',$data);
    }

    public function getChartData()
    {
        $employeeModel = new \App\Models\employeeModel();
        $employeeCounts = $employeeModel::select(DB::raw('dateHired'), DB::raw('count(*) as total'))
                            ->groupBy(DB::raw('dateHired'))
                            ->orderBy('dateHired', 'asc') // Optional: Order by date
                            ->get();
        return response()->json($employeeCounts);
    }

    public function overview()
    {
        $title = "Overview";
        $aboutModel = new \App\Models\aboutModel();
        $about = $aboutModel->first();
        $employeeModel = new \App\Models\employeeModel();
        $totalEmployee = $employeeModel->count();
        $recent = $employeeModel::orderBy('employeeID', 'desc')->take(10)->get();
        $regularEmployee = $employeeModel->WHERE('employmentStatus','Regular')->count();
        $newEmployee = $employeeModel->WHERE('employmentStatus','Probationary')->count();
        $resignEmployee = $employeeModel->WHERE('employeeStatus','2')->count();
        $data = ['title'=>$title,'total'=>$totalEmployee,
                'regular'=>$regularEmployee,'new'=>$newEmployee,
                'resign'=>$resignEmployee,'recent'=>$recent,
                'about'=>$about];
        return view('hr/overview',$data);
    }

    public function deductions()
    {
        $aboutModel = new \App\Models\aboutModel();
        $about = $aboutModel->first();
        return view('hr/deductions/index');
    }

    public function loans()
    {
        $aboutModel = new \App\Models\aboutModel();
        $about = $aboutModel->first();
        return view('hr/loans/index');
    }

    //memo
    public function memo()
    {
        $title = "Memorandum";;
        $aboutModel = new \App\Models\aboutModel();
        $about = $aboutModel->first();
        $data = ['title'=>$title,'about'=>$about];
        return view('hr/memo/index',$data);
    }

    public function editMemo($id)
    {
        $title = "Edit Memorandum";
        $aboutModel = new \App\Models\aboutModel();
        $about = $aboutModel->first();
        $data = ['title'=>$title,'about'=>$about];
        return view('hr/memo/edit-memo',$data);
    }

    public function newMemo()
    {
        $title = "New Memorandum";
        $aboutModel = new \App\Models\aboutModel();
        $about = $aboutModel->first();
        $data = ['title'=>$title,'about'=>$about];
        return view('hr/memo/new-memo',$data);
    }

    public function archive()
    {
        $title = "Archives";
        $aboutModel = new \App\Models\aboutModel();
        $about = $aboutModel->first();
        $data = ['title'=>$title,'about'=>$about];
        return view('hr/memo/archive',$data);
    }

    //employee management
    public function employee()
    {
        $title = "Master File";
        $aboutModel = new \App\Models\aboutModel();
        $about = $aboutModel->first();
        $data = ['title'=>$title,'about'=>$about];
        return view('hr/employee/index',$data);
    }

    public function newEmployee()
    {
        $title = "New Employee";
        $aboutModel = new \App\Models\aboutModel();
        $about = $aboutModel->first();
        $data = ['title'=>$title,'about'=>$about];
        return view('hr/employee/new-employee',$data);
    }

    public function editEmployee($id)
    {
        $title = "Edit Employee";
        $aboutModel = new \App\Models\aboutModel();
        $about = $aboutModel->first();
        $employeeModel = new \App\Models\employeeModel();
        $employee = $employeeModel->WHERE('companyID',$id)->first();
        $data = ['title'=>$title,'employee'=>$employee,'about'=>$about];
        return view('hr/employee/edit-employee',$data);
    }

    public function viewEmployee($id)
    {
        $title = "View Employee";
        $aboutModel = new \App\Models\aboutModel();
        $about = $aboutModel->first();
        $employeeModel = new \App\Models\employeeModel();
        $employee = $employeeModel->WHERE('companyID',$id)->first();
        $data = ['title'=>$title,'employee'=>$employee,'about'=>$about];
        return view('hr/employee/view-employee',$data);
    }

    public function creditsEmployee()
    {
        $title = "Leave Credits";
        $aboutModel = new \App\Models\aboutModel();
        $about = $aboutModel->first();
        $data = ['title'=>$title,'about'=>$about];
        return view('hr/employee/credits',$data);
    }

    public function employeeMovement()
    {
        $title = "Employee Mobility";
        $aboutModel = new \App\Models\aboutModel();
        $about = $aboutModel->first();
        $data = ['title'=>$title,'about'=>$about];
        return view('hr/employee/movement',$data);
    }

    //recovery, settings and audit trail
    public function recovery()
    {
        $title = "Recovery";
        $aboutModel = new \App\Models\aboutModel();
        $about = $aboutModel->first();
        $data = ['title'=>$title,'about'=>$about];
        return view('hr/recovery',$data);
    }

    public function settings()
    {
        $title = "Settings";
        $aboutModel = new \App\Models\aboutModel();
        $about = $aboutModel->first();
        $data = ['title'=>$title,'about'=>$about];
        return view('hr/settings',$data);
    }

    public function auditTrail()
    {
        $title = "Audit Trail";
        $aboutModel = new \App\Models\aboutModel();
        $about = $aboutModel->first();
        $data = ['title'=>$title,'about'=>$about];
        return view('hr/audit',$data);
    }

    public function account()
    {
        $title = "My Account";
        $aboutModel = new \App\Models\aboutModel();
        $about = $aboutModel->first();
        $data = ['title'=>$title,'about'=>$about];
        return view('hr/account',$data);
    }
}
