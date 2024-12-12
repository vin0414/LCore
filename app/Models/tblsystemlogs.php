<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tblsystemlogs extends Model
{
    use HasFactory;
    protected $table = "tblsystemlogs";
    protected $primaryKey = "logID";
    protected $fillable = ['accountID','Date','Activity'];
}
