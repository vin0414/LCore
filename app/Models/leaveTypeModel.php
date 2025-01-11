<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class leaveTypeModel extends Model
{
    use HasFactory;
    protected $table = "tbl_leave_type";
    protected $primaryKey = "leaveTypeID";
    protected $fillable = ['leaveName'];
}
