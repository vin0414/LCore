<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

        $data = ['companyName'=>$request->title, 'companyDetails'=>$request->description,'companyTag'=>$request->keywords,'companyLogo'=>$filename];
        $aboutModel->create($data);

        //create log record
        $logModel = new \App\Models\logModel();
        $date = date('Y-m-d h:i:s a');
        $data = ['accountID'=>session('user_id'),'Date'=>$date,'Activity'=>'Add/update logo and application details'];
        $logModel->create($data);
        return redirect('/hr/settings');
    }
}
