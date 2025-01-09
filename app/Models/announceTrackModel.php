<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class announceTrackModel extends Model
{
    use HasFactory;
    protected $table = "tblbroadcast_track";
    protected $primaryKey = "broadcastID";
    protected $fillable = ['employeeID','announcementID','dateReceived','read_status'];
}
