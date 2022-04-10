<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable=['title', 'file_path', 'category_id', 'sort', 'is_published'];
    protected $table='project';
    protected $appends = ['category_link'];

    public function category(){
        return $this->belongsTo('App\ProjectCategory', 'category_id', 'id');
    } 

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }
    public function getCategoryLinkAttribute()
    {
        $get_name = $this->category()->first();
        if($get_name){
            return $get_name->link;
        }else{
            return false;
        }
    }
}
