<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    // use Notifiable,SoftDeletes;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','api_token','group_id','reset_key'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            if (empty($user->api_token)) {
                $user->api_token =Str::random(40);
            }
        });

        static::deleting(function ($user) {
            $user->posts()->delete();
            $user->comments()->delete();
        });
    }
    public function posts()
    {
        // return $this->hasMany(Post::class);
        return $this->hasMany('App\Post', 'id', 'user_id');
    }
    public function comments()
    {
        // return $this->hasMany(Comment::class);
        return $this->hasMany('App\Comment', 'id', 'user_id');
    }

    public function scopeAdmin($query)
    {
        return $query->where('is_admin', true);
    }
    public function group(){
        return $this->belongsTo('App\Group', 'group_id', 'id');
    }
}
