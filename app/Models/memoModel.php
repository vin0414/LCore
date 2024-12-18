<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class memoModel extends Model
{
    use HasFactory;
    protected $table = "tblmemo";
    protected $primaryKey = "memoID";
    protected $fillable = ['Date','From','To','Subject','File','DateCreated','accountID','Status'];
}
