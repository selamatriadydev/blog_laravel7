<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use SoftDeletes;
    protected $table = 'groups';
    protected $fillable = ['name','is_published'];

    public function groupData(){
        return $this->hasMany('App\GroupData', 'group_id', 'id');
    }
    public function menuRoles(){
        return $this->hasMany('App\menuData', 'menus_id', 'id');
    }
    public function menuRolesReady(){
        return $this->belongsTo('App\MenuData', 'menus_id', 'id');
    }
    public function getPublishedAttribute()
    {
        return ($this->is_published) ? 'Yes' : 'No';
    }

}
