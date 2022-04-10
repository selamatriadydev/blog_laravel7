<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SkillDetail extends Model
{
    protected $table = 'skill_detail';
    protected $fillable = ['title', 'skill_id'];
    
    public function skill(){
        return $this->hasMany('App\Skill', 'skill_id', 'id');
    }
}
