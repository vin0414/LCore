<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tblemployee extends Model
{
    use HasFactory;
    protected $table = "tblemployee";
    protected $primaryKey = "employeeID";
    protected $fillable = ['companyID','employeePIN','surName','firstName','middleName','suffix',
                            'gender','civilStatus','dob','address','religion','emailAddress','contactNumber',
                            'dateHired','designation','employmentStatus','officeID','departmentID',
                            'sssNo','philhealthNo','hdmfNo','tin',
                            'accountNumber','employeeStatus','Image','employeeToken'];
}
