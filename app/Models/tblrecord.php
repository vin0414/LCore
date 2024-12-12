<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tblrecord extends Model
{
    use HasFactory;
    protected $table = "tblrecord";
    protected $primaryKey = "recordID";
    protected $fillable = ['employeeID','dateHired','Designation','officeID','employmentStatus','end_date','cost','Remarks'];
}
