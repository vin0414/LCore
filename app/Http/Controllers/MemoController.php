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
            'file'=>'required'
        ]);
    }
}
