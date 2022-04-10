<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menus extends Model
{
    protected $fillable = ['parrent_id', 'link', 'title', 'sort'];
    protected $table = 'menus';

    public function children(){
        return $this->hasMany('App\Menus', 'parent_id', 'id');
    }
    public function sub(){
        return $this->belongsTo('App\Menus', 'parent_id', 'id');
    }
    public function aksesData(){
        return $this->hasMany('App\MenuData', 'menus_id', 'id');
    }


}
