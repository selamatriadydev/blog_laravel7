<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = ['title'];
    protected $table='skill';

    public function skillDetail(){
        return $this->hasMany('App\SkillDetail', 'skill_id', 'id');
    }
    public function apiSkillDetail(){
        return $this->hasMany('App\SkillDetail', 'skill_id', 'id');
    }
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }
    public function getPublishedAttribute()
    {
        return ($this->is_published) ? 'Yes' : 'No';
    }
}
