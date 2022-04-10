<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommnetUser extends Model
{
    protected $table = 'comments_users';
    protected $filable = ['name', 'email', 'website'];


    
}
