<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class designationModel extends Model
{
    use HasFactory;
    protected $table = "tbljob";
    protected $primaryKey = "jobID";
    protected $fillable = ['jobTitle','jobLevel','Responsibilities','accountID'];
}
