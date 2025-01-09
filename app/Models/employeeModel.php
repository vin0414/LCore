<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class employeeModel extends Authenticatable
{
    protected $table = "tblemployee";
    protected $primaryKey = "employeeID";
    protected $fillable = ['companyID','employeePIN','surName','firstName','middleName','suffix',
                            'gender','civilStatus','dob','address','religion','emailAddress','contactNumber','education',
                            'dateHired','designation','employmentStatus','regularizationDate','officeID','departmentID',
                            'jobLevel','companyPhone','salaryRate','sssNo','philhealthNo','hdmfNo','tin',
                            'payMethod','accountNumber','employeeStatus','Image','employeeToken','scheduleID'];
    protected $casts = [
        'salaryRate' => 'decimal:2',  // Ensures two decimal places
    ];
}
