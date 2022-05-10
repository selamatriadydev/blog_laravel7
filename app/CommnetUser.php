<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Laravel\Sanctum\HasApiTokens;
// use Laravel\Sanctum\NewAccessToken;

class CommnetUser extends Model
{
    // use HasApiTokens;

    protected $table = 'comments_users';
    protected $filable = ['name', 'email', 'website'];


    //represh token sanctum
    // public function createToken(string $name, $abilities = ['*'])
    // {
    //     $token = $this->tokens()->create([
    //         'name' => $name,
    //         'token' => hash('sha256', $plainTextToken = Str::random(40)),
    //         'abilities' => $abilities,
    //         'expired_at' => now()->addHours(3)  
    //     ]);
    //     return new NewAccessToken($token, $plainTextToken);
    // }

}
