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
                            'jobLevel','companyPhone','salaryRate','sssNo','philhealthNo','hdmfNo','tin',
                            'payMethod','accountNumber','employeeStatus','Image','employeeToken','scheduleID'];
    protected $casts = [
        'salaryRate' => 'decimal:2',  // Ensures two decimal places
    ];
}
