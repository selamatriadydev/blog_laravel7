<?php

namespace App; 

use Illuminate\Database\Eloquent\Model;

use App\Category;
use App\Comment;
use App\Tag;
use App\User;

class Post extends Model
{
    protected $fillable = [
        'title',
        'preview',
        'body',
        'slug',
        'file_path',
        'user_id',
        'category_id',
        'is_published',
    ];
    // protected $hidden = ['user_id', 'category_id','id', 'is_published'] ;
    protected $appends = ['category_name', 'user_name', 'post_tahun', 'post_date'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            if (is_null($post->user_id)) {
                $post->user_id = auth()->user()->id;
            }
        });

        static::deleting(function ($post) {
            $post->comments()->delete();
            $post->tags()->detach();
        });
    }

    public function category()
    {
        // return $this->belongsTo(Category::class);
        return $this->belongsTo('App\Category', 'category_id', 'id');
    }

    public function user()
    {
        // return $this->belongsTo(User::class);
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function views()
    {
        return $this->hasMany(PostViews::class);
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeDrafted($query)
    {
        return $query->where('is_published', false);
    }

    public function getPublishedAttribute()
    {
        return ($this->is_published) ? 'Yes' : 'No';
    }

    public function getCategoryNameAttribute()
    {
        $get_name = $this->category()->first();
        if($get_name){
            return $get_name->name;
        }else{
            return false;
        }
    }
    public function getUserNameAttribute()
    {
        $get_name = $this->user()->first();
        if($get_name){
            return $get_name->name;
        }else{
            return false;
        }
    }
    public function getPostTahunAttribute()
    {
        $get_name = $this->updated_at->format('Y');
        return $get_name;
    }
    public function getPostDateAttribute()
    {
        $get_name = $this->updated_at->format('F d, Y');
        return $get_name;
    }

}
