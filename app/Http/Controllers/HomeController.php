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
        $title = "Memorandum";
        //application
        $aboutModel = new \App\Models\aboutModel();
        $about = $aboutModel->first();
        //memo
        $memoModel = new \App\Models\memoModel();
        $memo = $memoModel->all();
        $data = ['title'=>$title,'about'=>$about,'memo'=>$memo];
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
        //application 
        $aboutModel = new \App\Models\aboutModel();
        $about = $aboutModel->first();
        //employees
        $employeeModel = new \App\Models\employeeModel();
        $employee = $employeeModel->all();

        $data = ['title'=>$title,'about'=>$about,'employee'=>$employee];
        return view('hr/employee/index',$data);
    }

    public function newEmployee()
    {
        $title = "New Employee";
        //application
        $aboutModel = new \App\Models\aboutModel();
        $about = $aboutModel->first();
        //load the offices
        $officeModel = new \App\Models\officeModel();
        $office = $officeModel->all();
        $data = ['title'=>$title,'about'=>$about,'office'=>$office];
        return view('hr/employee/new-employee',$data);
    }

    public function editEmployee($id)
    {
        $title = "Edit Employee";
        //application
        $aboutModel = new \App\Models\aboutModel();
        $about = $aboutModel->first();
        //employee
        $employeeModel = new \App\Models\employeeModel();
        $employee = $employeeModel->WHERE('companyID',$id)->first();
        //office
        //load the offices
        $officeModel = new \App\Models\officeModel();
        $office = $officeModel->all();
        //department
        $departmentModel = new \App\Models\departmentModel();
        $department = $departmentModel->WHERE('officeID',$employee['officeID'])->get();

        $data = ['title'=>$title,'employee'=>$employee,'about'=>$about,'office'=>$office,'department'=>$department];
        return view('hr/employee/edit-employee',$data);
    }

    public function viewEmployee($id)
    {
        $title = "Employee Profile";
        //application
        $aboutModel = new \App\Models\aboutModel();
        $about = $aboutModel->first();
        //employee
        $employeeModel = new \App\Models\employeeModel();
        $employee = $employeeModel->WHERE('companyID',$id)->first();
        //office
        //load the offices
        $officeModel = new \App\Models\officeModel();
        $office = $officeModel->all();
        //department
        $departmentModel = new \App\Models\departmentModel();
        $department = $departmentModel->WHERE('officeID',$employee['officeID'])->get();

        $data = ['title'=>$title,'employee'=>$employee,'about'=>$about,'office'=>$office,'department'=>$department];
        return view('hr/employee/view-employee',$data);
    }

    public function creditsEmployee()
    {
        $title = "Leave Credits";
        //application
        $aboutModel = new \App\Models\aboutModel();
        $about = $aboutModel->first();
        //employee
        $employee = DB::table('tblemployee as a')
                    ->leftJoin('tblcredit as b','b.employeeID','=','a.employeeID')
                    ->select('a.companyID','a.surName','a.firstName','a.middleName','a.suffix','a.designation','b.Vacation','a.employeeID','b.Sick','b.Year')
                    ->where('a.employeeStatus', '=',1)
                    ->get();
        $data = ['title'=>$title,'about'=>$about,'employee'=>$employee];
        return view('hr/employee/credits',$data);
    }

    public function employeeMovement()
    {
        $title = "Career Progression";
        //application
        $aboutModel = new \App\Models\aboutModel();
        $about = $aboutModel->first();
        //employee
        $employee = DB::table('tblrecord as a')
                ->leftJoin('tblemployee as b','b.employeeID','=','a.employeeID')
                ->select('a.*','b.companyID','b.surName','b.firstName','b.middleName','b.suffix')->get();
        $data = ['title'=>$title,'about'=>$about,'employee'=>$employee];
        return view('hr/employee/movement',$data);
    }

    //recovery, settings and audit trail
    public function recovery()
    {
        if(session('role')=="ADMIN"||session('role')=="Admin")
        {
            $title = "Recovery";
            $aboutModel = new \App\Models\aboutModel();
            $about = $aboutModel->first();
            $data = ['title'=>$title,'about'=>$about];
            return view('hr/recovery',$data);
        }
        else
        {
            return redirect('hr/overview');
        }
    }

    public function settings()
    {
        if(session('role')=="ADMIN"||session('role')=="Admin")
        {
            $title = "Settings";
            //application
            $aboutModel = new \App\Models\aboutModel();
            $about = $aboutModel->first();
            //account
            $accountModel = new \App\Models\accountModel();
            $account = $accountModel->all();

            $data = ['title'=>$title,'about'=>$about,'account'=>$account];
            return view('hr/settings',$data);
        }
        else
        {
            return redirect('hr/overview');
        }
    }

    public function newAccount()
    {
        if(session('role')=="ADMIN"||session('role')=="Admin")
        {
            $title = "New Account";
            $aboutModel = new \App\Models\aboutModel();
            $about = $aboutModel->first();
            $data = ['title'=>$title,'about'=>$about];
            return view('hr/new-account',$data);
        }
        else
        {
            return redirect('hr/overview');
        }
    }

    public function editAccount($id)
    {
        if(session('role')=="ADMIN"||session('role')=="Admin")
        {
            $title = "Edit Account";
            $aboutModel = new \App\Models\aboutModel();
            $about = $aboutModel->first();
            $data = ['title'=>$title,'about'=>$about];
            return view('hr/edit-account',$data);
        }
        else
        {
            return redirect('hr/overview');
        }
    }

    public function auditTrail()
    {
        if(session('role')=="ADMIN"||session('role')=="Admin")
        {
            $title = "Audit Trail";
            //application
            $aboutModel = new \App\Models\aboutModel();
            $about = $aboutModel->first();
            //logs
            $log = DB::table('tblsystemlogs as a')
                    ->leftJoin('tblaccount as b','b.accountID','=','a.accountID')
                    ->select('a.*','b.Fullname','b.Role')->get();
            $data = ['title'=>$title,'about'=>$about,'log'=>$log];
            return view('hr/audit',$data);
        }
        else
        {
            return redirect('hr/overview');
        }
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
