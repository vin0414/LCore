<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class aboutModel extends Model
{
    use HasFactory;
    protected $table = "tblcompany";
    protected $primaryKey = "companyID";
    protected $fillable = ['companyName', 'companyDetails','companyLogo'];
}
