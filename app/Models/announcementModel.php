<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class announcementModel extends Model
{
    use HasFactory;
    protected $table = "tblannouncement";
    protected $primaryKey = "announcementID";
    protected $fillable = ['dateEffective','Title','Details','Recipient','priorityLevel','File','dateExpired','accountID','Status'];
}
