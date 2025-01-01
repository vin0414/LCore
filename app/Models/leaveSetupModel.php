<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class leaveSetupModel extends Model
{
    use HasFactory;
    protected $table = "tbl_leave_setup";
    protected $primaryKey = "setupID";
    protected $fillable = ['Month', 'Vacation','Sick'];
}
