<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeAuthController extends Controller
{
    public function auth(Request $request)
    {
        $employeeModel = new \App\Models\employeeModel();
        $request->validate([
            'employeeID'=>'required|min:6|max:8',
            'password'=>'required|min:4|max:4|regex:/[0-9]/'
        ]);
        $employee = $employeeModel::where('companyID', $request->employeeID)->WHERE('employeeStatus',1)->first();
        if ($employee && ($request->password==$employee->employeePIN))
        {
            $fullname = $employee->firstName." ".$employee->middleName. " ".$request->surName." ".$employee->suffix;
            session(['user_id' => $employee->employeeID]);
            session(['fullname'=>$fullname]);
            session(['designation'=>$employee->designation]);
            session(['role'=>$employee->jobLevel]);
            Auth::guard('employee')->login($employee);
            return redirect()->intended('employee/overview');
        }
        return redirect('/portal')->with('message','Invalid Company ID or Pin');
    }

    public function signOut()
    {
        // Clear session and logout user
        Auth::guard('employee')->logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect("/portal");
    }
}
