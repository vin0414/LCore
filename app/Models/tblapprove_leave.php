<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tblapprove_leave extends Model
{
    use HasFactory;
    protected $table = "tblapprove_leave";
    protected $primaryKey = "approveID";
    protected $fillable = ['employeeID','emp_leaveID','DateReceived','Status','DateApproved','Remarks'];
}
