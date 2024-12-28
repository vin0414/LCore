<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class schedulerModel extends Model
{
    use HasFactory;
    protected $table = "tblscheduler";
    protected $primaryKey = "scheduleID";
    protected $fillable = ['scheduleType','hours','breakTime','Notes'];
}
