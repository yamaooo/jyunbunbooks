<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Like;
use Auth;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function likes()
    {
        return $this->belongsToMany('App\Models\Novel','likes','user_id','novel_id')->withTimestamps();
    }

    public function isLike($postId)
    {
      return $this->likes()->where('novel_id',$postId)->exists();
    }

    public function like($postId)
    {
      if($this->isLike($postId)){
      } else {
        $this->likes()->attach($postId);
      }
    }

    public function unlike($postId)
    {
      if($this->isLike($postId)){
        $this->likes()->detach($postId);
      } else {
      }
    }

}
