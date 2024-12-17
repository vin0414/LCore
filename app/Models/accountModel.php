<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

class accountModel extends Authenticatable
{
    protected $table = "tblaccount";
    protected $primaryKey = "accountID";
    protected $fillable = ['Username', 'Password','Fullname','Designation','Email','Status','Role','Token'];
    protected $hidden = ['Password'];
}
