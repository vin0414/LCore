<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
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
        $user = accountModel::where('Username', $request->username)->first();
        if ($user && Hash::check($request->password, $user->Password))
        {
            session(['user_id' => $user->accountID]);
            session(['fullname'=>$user->Fullname]);
            Auth::loginUsingId($user->accountID);
            return redirect()->intended('hr/overview');
        }
        return redirect('/')->with('message','Invalid Username or Password');
    }

    public function logout()
    {
        // Clear session and logout user
        Auth::logout();
        session()->invalidate();
        return redirect("/");
    }
}
