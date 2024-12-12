<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tblhistory extends Model
{
    use HasFactory;
    protected $table = "tblhistory";
    protected $primaryKey = "historyID";
    protected $fillable = ['employeeID','Designation','Company','Address','From','To'];
}
