<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupData extends Model
{
    protected $table = 'group_data';
    protected $fillable = ['name','group_id','menus_id', 'is_published'];

    public function group(){
        return $this->hasMany('App\GroupData', 'group_id', 'id');
    }
    public function menu(){
        return $this->hasMany('App\Menus', 'menus_id', 'id');
    }
}
