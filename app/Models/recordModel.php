<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class recordModel extends Model
{
    use HasFactory;
    protected $table = "tblrecord";
    protected $primaryKey = "recordID";
    protected $fillable = ['employeeID','dateHired','Designation','officeID','departmentID','employmentStatus','end_date','cost',
                            'Remarks','Comment_1','Comment_2','Attachment'];
    protected $casts = [
        'cost' => 'decimal:2',  // Ensures two decimal places
    ];
}
