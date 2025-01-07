<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class memoModel extends Model
{
    use HasFactory;
    protected $table = "tblmemo";
    protected $primaryKey = "memoID";
    protected $fillable = ['Date','Title','Reference','Sender','Recipient','Subject','Details','File','accountID','Status'];
}
