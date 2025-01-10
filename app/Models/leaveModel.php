<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class leaveModel extends Model
{
    use HasFactory;
    protected $table = "tbl_leave";
    protected $primaryKey = "leaveID";
    protected $fillable = ['leaveTypeID','leaveName', 'gender','civilStatus','employmentStatus'];
}
