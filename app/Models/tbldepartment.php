<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbldepartment extends Model
{
    use HasFactory;
    protected $table = "tbldepartment";
    protected $primaryKey = "departmentID";
    protected $fillable = ['departmentName', 'officeID'];
}
