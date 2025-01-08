<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class memoReceiveModel extends Model
{
    use HasFactory;
    protected $table = "tblmemo_track";
    protected $primaryKey = "trackID";
    protected $fillable = ['employeeID','memoID','dateReceived','read_status'];
}
