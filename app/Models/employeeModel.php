<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class employeeModel extends Model
{
    use HasFactory;
    protected $table = "tblemployee";
    protected $primaryKey = "employeeID";
    protected $fillable = ['companyID','employeePIN','surName','firstName','middleName','suffix',
                            'gender','civilStatus','dob','address','religion','emailAddress','contactNumber','education',
                            'dateHired','designation','employmentStatus','regularizationDate','officeID','departmentID',
                            'jobLevel','companyPhone','sssNo','philhealthNo','hdmfNo','tin',
                            'accountNumber','employeeStatus','Image','employeeToken'];
}
