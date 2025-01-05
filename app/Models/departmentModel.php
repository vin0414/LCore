<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class departmentModel extends Model
{
    use HasFactory;
    protected $table = "tbldepartment";
    protected $primaryKey = "departmentID";
    protected $fillable = ['departmentName','departmentNumber', 'officeID'];
}
