<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\accountModel;

class CustomAuthController extends Controller
{
    //
    public function auth(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $logModel = new \App\Models\logModel();
        $date = date('Y-m-d h:i:s a');
        $request->validate([
            'username'=>'required|min:6|max:20',
            // 'password'=>'required|min:8|regex:/[A-Z]/|regex:/[a-z]/|regex:/[0-9]/|regex:/[@$!%*?&]/'
        ]);
        $account = accountModel::where('Username', $request->username)->WHERE('Status',1)->first();
        if ($account && Hash::check($request->password, $account->Password))
        {
            session(['user_id' => $account->accountID]);
            session(['fullname'=>$account->Fullname]);
            session(['designation'=>$account->Designation]);
            session(['role'=>$account->Role]);
            //create log record
            $data = ['accountID'=>$account->accountID,'Date'=>$date,'Activity'=>'Logged On'];
            $logModel->create($data);
            Auth::guard('user')->login($account);
            return redirect()->intended('hr/overview');
        }
        return redirect('/')->with('message','Invalid Username or Password');
    }

    public function logout()
    {
        date_default_timezone_set('Asia/Manila');
        $logModel = new \App\Models\logModel();
        $date = date('Y-m-d h:i:s a');
        //create log record
        $data = ['accountID'=>session('user_id'),'Date'=>$date,'Activity'=>'Logged Out'];
        $logModel->create($data);
        // Clear session and logout user
        Auth::guard('user')->logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect("/");
    }
}
