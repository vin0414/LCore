<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class certificateModel extends Model
{
    use HasFactory;
    protected $table = "tblcertificate";
    protected $primaryKey = "certificateID";
    protected $fillable = ['employeeID', 'Title','Venue','From','To'];
}