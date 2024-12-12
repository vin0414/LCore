<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_leave extends Model
{
    use HasFactory;
    protected $table = "tbl_leave";
    protected $primaryKey = "leaveID";
    protected $fillable = ['leaveName', 'gender','civilStatus','employmentStatus'];
}
