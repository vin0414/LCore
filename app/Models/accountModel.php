<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class accountModel extends Model
{
    use HasFactory;
    protected $table = "tblaccount";
    protected $primaryKey = "accountID";
    protected $fillable = ['Username', 'Password','Fullname','Designation','Email','Status','Role','Token'];
    protected $hidden = ['Password'];
}
