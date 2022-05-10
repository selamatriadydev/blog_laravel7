<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Post;
use App\User;
use App\Comment;
class Comment extends Model
{
    protected $fillable = [
        'username',
        'body',
        'user_id',
        'post_id',
        'comment_user_id',
        'parent_id'
    ];
    protected $appends = ['user_admin', 'user_pengunjung', 'user_comment', 'waktu_hitung'];

    // protected static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($comment) {
    //         if (is_null($comment->user_id)) {
    //             if(auth()->user()->id){
    //                 $comment->user_id = auth()->user()->id;
    //             }
    //         }
    //     });
    // }

    public function post()
    {
        // return $this->belongsTo(Post::class);
        return $this->belongsTo('App\Post', 'post_id', 'id');
    }

    public function user()
    {
        // return $this->belongsTo(User::class);
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
    public function userbiasa()
    {
        // return $this->belongsTo(User::class);
        return $this->belongsTo('App\CommnetUser', 'comment_user_id', 'id');
    }

    public function replies()
    {
       return $this->hasMany(Comment::class, 'parent_id');
    }

    public function getUserAdminAttribute()
    {
        $get_name = $this->user()->first();
        if($get_name){
            return $get_name->name;
        }else{
            return false;
        }
    }
    public function getUserPengunjungAttribute()
    {
        $get_name = $this->userbiasa()->first();
        if($get_name){
            return $get_name->name;
        }else{
            return false;
        }
    }
    public function getUserCommentAttribute()
    {
        $user_admin = $this->user()->first();
        $userbiasa = $this->userbiasa()->first();
        if($user_admin){
            return $user_admin->name;
        }elseif($userbiasa){
            return $userbiasa->name;
        }else{
            return 'Pengunjung';
        }
    }
    public function getWaktuHitungAttribute()
    {
        $get_name = $this->created_at->diffForHumans();
        return $get_name;
    }
    // public function replies(){
    //     return $this->hasMany(Comment::class,'reply_id','id')
    // }
}
