<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Post;

class Category extends Model
{
    protected $fillable = ['name'];
    protected $table = 'categories';

    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($category) {
            $category->posts()->delete();
        });
    }

    public function posts()
    {
        // return $this->hasMany(Post::class);
        return $this->hasMany('App\Post', 'category_id', 'id');
    }
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }
}
