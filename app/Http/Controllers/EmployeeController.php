<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EmployeeController extends Controller
{

    public function fetchDepartment(Request $request)
    {
        $departmentModel = new \App\Models\departmentModel();
        $department = $departmentModel->WHERE('officeID',$request->value)->get();
        foreach($department as $row)
        {
            echo "<option value=".$row['departmentID']." {{ old('department') == ".$row['departmentID']." ? 'selected' : '' }}>".$row['departmentName']."</option>";
        }
    }

    public function createFolder(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'folder'=>'required',
        ]);

        if ($validator->fails()) {
            // Return validation errors as JSON
            return response()->json(['errors' => $validator->errors()]);
        }
        else
        {
            $folderPath = public_path('documents/'.$request->folder);
            if (!file_exists($folderPath))
            {
                mkdir($folderPath, 0777, true);
            }
            return response()->json(['success'=>'Successfully created']);
        }
    }

    public function saveEmployee(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $employeeModel = new \App\Models\employeeModel();
        $recordModel = new \App\Models\recordModel();
        $employee = $employeeModel->count();

        $request->validate([
            'surname'=>'required',
            'firstname'=>'required',
            'middlename'=>'required',
            'suffix'=>'nullable',
            'gender'=>'required',
            'civil_status'=>'required',
            'date_of_birth'=>'required',
            'religion'=>'required',
            'contact_number'=>'required',
            'email_address'=>'required|email|unique:tblemployee,emailAddress',
            'address'=>'required',
            'education'=>'required',
            'date_hired'=>'required',
            'designation'=>'required',
            'company_phone'=>'nullable',
            'office'=>'required',
            'department'=>'required',
            'job_level'=>'nullable',
            'allowance_rates'=>'required',
            'regularization_date'=>'nullable',
            'payroll_payment'=>'required',
            'account_number'=>'nullable',
            'sss_no'=>'nullable',
            'philhealth_no'=>'nullable',
            'hdmf_no'=>'nullable',
            'tin'=>'nullable'
        ]);
        //generate company ID
        $companyID = "LC-".str_pad(($employee+1), 4, '0', STR_PAD_LEFT);
        $employeePIN = "1234";
        $employment_status = "Trainee";
        $status = 1;$job_level = "Rank and File";
        $cost = str_replace(",", "", $request->allowance_rates);
        $token = Str::random(32);
        //save the image
        $image = $request->file('image');$filename="";
        if ($request->hasFile('image') && $request->file('image')->isValid()) 
        {
            $filename = $image->getClientOriginalName();
            // Define the path where the image should be saved
            $image->move('Profile/',$filename);
        }
        
        $data = ['companyID'=>$companyID,'employeePIN'=>$employeePIN,'surName'=>$request->surname,'firstName'=>$request->firstname,'middleName'=>$request->middlename,'suffix'=>$request->suffix,
                'gender'=>$request->gender,'civilStatus'=>$request->civil_status,'dob'=>$request->date_of_birth,'address'=>$request->address,'religion'=>$request->religion,'emailAddress'=>$request->email_address,
                'contactNumber'=>$request->contact_number,'education'=>$request->education,'dateHired'=>$request->date_hired,'designation'=>$request->designation,'employmentStatus'=>$employment_status,
                'regularizationDate'=>$request->regularization_date,'officeID'=>$request->office,'departmentID'=>$request->department,'jobLevel'=>$job_level,'companyPhone'=>$request->company_phone,
                'salaryRate'=>$cost,'sssNo'=>$request->sss_no,'philhealthNo'=>$request->philhealth_no,'hdmfNo'=>$request->hdmf_no,'tin'=>$request->tin,
                'payMethod'=>$request->payroll_payment,'accountNumber'=>$request->account_number,'employeeStatus'=>$status,'Image'=>$filename,'employeeToken'=>$token,'scheduleID'=>1];
        $employeeModel->create($data);
        //get the employeeID from repository
        $employeeRecord = $employeeModel->WHERE('companyID',$companyID)->first();
        //save the first record of the employee
        $newData = ['employeeID'=>$employeeRecord['employeeID'],'dateHired'=>$request->date_hired,
                    'Designation'=>$request->designation,'officeID'=>$request->office,'departmentID'=>$request->department,
                    'employmentStatus'=>$employment_status,'end_date'=>'0000-00-00','cost'=>$cost,'Remarks'=>'Training','Attachment'=>''];
        $recordModel->create($newData);
        //create log record
        $logModel = new \App\Models\logModel();
        $date = date('Y-m-d h:i:s a');
        $data = ['accountID'=>session('user_id'),'Date'=>$date,'Activity'=>'Added new employee: '.$companyID];
        $logModel->create($data);
        return redirect('/hr/employee')->with('success','Great! Successfully added');
        
    }

    public function updateEmployee(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $employeeModel = new \App\Models\employeeModel();

        $request->validate([
            'surname'=>'required',
            'firstname'=>'required',
            'middlename'=>'required',
            'suffix'=>'nullable',
            'gender'=>'required',
            'civil_status'=>'required',
            'date_of_birth'=>'required',
            'religion'=>'required',
            'contact_number'=>'required',
            'email_address'=>'required|email',
            'address'=>'required',
            'education'=>'required',
            'date_hired'=>'required',
            'designation'=>'required',
            'company_phone'=>'nullable',
            'office'=>'required',
            'department'=>'required',
            'job_level'=>'required',
            'employment_status'=>'required',
            'regularization_date'=>'nullable',
            'payroll_payment'=>'required',
            'account_number'=>'nullable',
            'sss_no'=>'nullable',
            'ph_no'=>'nullable',
            'hdmf_no'=>'nullable',
            'tin'=>'nullable'
        ]);

        $image = $request->file('image');$filename="";
        if ($request->hasFile('image') && $request->file('image')->isValid()) 
        {
            $filename = $image->getClientOriginalName();
            // Define the path where the image should be saved
            $image->move('Profile/',$filename);

            $employeeModel::where('employeeID',$request->employeeID)
                            ->update(['surName'=>$request->surname,'firstName'=>$request->firstname,'middleName'=>$request->middlename,'suffix'=>$request->suffix,
                            'gender'=>$request->gender,'civilStatus'=>$request->civil_status,'dob'=>$request->date_of_birth,'address'=>$request->address,'religion'=>$request->religion,'emailAddress'=>$request->email_address,
                            'contactNumber'=>$request->contact_number,'education'=>$request->education,'dateHired'=>$request->date_hired,'designation'=>$request->designation,'employmentStatus'=>$request->employment_status,
                            'regularizationDate'=>$request->regularization_date,'officeID'=>$request->office,'departmentID'=>$request->department,'jobLevel'=>$request->job_level,'companyPhone'=>$request->company_phone,
                            'sssNo'=>$request->sss_no,'philhealthNo'=>$request->ph_no,'hdmfNo'=>$request->hdmf_no,'tin'=>$request->tin,
                            'payMethod'=>$request->payroll_payment,'accountNumber'=>$request->account_number,'Image'=>$filename]);
        }
        else
        {
            $employeeModel::where('employeeID',$request->employeeID)
                            ->update(['surName'=>$request->surname,'firstName'=>$request->firstname,'middleName'=>$request->middlename,'suffix'=>$request->suffix,
                            'gender'=>$request->gender,'civilStatus'=>$request->civil_status,'dob'=>$request->date_of_birth,'address'=>$request->address,'religion'=>$request->religion,'emailAddress'=>$request->email_address,
                            'contactNumber'=>$request->contact_number,'education'=>$request->education,'dateHired'=>$request->date_hired,'designation'=>$request->designation,'employmentStatus'=>$request->employment_status,
                            'regularizationDate'=>$request->regularization_date,'officeID'=>$request->office,'departmentID'=>$request->department,'jobLevel'=>$request->job_level,'companyPhone'=>$request->company_phone,
                            'sssNo'=>$request->sss_no,'philhealthNo'=>$request->ph_no,'hdmfNo'=>$request->hdmf_no,'tin'=>$request->tin,
                            'payMethod'=>$request->payroll_payment,'accountNumber'=>$request->account_number]);
        }
        //create log record
        $logModel = new \App\Models\logModel();
        $date = date('Y-m-d h:i:s a');
        $data = ['accountID'=>session('user_id'),'Date'=>$date,'Activity'=>'Update records of Mr/Ms '.$request->surname];
        $logModel->create($data);
        return redirect('/hr/employee')->with('success','Great! Successfully applied changes');
    }

    public function addCredit(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $creditModel = new \App\Models\creditModel();
        //data
        $employeeID = $request->employeeID;
        $item_vl = $request->item_vacation;
        $item_sl = $request->item_sick;
        //count
        $count = count($employeeID);
        for($i=0;$i<$count;$i++)
        {
            $credit = $creditModel->WHERE('employeeID',$employeeID[$i])->first();
            if(empty($credit['employeeID']))
            {
                $data = ['employeeID'=>$employeeID[$i],'Vacation'=>$item_vl[$i],'Sick'=>$item_sl[$i]];
                $creditModel->create($data);
            }
            else
            {
                $creditModel::where('creditID',$credit['creditID'])
                ->update(['Vacation'=>$item_vl[$i],'Sick'=>$item_sl[$i]]);
            }
        }
        //create log record
        $logModel = new \App\Models\logModel();
        $date = date('Y-m-d h:i:s a');
        $data = ['accountID'=>session('user_id'),'Date'=>$date,'Activity'=>'Add and/or update leave credits'];
        $logModel->create($data);
        return redirect('/hr/employee/credits')->with('success','Great! Successfully applied changes');
    }

    public function fetchEmployeeWorkHistory(Request $request)
    {
        $request->validate([
            'employeeID'=>'required'
        ]);
        $historyModel = new \App\Models\historyModel();
        $history = $historyModel->WHERE('employeeID',$request->employeeID)->get();
        if ($history->isEmpty()) 
        {
            echo "<tr><td colspan='5'><center>No history record found</center></td></tr>";
        }
        else
        {
            foreach($history as $row)
            {
                $from = Carbon::parse($row['From']);
                $to = Carbon::parse($row['To']);
                ?>  
                    <tr>
                        <td><?php echo $row['Designation'] ?></td>
                        <td><?php echo $row['Company'] ?><br/><small><?php echo $row['Address']?></small></td>
                        <td><?php echo $from->format('d F, Y')?></td>
                        <td><?php echo $to->format('d F, Y') ?></td>
                        <td style="text-align: center; position: relative;">
                            <ion-icon name="ellipsis-horizontal" class="icon__button btn__select md hydrated" role="img"></ion-icon>
                            <div class="dropdown__select">
                                <button type="button" value="<?php echo $row['historyID'] ?>" class="btn__item editWork"><ion-icon class="select__icon md hydrated" name="create-outline" role="img"></ion-icon>Edit</button>
                                <button type="button" value="<?php echo $row['historyID'] ?>" class="btn__item removeWork"><ion-icon class="select__icon md hydrated" name="trash-outline" role="img"></ion-icon>Remove</button>
                            </div>
                        </td>
                    </tr>
                <?php
            }
        }
    }

    public function addEmployeeWorkHistory(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $historyModel = new \App\Models\historyModel();
        //data
        $validator = Validator::make($request->all(),[
            'employeeID'=>'required',
            'designation'=>'required',
            'company'=>'required',
            'address'=>'required',
            'from'=>'required',
            'to'=>'required',
        ]);

        if ($validator->fails()) {
            // Return validation errors as JSON
            return response()->json(['errors' => $validator->errors()]);
        }
        else
        {
            $data = ['employeeID'=>$request->employeeID,'Designation'=>$request->designation,
                    'Company'=>$request->company,'Address'=>$request->address,
                    'From'=>$request->from,'To'=>$request->to];
            $historyModel->create($data);
            //get the companyID
            $employeeModel = new \App\Models\employeeModel();
            $employee = $employeeModel->WHERE('employeeID',$request->employeeID)->first();
            //create log record
            $logModel = new \App\Models\logModel();
            $date = date('Y-m-d h:i:s a');
            $data = ['accountID'=>session('user_id'),'Date'=>$date,'Activity'=>'Add employment records for '.$employee['companyID']];
            $logModel->create($data);
            return response()->json(['success' => 'Form submitted successfully!']);
        }
    }

    public function removeEmployeeHistory(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $historyModel = new \App\Models\historyModel();
        $historyModel::where('historyID',$request->value)
                ->update(['employeeID'=>0]);
        //create log record
        $logModel = new \App\Models\logModel();
        $date = date('Y-m-d h:i:s a');
        $data = ['accountID'=>session('user_id'),'Date'=>$date,'Activity'=>'Remove the employment history'];
        $logModel->create($data);
        echo "success";
    }

    public function editHistory(Request $request)
    {
        $historyModel = new \App\Models\historyModel();
        $history = $historyModel->WHERE('historyID',$request->value)->first();
        if($history)
        {
            ?>
            <form method="POST" class="form__modal" id="frmEditEmployment">
              <input type="hidden" name="_token" value="<?php echo csrf_token()?>"/>
              <input type="hidden" name="historyID" value="<?php echo $history['historyID'] ?>"/>
              <div class="input__form__modal__box">
                <div class="input__box">
                  <input
                    class="information__input"
                    placeholder="Enter designation"
                    name="editDesignation" value="<?php echo $history['Designation'] ?>"
                  />
                  <span class="input__title">Designation</span>
                  <div id="editDesignation-error" class="error-message text-danger"></div>
                </div>
                <div class="input__box">
                  <input
                    class="information__input"
                    placeholder="Enter company"
                    name="editCompany" value="<?php echo $history['Company'] ?>"
                  />
                  <span class="input__title">Company/Institution</span>
                  <div id="editCompany-error" class="error-message text-danger"></div>
                </div>
                <div class="input__box">
                  <textarea
                    class="information__input"
                    placeholder="Enter address"
                    name="editAddress"><?php echo $history['Address'] ?></textarea>
                  <span class="input__title">Company Address</span>
                  <div id="editAddress-error" class="error-message text-danger"></div>
                </div>
                <div class="input__box">
                  <input
                    type="date"
                    class="information__input"
                    placeholder="Enter date"
                    name="editFrom" value="<?php echo $history['From'] ?>"
                  />
                  <span class="input__title">From</span>
                  <div id="editFrom-error" class="error-message text-danger"></div>
                </div>
                <div class="input__box">
                  <input
                    type="date"
                    class="information__input"
                    placeholder="Enter date"
                    name="editTo" value="<?php echo $history['To'] ?>"
                  />
                  <span class="input__title">To</span>
                  <div id="editTo-error" class="error-message text-danger"></div>
                </div>
              </div>
              <button type="submit" class="btn__submit__modal editForm"><ion-icon class="icon" name="paper-plane-outline"></ion-icon>Save Changes</button>
            </form>
            <?php
        }
    }

    public function updateHistory(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $historyModel = new \App\Models\historyModel();
        $validator = Validator::make($request->all(),[
            'editDesignation'=>'required',
            'editCompany'=>'required',
            'editAddress'=>'required',
            'editFrom'=>'required',
            'editTo'=>'required',
        ]);

        if ($validator->fails()) {
            // Return validation errors as JSON
            return response()->json(['errors' => $validator->errors()]);
        }
        else
        {
            $historyModel::where('historyID',$request->historyID)
                ->update(['Designation'=>$request->editDesignation,
                                        'Company'=>$request->editCompany,
                                        'Address'=>$request->editAddress,
                                        'From'=>$request->editFrom,
                                        'To'=>$request->editTo]);
            //create log record
            $logModel = new \App\Models\logModel();
            $date = date('Y-m-d h:i:s a');
            $data = ['accountID'=>session('user_id'),'Date'=>$date,'Activity'=>'Update employment history'];
            $logModel->create($data);
            return response()->json(['success' => 'Form submitted successfully!']);
        }
    }

    public function fetchEmployeeCertificates(Request $request)
    {
        $request->validate([
            'employeeID'=>'required'
        ]);
        $certificateModel = new \App\Models\certificateModel();
        $certificate = $certificateModel->WHERE('employeeID',$request->employeeID)->get();
        if ($certificate->isEmpty()) 
        {
            echo "<tr><td colspan='5'><center>No certificate record found</center></td></tr>";
        }
        else
        {
            foreach($certificate as $row)
            {
                $from = Carbon::parse($row['From']);
                $to = Carbon::parse($row['To']);
                ?>  
                    <tr>
                        <td><?php echo $row['Title'] ?></td>
                        <td><?php echo $row['Venue'] ?></td>
                        <td><?php echo $from->format('d F, Y')?></td>
                        <td><?php echo $to->format('d F, Y') ?></td>
                        <td style="text-align: center; position: relative;">
                            <ion-icon name="ellipsis-horizontal" class="icon__button btn__select md hydrated" role="img"></ion-icon>
                            <div class="dropdown__select">
                                <button type="button" value="<?php echo $row['certificateID'] ?>" class="btn__item editCert"><ion-icon class="select__icon md hydrated" name="create-outline" role="img"></ion-icon>Edit</button>
                                <button type="button" value="<?php echo $row['certificateID'] ?>" class="btn__item removeCert"><ion-icon class="select__icon md hydrated" name="trash-outline" role="img"></ion-icon>Remove</button>
                            </div>
                        </td>
                    </tr>
                <?php
            }
        }
    }

    public function addEmployeeCertificates(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $certificateModel = new \App\Models\certificateModel();
        $validator = Validator::make($request->all(),[
            'employeeID'=>'required',
            'title'=>'required',
            'venue'=>'required',
            'from_date'=>'required',
            'to_date'=>'required',
        ]);

        if ($validator->fails()) {
            // Return validation errors as JSON
            return response()->json(['errors' => $validator->errors()]);
        }
        else
        {
            $data = ['employeeID'=>$request->employeeID, 'Title'=>$request->title,
                    'Venue'=>$request->venue,'From'=>$request->from_date,'To'=>$request->to_date];
            $certificateModel->create($data);
            //get the companyID
            $employeeModel = new \App\Models\employeeModel();
            $employee = $employeeModel->WHERE('employeeID',$request->employeeID)->first();
            //create log record
            $logModel = new \App\Models\logModel();
            $date = date('Y-m-d h:i:s a');
            $data = ['accountID'=>session('user_id'),'Date'=>$date,'Activity'=>'Add trainings and/or certificates for '.$employee['companyID']];
            $logModel->create($data);
            return response()->json(['success' => 'Form submitted successfully!']);
        }
    }

    public function removeEmployeeCertificates(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $certificateModel = new \App\Models\certificateModel();
        $certificateModel::where('certificateID',$request->value)
                ->update(['employeeID'=>0]);
        //create log record
        $logModel = new \App\Models\logModel();
        $date = date('Y-m-d h:i:s a');
        $data = ['accountID'=>session('user_id'),'Date'=>$date,'Activity'=>'Remove the certificate'];
        $logModel->create($data);
        echo "success";
    }

    public function editCertificate(Request $request)
    {
        $certificateModel = new \App\Models\certificateModel();
        $certificate = $certificateModel->WHERE('certificateID',$request->value)->first();
        if($certificate)
        {
            ?>
            <form method="POST" class="form__modal" id="frmEditCertificate">
              <input type="hidden" name="_token" value="<?php echo csrf_token()?>"/>
              <input type="hidden" name="certificateID" value="<?php echo $certificate['certificateID'] ?>"/>
              <div class="input__form__modal__box">
                <div class="input__box">
                  <input
                    class="information__input"
                    placeholder="Enter title"
                    name="editTitle" value="<?php echo $certificate['Title'] ?>"
                  />
                  <span class="input__title">Title</span>
                  <div id="editTitle-error" class="error-messages text-danger"></div>
                </div>
                <div class="input__box">
                  <input
                    class="information__input"
                    placeholder="Enter venue"
                    name="editVenue" value="<?php echo $certificate['Venue'] ?>"
                  />
                  <span class="input__title">Venue</span>
                  <div id="editVenue-error" class="error-messages text-danger"></div>
                </div>
                <div class="input__box">
                  <input
                    type="date"
                    class="information__input"
                    placeholder="Enter date" value="<?php echo $certificate['From'] ?>"
                    name="editFrom_date"
                  />
                  <span class="input__title">From</span>
                  <div id="editFrom_date-error" class="error-messages text-danger"></div>
                </div>
                <div class="input__box">
                  <input
                    type="date"
                    class="information__input"
                    placeholder="Enter date"
                    name="editTo_date" value="<?php echo $certificate['To'] ?>"
                  />
                  <span class="input__title">To</span>
                  <div id="editTo_date-error" class="error-messages text-danger"></div>
                </div>
              </div>
              <button class="btn__submit__modal submitForm" type="submit"><ion-icon class="icon" name="paper-plane-outline"></ion-icon>Save Changes</button>
            </form>
            <?php
        }
    }

    public function updateCertificate(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $certificateModel = new \App\Models\certificateModel();
        $validator = Validator::make($request->all(),[
            'editTitle'=>'required',
            'editVenue'=>'required',
            'editFrom_date'=>'required',
            'editTo_date'=>'required',
        ]);

        if ($validator->fails()) {
            // Return validation errors as JSON
            return response()->json(['errors' => $validator->errors()]);
        }
        else
        {
            $certificateModel::where('certificateID',$request->certificateID)
                ->update(['Title'=>$request->editTitle,'Venue'=>$request->editVenue,
                                      'From'=>$request->editFrom_date,'To'=>$request->editTo_date]);
            //create log record
            $logModel = new \App\Models\logModel();
            $date = date('Y-m-d h:i:s a');
            $data = ['accountID'=>session('user_id'),'Date'=>$date,'Activity'=>'Update training/certifications'];
            $logModel->create($data);
            return response()->json(['success' => 'Form submitted successfully!']);
        }
    }

    public function changeJobTitle(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $employeeModel = new \App\Models\employeeModel();
        $recordModel = new \App\Models\recordModel();
        $newDate = date('Y-m-d');

        $validator = Validator::make($request->all(),[
            'designation'=>'required'
        ]);

        if ($validator->fails()) {
            // Return validation errors as JSON
            return response()->json(['errors' => $validator->errors()]);
        }
        else
        {
            //get the companyID
            $employee = $employeeModel->WHERE('employeeID',$request->employeeID)->first();
            //change the designation
            $employeeModel::where('employeeID',$request->employeeID)
                ->update(['designation'=>$request->designation]);
            //get the recent record of an employee
            $record = $recordModel->WHERE('employeeID',$request->employeeID)->orderBy('recordID', 'desc')->first();
            //update the record of the employee
            $recordModel::where('recordID',$record['recordID'])
                ->update(['end_date'=>$newDate]);
            //add records in employee movement
            $newData = ['employeeID'=>$record['employeeID'],'dateHired'=>$newDate,'Designation'=>$request->designation,
                        'officeID'=>$record['officeID'],'departmentID'=>$record['departmentID'],
                        'employmentStatus'=>$record['employmentStatus'],'end_date'=>$record['end_date'],
                        'cost'=>$record['cost'],'Remarks'=>'Change Job Title','Attachment'=>''];
            $recordModel->create($newData);
            //create log record
            $logModel = new \App\Models\logModel();
            $date = date('Y-m-d h:i:s a');
            $data = ['accountID'=>session('user_id'),'Date'=>$date,'Activity'=>'Change the job title of '.$employee['companyID']];
            $logModel->create($data);
            return response()->json(['success' => 'Successfully applied']);
        }
    }

    public function jobTransfer(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $employeeModel = new \App\Models\employeeModel();
        $recordModel = new \App\Models\recordModel();
        $newDate = date('Y-m-d');

        $validator = Validator::make($request->all(),[
            'office'=>'required',
            'department'=>'required'
        ]);

        if ($validator->fails()) {
            // Return validation errors as JSON
            return response()->json(['errors' => $validator->errors()]);
        }
        else
        {
            //get the companyID
            $employee = $employeeModel->WHERE('employeeID',$request->employeeID)->first();
            //change the office and department
            $employeeModel::where('employeeID',$request->employeeID)
                ->update(['officeID'=>$request->office,'departmentID'=>$request->department]);
            //get the recent record of an employee
            $record = $recordModel->WHERE('employeeID',$request->employeeID)->orderBy('recordID', 'desc')->first();
            //update the record of the employee
            $recordModel::where('recordID',$record['recordID'])
                ->update(['end_date'=>$newDate]);
            //add records in employee movement
            $newData = ['employeeID'=>$record['employeeID'],'dateHired'=>$newDate,'Designation'=>$record['Designation'],
                        'officeID'=>$request->office,'departmentID'=>$request->department,
                        'employmentStatus'=>$record['employmentStatus'],'end_date'=>'0000-00-00',
                        'cost'=>$record['cost'],'Remarks'=>'Transferred','Attachment'=>''];
            $recordModel->create($newData);
            //create log record
            $logModel = new \App\Models\logModel();
            $date = date('Y-m-d h:i:s a');
            $data = ['accountID'=>session('user_id'),'Date'=>$date,'Activity'=>'Transferred '.$employee['companyID'].' to new assignment'];
            $logModel->create($data);
            return response()->json(['success' => 'Successfully applied']);
        }
    }

    public function salaryAdjustment(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $employeeModel = new \App\Models\employeeModel();
        $recordModel = new \App\Models\recordModel();
        $newDate = date('Y-m-d');
        //data
        $validator = Validator::make($request->all(),[
            'salary'=>'required',
            'document'=>'required|file|max:10240'
        ]);

        if ($validator->fails()) {
            // Return validation errors as JSON
            return response()->json(['errors' => $validator->errors()]);
        }
        else
        {
            $cost = str_replace(",", "", $request->salary);
            $file = $request->file('document');$filename="";
            if ($request->hasFile('document') && $request->file('document')->isValid()) 
            {
                $filename = date('Ymdhis').$file->getClientOriginalName();
                // Define the path where the image should be saved
                $file->move('attachment/',$filename);
            }
            //get the companyID
            $employee = $employeeModel->WHERE('employeeID',$request->employeeID)->first();
            //change the salary
            $employeeModel::where('employeeID',$request->employeeID)
                ->update(['salaryRate'=>$cost]);
            //get the recent record of an employee
            $record = $recordModel->WHERE('employeeID',$request->employeeID)->orderBy('recordID', 'desc')->first();
            //update the record of the employee
            $recordModel::where('recordID',$record['recordID'])
                ->update(['end_date'=>$newDate]);
            //add records in employee movement
            $newData = ['employeeID'=>$record['employeeID'],'dateHired'=>$newDate,'Designation'=>$record['Designation'],
                        'officeID'=>$record['officeID'],'departmentID'=>$record['departmentID'],
                        'employmentStatus'=>$record['employmentStatus'],'end_date'=>'0000-00-00',
                        'cost'=>$cost,'Remarks'=>'Salary Adjustment','Attachment'=>$filename];
            $recordModel->create($newData);
            //create log record
            $logModel = new \App\Models\logModel();
            $date = date('Y-m-d h:i:s a');
            $data = ['accountID'=>session('user_id'),'Date'=>$date,'Activity'=>'Salary adjustment for '.$employee['companyID']];
            $logModel->create($data);
            return response()->json(['success' => 'Successfully applied']);
        }
    }

    public function employeeDemotion(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $employeeModel = new \App\Models\employeeModel();
        $recordModel = new \App\Models\recordModel();
        $designationModel = new \App\Models\designationModel();
        $newDate = date('Y-m-d');
        //data
        $validator = Validator::make($request->all(),[
            'new_job_title'=>'required',
            'new_rate'=>'required',
            'attachments'=>'required|file|max:10240'
        ]);

        if ($validator->fails()) {
            // Return validation errors as JSON
            return response()->json(['errors' => $validator->errors()]);
        }
        else
        {
            $cost = str_replace(",", "", $request->new_rate);
            $file = $request->file('attachments');$filename="";
            if ($request->hasFile('attachments') && $request->file('attachments')->isValid()) 
            {
                $filename = date('Ymdhis').$file->getClientOriginalName();
                // Define the path where the image should be saved
                $file->move('attachment/',$filename);
            }
            //get the job level
            $job = $designationModel->WHERE('jobTitle',$request->new_job_title)->first();
            //get the companyID
            $employee = $employeeModel->WHERE('employeeID',$request->employeeID)->first();
            //change the job title and level
            $employeeModel::where('employeeID',$request->employeeID)
                ->update(['designation'=>$request->new_job_title,'jobLevel'=>$job['jobLevel'],'salaryRate'=>$cost]);
            //get the recent record of an employee
            $record = $recordModel->WHERE('employeeID',$request->employeeID)->orderBy('recordID', 'desc')->first();
            //update the record of the employee
            $recordModel::where('recordID',$record['recordID'])
                ->update(['end_date'=>$newDate]);
            //add records in employee movement
            $newData = ['employeeID'=>$record['employeeID'],'dateHired'=>$newDate,'Designation'=>$request->new_job_title,
                        'officeID'=>$record['officeID'],'departmentID'=>$record['departmentID'],
                        'employmentStatus'=>$record['employmentStatus'],'end_date'=>'0000-00-00',
                        'cost'=>$cost,'Remarks'=>'Demoted','Attachment'=>$filename];
            $recordModel->create($newData);
            //create log record
            $logModel = new \App\Models\logModel();
            $date = date('Y-m-d h:i:s a');
            $data = ['accountID'=>session('user_id'),'Date'=>$date,'Activity'=>'Employee : '.$employee['companyID'].' is demoted to '.$request->job_title];
            $logModel->create($data);
            return response()->json(['success' => 'Successfully applied']);
        }
    }

    public function changeSchedule(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $employeeModel = new \App\Models\employeeModel();
        $recordModel = new \App\Models\recordModel();
        $newDate = date('Y-m-d');
        //data
        $validator = Validator::make($request->all(),[
            'schedule'=>'required',
            'file'=>'required|file|max:10240'
        ]);

        if ($validator->fails()) {
            // Return validation errors as JSON
            return response()->json(['errors' => $validator->errors()]);
        }
        else
        {
            $file = $request->file('file');$filename="";
            if ($request->hasFile('file') && $request->file('file')->isValid()) 
            {
                $filename = date('Ymdhis').$file->getClientOriginalName();
                // Define the path where the image should be saved
                $file->move('attachment/',$filename);
            }
            //get the companyID
            $employee = $employeeModel->WHERE('employeeID',$request->employeeID)->first();
            //change the schedule
            $employeeModel::where('employeeID',$request->employeeID)
                ->update(['scheduleID'=>$request->schedule]);
            //get the recent record of an employee
            $record = $recordModel->WHERE('employeeID',$request->employeeID)->orderBy('recordID', 'desc')->first();
            //update the record of the employee
            $recordModel::where('recordID',$record['recordID'])
                ->update(['end_date'=>$newDate]);
            //add records in employee movement
            $newData = ['employeeID'=>$record['employeeID'],'dateHired'=>$newDate,'Designation'=>$record['Designation'],
                        'officeID'=>$record['officeID'],'departmentID'=>$record['departmentID'],
                        'employmentStatus'=>$record['employmentStatus'],'end_date'=>'0000-00-00',
                        'cost'=>$record['cost'],'Remarks'=>'Change Schedule','Attachment'=>$filename];
            $recordModel->create($newData);
            //create log record
            $logModel = new \App\Models\logModel();
            $date = date('Y-m-d h:i:s a');
            $data = ['accountID'=>session('user_id'),'Date'=>$date,'Activity'=>'Change schedule for '.$employee['companyID']];
            $logModel->create($data);
            return response()->json(['success' => 'Successfully applied']);
        }
    }

    public function employeePromotion(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $employeeModel = new \App\Models\employeeModel();
        $recordModel = new \App\Models\recordModel();
        $designationModel = new \App\Models\designationModel();
        $newDate = date('Y-m-d');
        //data
        $validator = Validator::make($request->all(),[
            'job_title'=>'required',
            'rate'=>'required',
            'attachment'=>'required|file|max:10240'
        ]);

        if ($validator->fails()) {
            // Return validation errors as JSON
            return response()->json(['errors' => $validator->errors()]);
        }
        else
        {
            $cost = str_replace(",", "", $request->rate);
            $file = $request->file('attachment');$filename="";
            if ($request->hasFile('attachment') && $request->file('attachment')->isValid()) 
            {
                $filename = date('Ymdhis').$file->getClientOriginalName();
                // Define the path where the image should be saved
                $file->move('attachment/',$filename);
            }
            //get the job level
            $job = $designationModel->WHERE('jobTitle',$request->job_title)->first();
            //get the companyID
            $employee = $employeeModel->WHERE('employeeID',$request->employeeID)->first();
            //change the job title and level
            $employeeModel::where('employeeID',$request->employeeID)
                ->update(['designation'=>$request->job_title,'jobLevel'=>$job['jobLevel'],'salaryRate'=>$cost]);
            //get the recent record of an employee
            $record = $recordModel->WHERE('employeeID',$request->employeeID)->orderBy('recordID', 'desc')->first();
            //update the record of the employee
            $recordModel::where('recordID',$record['recordID'])
                ->update(['end_date'=>$newDate]);
            //add records in employee movement
            $newData = ['employeeID'=>$record['employeeID'],'dateHired'=>$newDate,'Designation'=>$request->job_title,
                        'officeID'=>$record['officeID'],'departmentID'=>$record['departmentID'],
                        'employmentStatus'=>$record['employmentStatus'],'end_date'=>'0000-00-00',
                        'cost'=>$cost,'Remarks'=>'Promotion','Attachment'=>$filename];
            $recordModel->create($newData);
            //create log record
            $logModel = new \App\Models\logModel();
            $date = date('Y-m-d h:i:s a');
            $data = ['accountID'=>session('user_id'),'Date'=>$date,'Activity'=>'Employee : '.$employee['companyID'].' is promoted to '.$request->job_title];
            $logModel->create($data);
            return response()->json(['success' => 'Successfully applied']);
        }
    }

    public function employeeResign(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $employeeModel = new \App\Models\employeeModel();
        $recordModel = new \App\Models\recordModel();
        $newDate = date('Y-m-d');
        //data
        $val = $request->value;
        //get the companyID
        $employee = $employeeModel->WHERE('employeeID',$val)->first();
        //change the employee status
        $employeeModel::where('employeeID',$val)
            ->update(['employeeStatus'=>0]);
        //get the recent record of an employee
        $record = $recordModel->WHERE('employeeID',$val)->orderBy('recordID', 'desc')->first();
        //update the record of the employee
        $recordModel::where('recordID',$record['recordID'])
            ->update(['end_date'=>$newDate,'Remarks'=>'Resigned']);
        //create log record
        $logModel = new \App\Models\logModel();
        $date = date('Y-m-d h:i:s a');
        $data = ['accountID'=>session('user_id'),'Date'=>$date,'Activity'=>'Employee : '.$employee['companyID'].' tag as resigned'];
        $logModel->create($data);
        echo "success";
    }

    public function employeeTermination(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $employeeModel = new \App\Models\employeeModel();
        $recordModel = new \App\Models\recordModel();
        $newDate = date('Y-m-d');
        //data
        $val = $request->value;
        //get the companyID
        $employee = $employeeModel->WHERE('employeeID',$val)->first();
        //change the employee status
        $employeeModel::where('employeeID',$val)
            ->update(['employeeStatus'=>2]);
        //get the recent record of an employee
        $record = $recordModel->WHERE('employeeID',$val)->orderBy('recordID', 'desc')->first();
        //update the record of the employee
        $recordModel::where('recordID',$record['recordID'])
            ->update(['end_date'=>$newDate,'Remarks'=>'Terminated']);
        //create log record
        $logModel = new \App\Models\logModel();
        $date = date('Y-m-d h:i:s a');
        $data = ['accountID'=>session('user_id'),'Date'=>$date,'Activity'=>'Employee : '.$employee['companyID'].' tag as terminated'];
        $logModel->create($data);
        echo "success";
    }

    public function backOut(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $employeeModel = new \App\Models\employeeModel();
        $recordModel = new \App\Models\recordModel();
        $newDate = date('Y-m-d');
        //data
        $val = $request->value;
        //get the companyID
        $employee = $employeeModel->WHERE('employeeID',$val)->first();
        //change the employee status
        $employeeModel::where('employeeID',$val)
            ->update(['employeeStatus'=>3]);
        //get the recent record of an employee
        $record = $recordModel->WHERE('employeeID',$val)->orderBy('recordID', 'desc')->first();
        //update the record of the employee
        $recordModel::where('recordID',$record['recordID'])
            ->update(['end_date'=>$newDate,'Remarks'=>'Back-Out']);
        //create log record
        $logModel = new \App\Models\logModel();
        $date = date('Y-m-d h:i:s a');
        $data = ['accountID'=>session('user_id'),'Date'=>$date,'Activity'=>'Employee : '.$employee['companyID'].' tag as back-out'];
        $logModel->create($data);
        echo "success";
    }

    public function failure(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $employeeModel = new \App\Models\employeeModel();
        $recordModel = new \App\Models\recordModel();
        $newDate = date('Y-m-d');
        //data
        $val = $request->value;
        //get the companyID
        $employee = $employeeModel->WHERE('employeeID',$val)->first();
        //change the employee status
        $employeeModel::where('employeeID',$val)
            ->update(['employeeStatus'=>4]);
        //get the recent record of an employee
        $record = $recordModel->WHERE('employeeID',$val)->orderBy('recordID', 'desc')->first();
        //update the record of the employee
        $recordModel::where('recordID',$record['recordID'])
            ->update(['end_date'=>$newDate,'Remarks'=>'Training Failed']);
        //create log record
        $logModel = new \App\Models\logModel();
        $date = date('Y-m-d h:i:s a');
        $data = ['accountID'=>session('user_id'),'Date'=>$date,'Activity'=>'Employee : '.$employee['companyID'].' tag as failed'];
        $logModel->create($data);
        echo "success";
    }
}
