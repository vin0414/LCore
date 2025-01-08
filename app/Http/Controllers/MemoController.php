<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MemoController extends Controller
{
    public function saveMemo(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $memoModel = new \App\Models\memoModel();
        //data
        $request->validate([
            'memo_title'=>'required',
            'subject'=>'required',
            'reference'=>'required',
            'date'=>'required',
            'sender'=>'required',
            'recipient'=>'required',
            'details'=>'required',
            'file'=>'required|file|max:10240'
        ]);
        $status = 1;
        $file = $request->file('file');$filename="";
        if ($request->hasFile('file') && $request->file('file')->isValid()) 
        {
            $filename = date('Ymdhis').$file->getClientOriginalName();
            // Define the path where the image should be saved
            $file->move('memo/',$filename);
        }
        $data = ['Date'=>$request->date,'Title','Reference',
                'Sender','Recipient','Subject',
                'Details','File','accountID','Status'];
        //create log record
        $logModel = new \App\Models\logModel();
        $date = date('Y-m-d h:i:s a');
        $data = ['accountID'=>session('user_id'),'Date'=>$date,'Activity'=>'Posted new memo'];
        $logModel->create($data);
    }
}
