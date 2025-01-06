<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public function saveLogo(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $aboutModel = new \App\Models\aboutModel();
        $request->validate([
            'title'=>'required|max:50',
            'keywords'=>'required',
            'description'=>'required'
        ]);

        //save the image
        $image = $request->file('image');$filename="";
        if ($request->hasFile('image') && $request->file('image')->isValid()) 
        {
            $filename = $image->getClientOriginalName();
            // Define the path where the image should be saved
            $image->move('assets/images/',$filename);
        }

        $about = $aboutModel->first();
        if(empty($about))
        {
            $data = ['companyName'=>$request->title, 'companyDetails'=>$request->description,'companyTag'=>$request->keywords,'companyLogo'=>$filename];
            $aboutModel->create($data);
        }
        else
        {
            $aboutModel::where('companyID',$about['companyID'])
                ->update(['companyName'=>$request->title, 'companyDetails'=>$request->description,'companyTag'=>$request->keywords,'companyLogo'=>$filename]);
        }

        //create log record
        $logModel = new \App\Models\logModel();
        $date = date('Y-m-d h:i:s a');
        $data = ['accountID'=>session('user_id'),'Date'=>$date,'Activity'=>'Add/update logo and application details'];
        $logModel->create($data);
        return redirect('/hr/settings');
    }

    public function resetPassword(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $accountModel = new \App\Models\accountModel();

        $request->validate([
            'value'=>'required'
        ]);

        $generatedePassword = Str::random(8);
        $password = Hash::make($generatedePassword);
        $accountModel::WHERE('Token',$request->value)
                    ->update(['Password'=>$password]);

        //create log record
        $logModel = new \App\Models\logModel();
        $date = date('Y-m-d h:i:s a');
        $data = ['accountID'=>session('user_id'),'Date'=>$date,'Activity'=>'Reset password'];
        $logModel->create($data);
        echo "success";
    }

    public function addAccount(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $accountModel = new \App\Models\accountModel();

        $request->validate([
            'fullname'=>'required',
            'username'=>'required|min:6|max:20',
            'password'=>'required|min:8|regex:/[A-Z]/|regex:/[a-z]/|regex:/[0-9]/|regex:/[@$!%*?&]/',
            'email_address'=>'required|email',
            'role'=>'required'
        ]);
        $token = Str::random(32);
        $status = 1;
        $password = Hash::make($request->password);
        $data = ['Username'=>$request->username, 'Password'=>$password,'Fullname'=>$request->fullname,
                'Designation'=>$request->role,'Email'=>$request->email_address,'Status'=>$status,
                'Role'=>$request->role,'Token'=>$token];
        $accountModel->create($data);
        //create log record
        $logModel = new \App\Models\logModel();
        $date = date('Y-m-d h:i:s a');
        $data = ['accountID'=>session('user_id'),'Date'=>$date,'Activity'=>'Register new account'];
        $logModel->create($data);
        return redirect('/hr/settings')->with('success','Great! Successfully registered');
    }

    public function saveAccount(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $accountModel = new \App\Models\accountModel();

        $request->validate([
            'token'=>'required',
            'fullname'=>'required',
            'username'=>'required|min:6|max:20',
            'email_address'=>'required|email',
            'role'=>'required',
            'status'=>'required'
        ]);

        $accountModel::WHERE('Token',$request->token)
                    ->update(['Username'=>$request->username,'Fullname'=>$request->fullname,
                    'Designation'=>$request->role,'Email'=>$request->email_address,'Status'=>$request->status,
                    'Role'=>$request->role]);

        //create log record
        $logModel = new \App\Models\logModel();
        $date = date('Y-m-d h:i:s a');
        $data = ['accountID'=>session('user_id'),'Date'=>$date,'Activity'=>'Update the account of '.$request->fullname];
        $logModel->create($data);
        return redirect('/hr/settings')->with('success','Great! Successfully applied changes');
    }

    public function addDepartment(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $departmentModel = new \App\Models\departmentModel();
        //data
        $validator = Validator::make($request->all(),[
            'office'=>'required',
            'department'=>'required|unique:tbldepartment,departmentName',
            'department_number'=>'required'
        ]);

        if ($validator->fails()) {
            // Return validation errors as JSON
            return response()->json(['errors' => $validator->errors()]);
        }
        else
        {
            $data = ['departmentName'=>$request->department,'departmentNumber'=>$request->department_number, 'officeID'=>$request->office];
            $departmentModel->create($data);
            //create log record
            $logModel = new \App\Models\logModel();
            $date = date('Y-m-d h:i:s a');
            $data = ['accountID'=>session('user_id'),'Date'=>$date,'Activity'=>'Added new department or branch'];
            $logModel->create($data);
            return response()->json(['success' => 'Great! Successfully saved']);
        }
    }

    public function addCreditLeave(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $leaveSetupModel = new \App\Models\leaveSetupModel();
        //data
        $validator = Validator::make($request->all(),[
            'month'=>'required|unique:tbl_leave_setup,Month',
            'vacation'=>'required',
            'sick'=>'required'
        ]);

        if ($validator->fails()) {
            // Return validation errors as JSON
            return response()->json(['errors' => $validator->errors()]);
        }
        else
        {
            $data = ['Month'=>$request->month, 'Vacation'=>$request->vacation,'Sick'=>$request->sick];
            $leaveSetupModel->create($data);
            //create log record
            $logModel = new \App\Models\logModel();
            $date = date('Y-m-d h:i:s a');
            $data = ['accountID'=>session('user_id'),'Date'=>$date,'Activity'=>'Added new leave credits for '.$request->month];
            $logModel->create($data);
            return response()->json(['success' => 'Great! Successfully saved']);
        }
    }

    public function addSchedule(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $schedulerModel = new \App\Models\schedulerModel();
        //data
        $validator = Validator::make($request->all(),[
            'type_schedule'=>'required',
            'from_time'=>'required',
            'to_time'=>'required',
            'break_time'=>'required'
        ]);

        if ($validator->fails()) {
            // Return validation errors as JSON
            return response()->json(['errors' => $validator->errors()]);
        }
        else
        {
            $mergeHour = $request->from_time.' - '.$request->to_time;
            $data = ['scheduleType'=>$request->type_schedule,'hours'=>$mergeHour,'breakTime'=>$request->break_time,'Notes'=>$request->type_schedule.' Type'];
            $schedulerModel->create($data);
            //create log record
            $logModel = new \App\Models\logModel();
            $date = date('Y-m-d h:i:s a');
            $data = ['accountID'=>session('user_id'),'Date'=>$date,'Activity'=>'Added new schedule'];
            $logModel->create($data);
            return response()->json(['success' => 'Great! Successfully saved']);
        }
    }

    public function generateFirstLeaveCredit()
    {
        $leaveSetupModel = new \App\Models\leaveSetupModel();
        $employeeModel = new \App\Models\employeeModel();
        $employee = $employeeModel->all();
        foreach($employee as $row)
        {
            $hire_date = $employee['dateHired'];
            
            // Create DateTime objects for the hire date and current date
            $hireDate = Carbon::parse($hire_date);
            $currentDate = Carbon::now();
            
            // Calculate the difference between the current date and the hire date
            $monthsEmployed = $hireDate->diffInMonths($currentDate);
            if($monthsEmployed==12)
            {
                //get the leave credits based on the month
            }
        }
    }

    public function generateRegularLeaveCredit()
    {

    }
}
