<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function home()
    {
        if (Auth::guard('user')->check()) {
            return redirect("hr/overview");
        }
        $aboutModel = new \App\Models\aboutModel();
        $about = $aboutModel->first();
        $data = ['about'=>$about];
        return view('login',$data);
    }

    public function employeePortal()
    {
        if (Auth::guard('employee')->check()) {
            return redirect("employee/overview");
        }
        $aboutModel = new \App\Models\aboutModel();
        $about = $aboutModel->first();
        $data = ['about'=>$about];
        return view('employee-login',$data);
    }

    public function getChartData()
    {
        $employeeModel = new \App\Models\employeeModel();
        $employeeCounts = $employeeModel::select(DB::raw('dateHired'), DB::raw('count(companyID) as total'))
                            ->groupBy(DB::raw('dateHired'))
                            ->orderBy('dateHired', 'asc') // Optional: Order by date
                            ->get();
        return response()->json($employeeCounts);
    }

    public function overview()
    {
        $title = "Overview";
        //application
        $aboutModel = new \App\Models\aboutModel();
        $about = $aboutModel->first();
        //recent employee
        $employeeModel = new \App\Models\employeeModel();
        $totalEmployee = $employeeModel->count();
        $work = ['Trainee','Probationary'];
        $status = [0,2,3,4];
        $recent = $employeeModel::orderBy('employeeID', 'desc')->take(10)->get();
        $regularEmployee = $employeeModel->WHERE('employmentStatus','Regular')->WHERE('employeeStatus',1)->count();
        $newEmployee = $employeeModel->WHEREIN('employmentStatus',$work)->WHERE('employeeStatus',1)->count();
        $resignEmployee = $employeeModel->WHEREIN('employeeStatus',$status)->count();
        //recent
        $announcementModel = new \App\Models\announcementModel();
        $announcement = $announcementModel::orderBy('announcementID', 'desc')->take(10)->get();

        $data = ['title'=>$title,'total'=>$totalEmployee,
                'regular'=>$regularEmployee,'new'=>$newEmployee,
                'resign'=>$resignEmployee,'recent'=>$recent,
                'about'=>$about,'announcement'=>$announcement];
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
        $title = "Memos and Broadcast";
        //application
        $aboutModel = new \App\Models\aboutModel();
        $about = $aboutModel->first();
        //memo
        $memoModel = new \App\Models\memoModel();
        $memo = $memoModel->all();
        //announcement
        $announcementModel = new \App\Models\announcementModel();
        $announce = $announcementModel->all();

        $data = ['title'=>$title,'about'=>$about,'memo'=>$memo,'announce'=>$announce];
        return view('hr/memo/index',$data);
    }

    public function editMemo($id)
    {
        $title = "Edit Memo";
        //application
        $aboutModel = new \App\Models\aboutModel();
        $about = $aboutModel->first();
        //department
        $departmentModel = new \App\Models\departmentModel();
        $department = $departmentModel->all();
        //memo
        $memoModel = new \App\Models\memoModel();
        $memo = $memoModel->WHERE('memoID',$id)->first();

        $data = ['title'=>$title,'about'=>$about,'department'=>$department,'memo'=>$memo];
        return view('hr/memo/edit-memo',$data);
    }

    public function newMemo()
    {
        $title = "New Memo";
        $aboutModel = new \App\Models\aboutModel();
        $about = $aboutModel->first();
        //department
        $departmentModel = new \App\Models\departmentModel();
        $department = $departmentModel->all();

        $data = ['title'=>$title,'about'=>$about,'department'=>$department];
        return view('hr/memo/new-memo',$data);
    }

    public function newAnnouncement()
    {
        $title = "Broadcast";
        $aboutModel = new \App\Models\aboutModel();
        $about = $aboutModel->first();

        $data = ['title'=>$title,'about'=>$about];
        return view('hr/memo/new-announcement',$data);
    }

    public function editAnnouncement($id)
    {
        $title = "Edit Broadcast";
        //application
        $aboutModel = new \App\Models\aboutModel();
        $about = $aboutModel->first();
        //broadcast
        $announcementModel = new \App\Models\announcementModel();
        $announcement = $announcementModel->WHERE('announcementID',$id)->first();

        $data = ['title'=>$title,'about'=>$about,'announcement'=>$announcement];
        return view('hr/memo/edit-announcement',$data);
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
        //load the office
        $officeModel = new \App\Models\officeModel();
        $office = $officeModel->all();
        //job
        $designationModel = new \App\Models\designationModel();
        $job = $designationModel->all();

        $data = ['title'=>$title,'about'=>$about,'employee'=>$employee,'office'=>$office,'job'=>$job];
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
        //job
        $designationModel = new \App\Models\designationModel();
        $job = $designationModel->all();

        $data = ['title'=>$title,'about'=>$about,'office'=>$office,'job'=>$job];
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
        //movement
        $recordModel = new \App\Models\recordModel();
        $record = $recordModel->WHERE('employeeID',$employee['employeeID'])->orderBy('recordID','DESC')->get();

        $data = ['title'=>$title,'employee'=>$employee,'about'=>$about,'office'=>$office,'department'=>$department,'record'=>$record];
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
                    ->where('a.employeeStatus', '=',1)->where('employmentStatus','Regular')
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
                ->leftJoin('tbloffice as c','c.officeID','=','a.officeID')
                ->leftJoin('tbldepartment as d','d.departmentID','=','a.departmentID')
                ->select('a.*','b.companyID','b.surName','b.firstName','b.middleName','b.suffix','c.officeName','d.departmentName')->get();
        $data = ['title'=>$title,'about'=>$about,'employee'=>$employee];
        return view('hr/employee/movement',$data);
    }

    public function employeeDocuments()
    {
        $title = "Employee Documents";
        $folder = "documents";
        //application
        $aboutModel = new \App\Models\aboutModel();
        $about = $aboutModel->first();
        //create folder if not exist
        $folderPath = public_path('/'.$folder);
        if (!file_exists($folderPath))
        {
            mkdir($folderPath, 0777, true);
        }

        // Get the full path of the specific folder
        $folderPath = public_path($folder);
        
        // Check if the folder exists
        if (!File::exists($folderPath) || !File::isDirectory($folderPath)) {
            abort(404, "Folder not found");
        }

        // Get all subfolders in the specified folder
        $folders = $this->getFolders($folderPath);

        $data = ['title'=>$title,'about'=>$about,'folders'=>$folders,'folder'=>$folder];
        return view('hr/employee/documents',$data);
    }

    private function getFolders($path)
    {
        $folders = [];

        // Scan the directory for subdirectories only (no files)
        $items = File::directories($path);

        // Loop through all found directories and store their relative paths
        foreach ($items as $item) {
            $folders[] = basename($item); // Get folder name only (not full path)
        }

        return $folders;
    }

    public function employeeDirectories()
    {
        if(session('role')=="ADMIN"||session('role')=="Admin"||session('role')=="MANAGER"||session('role')=="Manager")
        {
            $title = "Directories";
            //application
            $aboutModel = new \App\Models\aboutModel();
            $about = $aboutModel->first();
            //directories
            $employee = DB::table('tblemployee as a')
                ->leftJoin('tbloffice as b','b.officeID','=','a.officeID')
                ->leftJoin('tbldepartment as c','c.departmentID','=','a.departmentID')
                ->select('a.*','b.officeName','c.departmentName','c.departmentNumber')->get();
            $data = ['title'=>$title,'about'=>$about,'employee'=>$employee];
            return view('hr/employee/directory',$data);
        }
        else
        {
            return redirect('hr/overview');
        }
    }

    public function uploadFile($id)
    {
        $aboutModel = new \App\Models\aboutModel();
        $about = $aboutModel->first();
        $data = ['title'=>$id,'about'=>$about];
        return view('hr/employee/upload',$data);
    }

    public function calendar()
    {
        $title = "Calendar and Request";
        $aboutModel = new \App\Models\aboutModel();
        $about = $aboutModel->first();
        $data = ['title'=>$title,'about'=>$about];
        return view('hr/leave/index',$data);
    }

    public function leave()
    {
        $title = "Leave Types and Policy";
        $aboutModel = new \App\Models\aboutModel();
        $about = $aboutModel->first();
        $data = ['title'=>$title,'about'=>$about];
        return view('hr/leave/policy',$data);
    }

    //recovery, settings and audit trail
    public function recovery()
    {
        if(session('role')=="ADMIN"||session('role')=="Admin"||session('role')=="MANAGER"||session('role')=="Manager")
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
        if(session('role')=="ADMIN"||session('role')=="Admin"||session('role')=="MANAGER"||session('role')=="Manager")
        {
            $title = "Settings";
            //application
            $aboutModel = new \App\Models\aboutModel();
            $about = $aboutModel->first();
            //account
            $accountModel = new \App\Models\accountModel();
            $account = $accountModel->all();
            //office
            $officeModel = new \App\Models\officeModel();
            $office = $officeModel->all();
            //department
            $department = DB::table('tbldepartment as a')
                ->leftJoin('tbloffice as b','b.officeID','=','a.officeID')
                ->select('b.officeName','a.departmentID','a.departmentName','a.departmentNumber','a.Code','a.created_at')->get();
            //scheduler
            $schedulerModel = new \App\Models\schedulerModel();
            $scheduler = $schedulerModel->all();
            //leave setup
            $leaveSetupModel = new \App\Models\leaveSetupModel();
            $leaveSetup = $leaveSetupModel->all();
            //designation
            $designationModel = new \App\Models\designationModel();
            $job = $designationModel->all();

            $data = ['title'=>$title,'about'=>$about,'account'=>$account,
                    'office'=>$office,'department'=>$department,'schedule'=>$scheduler,
                    'leaveSetup'=>$leaveSetup,'job'=>$job];
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
            $title = "Create Account";
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
            //application
            $aboutModel = new \App\Models\aboutModel();
            $about = $aboutModel->first();
            //account
            $accountModel = new \App\Models\accountModel();
            $account = $accountModel->WHERE('Token',$id)->first();
            
            $data = ['title'=>$title,'about'=>$about,'account'=>$account];
            return view('hr/edit-account',$data);
        }
        else
        {
            return redirect('hr/overview');
        }
    }

    public function auditTrail()
    {
        if(session('role')=="ADMIN"||session('role')=="Admin"||session('role')=="MANAGER"||session('role')=="Manager")
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
        //application
        $aboutModel = new \App\Models\aboutModel();
        $about = $aboutModel->first();
        //account
        $accountModel = new \App\Models\accountModel();
        $account = $accountModel->WHERE('accountID',session('user_id'))->first();

        $data = ['title'=>$title,'about'=>$about,'account'=>$account];
        return view('hr/account',$data);
    }

    public function changePassword(Request $request)
    {
        $accountModel = new \App\Models\accountModel();
        $request->validate([
            'old_password'=>[
                                'required',
                                'min:8',
                                'max:16',
                                'regex:/[A-Z]/',
                                'regex:/[a-z]/',
                                'regex:/[0-9]/',
                                function ($attribute, $value, $fail) {
                                    // Check if the old password matches the password in the database
                                    if (!Hash::check($value, Auth::guard('user')->user()->Password)) {
                                        return $fail('The current password is incorrect.');
                                    }
                                }
                            ],
            'new_password'=>[
                                'required',
                                'different:old_password',
                                'min:8',
                                'max:16',
                                'regex:/[A-Z]/',
                                'regex:/[a-z]/',
                                'regex:/[0-9]/',
                            ],
            'confirm_password'=>[
                                'required',
                                'same:new_password',
                                'min:8',
                                'max:16',
                                'regex:/[A-Z]/',
                                'regex:/[a-z]/',
                                'regex:/[0-9]/',
                                ]
        ]);
        //hash the new password
        $newPassword = Hash::make($request->newPassword);
        $accountModel::WHERE('accountID',session('user_id'))->update(['Password'=>$newPassword]);
        return redirect('/hr/account')->with('success','Your password has been successfully updated');
    }

    public function saveInfo(Request $request)
    {

    }
}
