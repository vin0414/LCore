<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class employeeLeaveModel extends Model
{
    use HasFactory;
    protected $table = "tblemployee_leave";
    protected $primaryKey = "empleaveID";
    protected $fillable = ['employeeID','leaveTypeID', 'From','To','Days','Details','Status','Attachment'];
}
