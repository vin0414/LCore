<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeePortalController extends Controller
{
    public function overview()
    {
        $title = "Overview";
        $aboutModel = new \App\Models\aboutModel();
        $about = $aboutModel->first();

        $data = ['title'=>$title,'about'=>$about];
        return view('employee/index',$data);
    }
}
