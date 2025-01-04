<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SettingController extends Controller
{
    public function saveLogo(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $aboutModel = new \App\Models\aboutModel();
        $request->validate([
            'title'=>'required',
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
