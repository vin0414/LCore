<?php

namespace App\Http\Controllers;
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
        $employeeModel = new \App\Models\employeeModel();
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
            'email_address'=>'required',
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
        //generate company ID
        $companyID = "LC-".str_pad(($employee+1), 4, '0', STR_PAD_LEFT);
        $employeePIN = "1234";
        $status = 1;
        $imagePath = "";
        //save the image
        if($request->hasFile('image'))
        {
            $imagePath = $request->file('image')->store('assets/profile/', 'public');
        }
        $data = ['companyID'=>$companyID,'employeePIN'=>$employeePIN,'surName'=>$request->surname,'firstName'=>$request->firstname,'middleName'=>$request->middlename,'suffix'=>$request->suffix,
                'gender'=>$request->gender,'civilStatus'=>$request->civil_status,'dob'=>$request->date_of_birth,'address'=>$request->address,'religion'=>$request->religion,'emailAddress'=>$request->email_address,
                'contactNumber'=>$request->contact_number,'education'=>$request->education,'dateHired'=>$request->date_hired,'designation'=>$request->designation,'employmentStatus'=>$request->employment_status,
                'regularizationDate'=>$request->regularization_date,'officeID'=>$request->office,'departmentID'=>$request->department,'jobLevel'=>$request->job_level,'companyPhone'=>$request->company_phone,
                'sssNo'=>$request->sss_no,'philhealthNo'=>$request->ph_no,'hdmfNo'=>$request->hdmf_no,'tin'=>$request->tin,
                'accountNumber'=>$request->account_number,'employeeStatus'=>$status,'Image'=>$imagePath,'employeeToken'=>$request->_token];
        $employeeModel->create($data);
        return redirect('/hr/employee')->with('success','Great! Successfully added');
    }
}
