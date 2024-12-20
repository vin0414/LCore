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
        $request->validate([
            'username'=>'required|min:6|max:20',
            'password'=>'required'
        ]);
        $account = accountModel::where('Username', $request->username)->WHERE('Status',1)->first();
        if ($account && Hash::check($request->password, $account->Password))
        {
            session(['user_id' => $account->accountID]);
            session(['fullname'=>$account->Fullname]);
            session(['designation'=>$account->Designation]);
            session(['role'=>$account->Role]);
            Auth::guard('user')->login($account);
            return redirect()->intended('hr/overview');
        }
        return redirect('/')->with('message','Invalid Username or Password');
    }

    public function logout()
    {
        // Clear session and logout user
        Auth::guard('user')->logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect("/");
    }
}
