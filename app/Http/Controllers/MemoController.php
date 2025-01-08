<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MemoController extends Controller
{
    public function saveMemo(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $memoModel = new \App\Models\memoModel();
        $employeeModel = new \App\Models\employeeModel();
        $memoReceiveModel = new \App\Models\memoReceiveModel();
        $departmentModel = new \App\Models\departmentModel();
        //data
        $request->validate([
            'memo_title'=>'required',
            'subject'=>'required',
            'reference'=>'nullable',
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
        $data = ['Date'=>$request->date,'Title'=>$request->memo_title,'Reference'=>$request->reference,
                'Sender'=>$request->sender,'Recipient'=>$request->recipient,'Subject'=>$request->subject,
                'Details'=>$request->details,'File'=>$filename,'accountID'=>session('user_id'),'Status'=>$status];
        $memoModel->create($data);
        //get the memoID
        $memo = $memoModel->WHERE('Date',$request->date)
                          ->WHERE('Subject',$request->subject)->first();
        //generate today date
        $today = date('Y-m-d');
        //get all the recipient
        if($request->recipient=="All Employees")
        {
            $employee = $employeeModel->all();
            foreach($employee as $row)
            {
                $data = ['employeeID'=>$row['employeeID'],'memoID'=>$memo['memoID'],'dateReceived'=>$today,'read_status'=>'No'];
                $memoReceiveModel->create($data);
            }
            //send email
        }
        else
        {
            $department = $departmentModel->WHERE('departmentName',$request->recipient)->first();
            $employee = $employeeModel->WHERE('departmentID',$department['departmentID'])->get();
            foreach($employee as $row)
            {
                $data = ['employeeID'=>$row['employeeID'],'memoID'=>$memo['memoID'],'dateReceived'=>$today,'read_status'=>'No'];
                $memoReceiveModel->create($data);
            }
            //send email
        }
        //create log record
        $logModel = new \App\Models\logModel();
        $date = date('Y-m-d h:i:s a');
        $data = ['accountID'=>session('user_id'),'Date'=>$date,'Activity'=>'Posted new memo'];
        $logModel->create($data);
        return redirect('/hr/memo')->with('success','Great! Successfully added');
    }

    public function editMemo(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $memoModel = new \App\Models\memoModel();
        //data
        $request->validate([
            'memo_title'=>'required',
            'subject'=>'required',
            'reference'=>'nullable',
            'date'=>'required',
            'sender'=>'required',
            'recipient'=>'required',
            'details'=>'required',
        ]);
        $file = $request->file('file');$filename="";
        if ($request->hasFile('file') && $request->file('file')->isValid()) 
        {
            $filename = date('Ymdhis').$file->getClientOriginalName();
            // Define the path where the image should be saved
            $file->move('memo/',$filename);
            //update
            $memoModel::where('memoID',$request->memoID)
                ->update(['Date'=>$request->date,'Title'=>$request->memo_title,'Reference'=>$request->reference,
                'Sender'=>$request->sender,'Recipient'=>$request->recipient,'Subject'=>$request->subject,
                'Details'=>$request->details,'File'=>$filename]);
        }
        else
        {
            $memoModel::where('memoID',$request->memoID)
                ->update(['Date'=>$request->date,'Title'=>$request->memo_title,'Reference'=>$request->reference,
                'Sender'=>$request->sender,'Recipient'=>$request->recipient,'Subject'=>$request->subject,
                'Details'=>$request->details]);
        }
        //create log record
        $logModel = new \App\Models\logModel();
        $date = date('Y-m-d h:i:s a');
        $data = ['accountID'=>session('user_id'),'Date'=>$date,'Activity'=>'Update the posted memo'];
        $logModel->create($data);
        return redirect('/hr/memo')->with('success','Great! Successfully applied changes');
    }

    public function archive(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $memoModel = new \App\Models\memoModel();
        $memoModel::WHERE('memoID',$request->value)->update(['Status'=>0]);
        //create log record
        $logModel = new \App\Models\logModel();
        $date = date('Y-m-d h:i:s a');
        $data = ['accountID'=>session('user_id'),'Date'=>$date,'Activity'=>'Moved to archive'];
        $logModel->create($data);
        echo "success";
    }

    public function restore(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $memoModel = new \App\Models\memoModel();
        $memoModel::WHERE('memoID',$request->value)->update(['Status'=>1]);
        //create log record
        $logModel = new \App\Models\logModel();
        $date = date('Y-m-d h:i:s a');
        $data = ['accountID'=>session('user_id'),'Date'=>$date,'Activity'=>'Restore the memo'];
        $logModel->create($data);
        echo "success";
    }

    public function saveBroadcast(Request $request)
    {
        
    }
}
