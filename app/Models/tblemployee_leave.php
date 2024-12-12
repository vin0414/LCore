<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tblemployee_leave extends Model
{
    use HasFactory;
    protected $table = "tblemployee_leave";
    protected $primaryKey = "emp_leaveID";
    protected $fillable = ['Date','employeeID','leaveID','From','To','Days','Details','Status','Attachment'];
}
