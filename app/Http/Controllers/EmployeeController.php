<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

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
            'job_level'=>'required',
            'employment_status'=>'required',
            'salary_rates'=>'required',
            'regularization_date'=>'nullable',
            'account_number'=>'required',
            'sss_no'=>'required',
            'philhealth_no'=>'required',
            'hdmf_no'=>'required',
            'tin'=>'required'
        ]);
        //generate company ID
        $companyID = "LC-".str_pad(($employee+1), 4, '0', STR_PAD_LEFT);
        $employeePIN = "1234";
        $status = 1;
        $cost = str_replace(",", "", $request->salary_rates);
        $token = $request->session()->token();
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
                'contactNumber'=>$request->contact_number,'education'=>$request->education,'dateHired'=>$request->date_hired,'designation'=>$request->designation,'employmentStatus'=>$request->employment_status,
                'regularizationDate'=>$request->regularization_date,'officeID'=>$request->office,'departmentID'=>$request->department,'jobLevel'=>$request->job_level,'companyPhone'=>$request->company_phone,
                'salaryRate'=>$cost,'sssNo'=>$request->sss_no,'philhealthNo'=>$request->philhealth_no,'hdmfNo'=>$request->hdmf_no,'tin'=>$request->tin,
                'accountNumber'=>$request->account_number,'employeeStatus'=>$status,'Image'=>$filename,'employeeToken'=>$token];
        $employeeModel->create($data);
        //get the employeeID from repository
        $employeeRecord = $employeeModel->WHERE('companyID',$companyID)->first();
        //save the first record of the employee
        $newData = ['employeeID'=>$employeeRecord['employeeID'],'dateHired'=>$request->date_hired,
                    'Designation'=>$request->designation,'officeID'=>$request->office,
                    'employmentStatus'=>$request->employment_status,'end_date'=>'0000-00-00','cost'=>$cost];
        $recordModel->create($newData);
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
            'account_number'=>'required',
            'sss_no'=>'required',
            'ph_no'=>'required',
            'hdmf_no'=>'required',
            'tin'=>'required'
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
                            'accountNumber'=>$request->account_number,'Image'=>$filename]);
        }
        else
        {
            $employeeModel::where('employeeID',$request->employeeID)
                            ->update(['surName'=>$request->surname,'firstName'=>$request->firstname,'middleName'=>$request->middlename,'suffix'=>$request->suffix,
                            'gender'=>$request->gender,'civilStatus'=>$request->civil_status,'dob'=>$request->date_of_birth,'address'=>$request->address,'religion'=>$request->religion,'emailAddress'=>$request->email_address,
                            'contactNumber'=>$request->contact_number,'education'=>$request->education,'dateHired'=>$request->date_hired,'designation'=>$request->designation,'employmentStatus'=>$request->employment_status,
                            'regularizationDate'=>$request->regularization_date,'officeID'=>$request->office,'departmentID'=>$request->department,'jobLevel'=>$request->job_level,'companyPhone'=>$request->company_phone,
                            'sssNo'=>$request->sss_no,'philhealthNo'=>$request->ph_no,'hdmfNo'=>$request->hdmf_no,'tin'=>$request->tin,
                            'accountNumber'=>$request->account_number]);
        }
        return redirect('/hr/employee')->with('success','Great! Successfully applied changes');
    }

    public function addCredit(Request $request)
    {
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
                            <ion-icon name="ellipsis-horizontal-circle-outline" class="icon__button btn__select md hydrated" role="img"></ion-icon>
                            <div class="dropdown__select">
                                <a class="select__item"  onClick="openModalEditOverlay()"><ion-icon class="select__icon md hydrated" name="create-outline" role="img"></ion-icon>Edit</a>
                                <a class="select__item"><ion-icon class="select__icon md hydrated" name="trash-outline" role="img"></ion-icon>Remove</a>
                            </div>
                        </td>
                    </tr>
                <?php
            }
        }
    }

    public function addEmployeeWorkHistory(Request $request)
    {
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
                            <ion-icon name="ellipsis-horizontal-circle-outline" class="icon__button btn__select md hydrated" role="img"></ion-icon>
                            <div class="dropdown__select">
                                <a class="select__item"  onClick="openModalEditCertOverlay()"><ion-icon class="select__icon md hydrated" name="create-outline" role="img"></ion-icon>Edit</a>
                                <a class="select__item"><ion-icon class="select__icon md hydrated" name="trash-outline" role="img"></ion-icon>Remove</a>
                            </div>
                        </td>
                    </tr>
                <?php
            }
        }
    }

    public function addEmployeeCertificates(Request $request)
    {
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
            return response()->json(['success' => 'Form submitted successfully!']);
        }
    }
}
