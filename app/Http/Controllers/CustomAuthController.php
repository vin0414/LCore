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
            'username'=>'required',
            'password'=>'required'
        ]);
        $account = accountModel::where('Username', $request->username)->first();
        if ($account && Hash::check($request->password, $account->Password))
        {
            session(['user_id' => $account->accountID]);
            session(['fullname'=>$account->Fullname]);
            Auth::guard('user')->login($account);
            return redirect()->intended('hr/overview');
        }
        return redirect('/')->with('message','Invalid Username or Password');
    }

    public function logout(Request $request)
    {
        // Clear session and logout user
        Auth::guard('user')->logout();
        return redirect("/");
    }
}
