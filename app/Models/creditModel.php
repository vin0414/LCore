<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class creditModel extends Model
{
    use HasFactory;
    protected $table = "tblcredit";
    protected $primaryKey = "creditID";
    protected $fillable = ['employeeID','Vacation','Sick','Year'];
}
