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
            'username'=>'required|min:6|max:20|unique:tblaccount,Username',
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
        $officeModel = new \App\Models\officeModel();
        //data
        $validator = Validator::make($request->all(),[
            'office'=>'required',
            'department'=>'required|unique:tbldepartment,departmentName',
            'department_number'=>'required',
            'date'=>'nullable'
        ]);

        if ($validator->fails()) {
            // Return validation errors as JSON
            return response()->json(['errors' => $validator->errors()]);
        }
        else
        {
            $code = "";$totalRecords = 0;
            //count the department based on the officeID
            $department = $departmentModel->WHERE('officeID',$request->office)->count();
            $totalRecords = $department+1;
            $office = $officeModel->WHERE('officeID',$request->office)->first();
            if($office['officeName']=="Head Office"||$office['officeName']=="HO"){$code = "HO";}else{$code = "BR";}
            $newCode = $code.$totalRecords;
            
            $data = ['departmentName'=>$request->department,'departmentNumber'=>$request->department_number, 
                    'Date'=>$request->date,'Code'=>$newCode,'officeID'=>$request->office];
            $departmentModel->create($data);
            //create log record
            $logModel = new \App\Models\logModel();
            $date = date('Y-m-d h:i:s a');
            $data = ['accountID'=>session('user_id'),'Date'=>$date,'Activity'=>'Added new department or branch'];
            $logModel->create($data);
            return response()->json(['success' => 'Great! Successfully saved']);
        }
    }

    public function editDepartment(Request $request)
    {
        $departmentModel = new \App\Models\departmentModel();
        $deptID = $request->value;
        $department = $departmentModel->WHERE('departmentID',$deptID)->first();
        if($department)
        {
            ?>
            <form method="POST" class="form__modal" id="frmEditDepartment">
              <input type="hidden" name="_token" value="<?php echo csrf_token()?>"/>
              <input type="hidden" name="departmentID" value="<?php echo $department['departmentID'] ?>"/>
              <div class="input__form__modal__box">
                <div class="input__box">
                  <input
                    class="information__input" value="<?php echo $department['departmentName'] ?>"
                    placeholder="Enter Department or Branch"
                    name="edit_department"
                  />
                  <span class="input__title">Department/Branch</span>
                  <div id="edit_department-error" class="error-message text-danger"></div>
                </div>
                <div class="input__box">
                  <input type="number"
                    class="information__input"
                    placeholder="Enter Department Number"
                    name="edit_department_number" value="<?php echo $department['departmentNumber'] ?>"
                  />
                  <span class="input__title">Contact Number</span>
                  <div id="edit_department_number-error" class="error-message text-danger"></div>
                </div>
              </div>
              <button type="submit" class="btn__submit__modal submitDeptForm"><ion-icon class="icon" name="paper-plane-outline"></ion-icon>Submit</button>
            </form>
            <?php
        }
    }

    public function updateDepartment(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $departmentModel = new \App\Models\departmentModel();
        $validator = Validator::make($request->all(),[
            'edit_department'=>'required',
            'edit_department_number'=>'required'
        ]);

        if ($validator->fails()) {
            // Return validation errors as JSON
            return response()->json(['errors' => $validator->errors()]);
        }
        else
        {
            $departmentModel::WHERE('departmentID',$request->departmentID)
                            ->UPDATE(['departmentName'=>$request->edit_department,'departmentNumber'=>$request->edit_department_number]);
            //create log record
            $logModel = new \App\Models\logModel();
            $date = date('Y-m-d h:i:s a');
            $data = ['accountID'=>session('user_id'),'Date'=>$date,'Activity'=>'Update department'];
            $logModel->create($data);
            return response()->json(['success' => 'Great! Successfully applied changes']);
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

    public function editCreditLeave(Request $request)
    {
        $leaveSetupModel = new \App\Models\leaveSetupModel();
        $leave = $leaveSetupModel->WHERE('setupID',$request->value)->first();
        if($leave)
        {
            ?>
            <form method="POST" class="form__modal" id="frmEditCredit">
              <input type="hidden" name="_token" value="<?php echo csrf_token()?>"/>
              <input type="hidden" name="creditID" value="<?php echo $leave['setupID'] ?>"/>
              <div class="input__form__modal__box">
                <div class="input__box">
                  <select class="information__input" name="edit_month">
                    <option value="" disabled selected>
                      Select Month
                    </option>
                    <option <?php echo ($leave['Month'] == 'January') ? 'selected' : ''; ?>>January</option>
                    <option <?php echo ($leave['Month'] == 'February') ? 'selected' : ''; ?>>February</option>
                    <option <?php echo ($leave['Month'] == 'March') ? 'selected' : ''; ?>>March</option>
                    <option <?php echo ($leave['Month'] == 'April') ? 'selected' : ''; ?>>April</option>
                    <option <?php echo ($leave['Month'] == 'May') ? 'selected' : ''; ?>>May</option>
                    <option <?php echo ($leave['Month'] == 'June') ? 'selected' : ''; ?>>June</option>
                    <option <?php echo ($leave['Month'] == 'July') ? 'selected' : ''; ?>>July</option>
                    <option <?php echo ($leave['Month'] == 'August') ? 'selected' : ''; ?>>August</option>
                    <option <?php echo ($leave['Month'] == 'September') ? 'selected' : ''; ?>>September</option>
                    <option <?php echo ($leave['Month'] == 'October') ? 'selected' : ''; ?>>October</option>
                    <option <?php echo ($leave['Month'] == 'November') ? 'selected' : ''; ?>>November</option>
                    <option <?php echo ($leave['Month'] == 'December') ? 'selected' : ''; ?>>December</option>
                  </select>
                  <span class="input__title">Month</span>
                  <div id="edit_month-error" class="error-message text-danger"></div>
                </div>
                <div class="input__box">
                  <input type="number"
                    class="information__input"
                    placeholder="Enter Vacation"
                    name="edit_vacation" value="<?php echo $leave['Vacation'] ?>"
                  />
                  <span class="input__title">Vacation Credit</span>
                  <div id="edit_vacation-error" class="error-message text-danger"></div>
                </div>
                <div class="input__box">
                  <input type="number"
                    class="information__input"
                    placeholder="Enter Sick"
                    name="edit_sick" value="<?php echo $leave['Sick'] ?>"
                  />
                  <span class="input__title">Sick Credit</span>
                  <div id="edit_sick-error" class="error-message text-danger"></div>
                </div>
              </div>
              <button type="submit" class="btn__submit__modal submitCreditForm"><ion-icon class="icon" name="paper-plane-outline"></ion-icon>Submit</button>
            </form>
            <?php
        }
    }

    public function updateCreditLeave(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $leaveSetupModel = new \App\Models\leaveSetupModel();
        $validator = Validator::make($request->all(),[
            'edit_month'=>'required',
            'edit_vacation'=>'required',
            'edit_sick'=>'required'
        ]);

        if ($validator->fails()) {
            // Return validation errors as JSON
            return response()->json(['errors' => $validator->errors()]);
        }
        else
        {
            $leaveSetupModel::where('setupID',$request->creditID)
                            ->update(['Month'=>$request->edit_month, 
                                'Vacation'=>$request->edit_vacation,
                                'Sick'=>$request->edit_sick]);
            //create log record
            $logModel = new \App\Models\logModel();
            $date = date('Y-m-d h:i:s a');
            $data = ['accountID'=>session('user_id'),'Date'=>$date,'Activity'=>'Update leave credits'];
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

    public function editSchedule(Request $request)
    {
        $schedulerModel = new \App\Models\schedulerModel();
        $schedule = $schedulerModel->WHERE('scheduleID',$request->value)->first();
        if($schedule)
        {
            list($startTime, $endTime) = explode(' - ', $schedule['hours']);
            $startFormatted = $startTime;
            $endFormatted = $endTime;
            ?>
            <form method="POST" class="form__modal" id="frmEditSchedule">
               <input type="hidden" name="_token" value="<?php echo csrf_token()?>"/>
              <input type="hidden" name="scheduleID" value="<?php echo $schedule['scheduleID'] ?>"/>
              <div class="input__form__modal__box">
                <div class="input__box">
                  <select class="information__input" name="edit_type_schedule">
                    <option value="" disabled selected>
                      Select Type
                    </option>
                    <option <?php echo ($schedule['scheduleType'] == 'Default') ? 'selected' : ''; ?>>Default</option>
                    <option <?php echo ($schedule['scheduleType'] == 'Modified') ? 'selected' : ''; ?>>Modified</option>
                  </select>
                  <span class="input__title">Type of Schedule</span>
                  <div id="edit_type_schedule-error" class="error-message text-danger"></div>
                </div>
                <div class="input__box">
                  <input type="time"
                    class="information__input"
                    placeholder="Enter Time"
                    name="edit_from_time" value="<?php echo $startFormatted ?>"
                  />
                  <span class="input__title">From</span>
                  <div id="edit_from_time-error" class="error-message text-danger"></div>
                </div>
                <div class="input__box">
                  <input type="time"
                    class="information__input"
                    placeholder="Enter Time"
                    name="edit_to_time" value="<?php echo $endFormatted  ?>"
                  />
                  <span class="input__title">To</span>
                  <div id="edit_to_time-error" class="error-message text-danger"></div>
                </div>
                <div class="input__box">
                  <select class="information__input" name="edit_break_time">
                    <option value="" disabled selected>
                      Select
                    </option>
                    <option <?php echo ($schedule['breakTime'] == '11:00 AM - 12:00 PM') ? 'selected' : ''; ?>>11:00 AM - 12:00 PM</option>
                    <option <?php echo ($schedule['breakTime'] == '12:00 PM - 01:00 PM') ? 'selected' : ''; ?>>12:00 PM - 01:00 PM</option>
                    <option <?php echo ($schedule['breakTime'] == '01:00 PM - 02:00 PM') ? 'selected' : ''; ?>>01:00 PM - 02:00 PM</option>
                  </select>
                  <span class="input__title">Break Time</span>
                  <div id="edit_break_time-error" class="error-message text-danger"></div>
                </div>
              </div>
              <button type="submit" class="btn__submit__modal submitScheduleForm"><ion-icon class="icon" name="paper-plane-outline"></ion-icon>Submit</button>
            </form>
            <?php
        }
    }

    public function updateSchedule(Request  $request)
    {
        date_default_timezone_set('Asia/Manila');
        $schedulerModel = new \App\Models\schedulerModel();
        //data
        $validator = Validator::make($request->all(),[
            'edit_type_schedule'=>'required',
            'edit_from_time'=>'required',
            'edit_to_time'=>'required',
            'edit_break_time'=>'required'
        ]);

        if ($validator->fails()) {
            // Return validation errors as JSON
            return response()->json(['errors' => $validator->errors()]);
        }
        else
        {
            $mergeHour = $request->edit_from_time.' - '.$request->edit_to_time;
            $schedulerModel::where('scheduleID',$request->scheduleID)
                            ->update(['scheduleType'=>$request->edit_type_schedule,'hours'=>$mergeHour,'breakTime'=>$request->edit_break_time]);
            //create log record
            $logModel = new \App\Models\logModel();
            $date = date('Y-m-d h:i:s a');
            $data = ['accountID'=>session('user_id'),'Date'=>$date,'Activity'=>'Update the schedule'];
            $logModel->create($data);
            return response()->json(['success' => 'Great! Successfully saved']);
        }
    }
    

    public function addJob(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $designationModel = new \App\Models\designationModel();
        //data
        $validator = Validator::make($request->all(),[
            'job_title'=>'required|unique:tbljob,jobTitle',
            'jobLevel'=>'required',
            'responsibilities'=>'required',
        ]);

        if ($validator->fails()) {
            // Return validation errors as JSON
            return response()->json(['errors' => $validator->errors()]);
        }
        else
        {
            $data = ['jobTitle'=>$request->job_title,'jobLevel'=>$request->jobLevel,'Responsibilities'=>$request->responsibilities,'accountID'=>session('user_id')];
            $designationModel->create($data);
            //create log record
            $logModel = new \App\Models\logModel();
            $date = date('Y-m-d h:i:s a');
            $data = ['accountID'=>session('user_id'),'Date'=>$date,'Activity'=>'Add new job title and responsibilities'];
            $logModel->create($data);
            return response()->json(['success' => 'Great! Successfully saved']);
        }
    }

    public function editJob(Request $request)
    {
        $designationModel = new \App\Models\designationModel();
        $job = $designationModel->WHERE('jobID',$request->value)->first();
        if($job)
        {
          ?>
          <form method="POST" class="form__modal" id="frmEditDesignation">
            <input type="hidden" name="_token" value="<?php echo csrf_token()?>"/>
            <input type="hidden" name="jobID" value="<?php echo $job['jobID']?>"/>
            <div class="input__form__modal__box">
              <div class="input__box">
                <input
                  class="information__input"
                  placeholder="Enter job title"
                  name="edit_job_title" value="<?php echo $job['jobTitle']?>"
                />
                <span class="input__title">Job Title</span>
                <div id="edit_job_title-error" class="error-message text-danger"></div>
              </div>
              <div class="input__box pos__rel">
                <select class="information__input" name="edit_jobLevel" id="jobLevel">
                  <option value="" disabled selected>
                    Select Job Level
                  </option>
                    <option <?php echo ($job['jobLevel'] == 'Rank and File') ? 'selected' : ''; ?>>Rank and File</option>
                    <option <?php echo ($job['jobLevel'] == 'Specialist') ? 'selected' : ''; ?>>Specialist</option>
                    <option <?php echo ($job['jobLevel'] == 'Officer') ? 'selected' : ''; ?>>Officer</option>
                    <option <?php echo ($job['jobLevel'] == 'Supervisor') ? 'selected' : ''; ?>>Supervisor</option>
                    <option <?php echo ($job['jobLevel'] == 'Managerial') ? 'selected' : ''; ?>>Managerial</option>
                    <option <?php echo ($job['jobLevel'] == 'Executive') ? 'selected' : ''; ?>>Executive</option>
                </select>
                <ion-icon class="pos__abs icon__select__designation" name="chevron-down-outline"></ion-icon>
                <span class="input__title">Job Level</span>
                <div id="edit_jobLevel-error" class="error-message text-danger"></div>
              </div>
              <div class="input__box">
                <textarea
                style="height: 15rem"
                  class="information__input"
                  placeholder="Enter responsibilities"
                  name="edit_responsibilities"><?php echo $job['Responsibilities']?></textarea>
                <span class="input__title">Responsibilities</span>
                <div id="edit_responsibilities-error" class="error-message text-danger"></div>
              </div>
            </div>
            <button type="submit" class="btn__submit__modal submitJobForm"><ion-icon class="icon" name="paper-plane-outline"></ion-icon>Submit</button>
          </form>
          <?php
        }
    }

    public function updateJob(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $designationModel = new \App\Models\designationModel();
        //data
        $validator = Validator::make($request->all(),[
            'edit_job_title'=>'required',
            'edit_jobLevel'=>'required',
            'edit_responsibilities'=>'required',
        ]);

        if ($validator->fails()) {
            // Return validation errors as JSON
            return response()->json(['errors' => $validator->errors()]);
        }
        else
        {
          $designationModel::where('jobID',$request->jobID)
              ->update(['jobTitle'=>$request->edit_job_title,'jobLevel'=>$request->edit_jobLevel,'Responsibilities'=>$request->edit_responsibilities]);
          //create log record
          $logModel = new \App\Models\logModel();
          $date = date('Y-m-d h:i:s a');
          $data = ['accountID'=>session('user_id'),'Date'=>$date,'Activity'=>'Update job title and responsibilities'];
          $logModel->create($data);
          return response()->json(['success' => 'Great! Successfully applied changes']);
        }
    }

    public function generateFirstLeaveCredit()
    {
        $leaveSetupModel = new \App\Models\leaveSetupModel();
        $employeeModel = new \App\Models\employeeModel();
        $employee = $employeeModel->all();
        foreach($employee as $row)
        {
            $hire_date = $row['dateHired'];
            
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
