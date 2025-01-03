<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class scheduleFileModel extends Model
{
    use HasFactory;
    protected $table = "tblemployee_new_schedule";
    protected $primaryKey = "esID";
    protected $fillable = ['employeeID','attachment','scheduleID'];
}
