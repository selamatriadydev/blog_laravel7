<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuData extends Model
{
    protected $table = 'menu_data';
    protected $fillable = ['group_id','menus_id'];

    public function group(){
        return $this->hasMany('App\GroupData', 'group_id', 'id');
    }
    public function menu(){
        return $this->belongsTo('App\Menus', 'menus_id', 'id');
    }
    public function menuRoles(){
        return $this->hasMany('App\Group', 'group_id', 'id');
    }
    public function scopeGrouped($query){
        $group_id = auth()->user()->group_id =='4' ? auth()->user()->group_id : 5;
        return $query->where('group_id', $group_id );
    }
}