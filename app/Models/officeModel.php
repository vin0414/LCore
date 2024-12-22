<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class officeModel extends Model
{
    use HasFactory;
    protected $table = "tbloffice";
    protected $primaryKey = "officeID";
    protected $fillable = ['officeName', 'officeAddress'];
}
