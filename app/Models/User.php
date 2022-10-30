<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Observers\UserObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
  use HasApiTokens, HasFactory, Notifiable, SoftDeletes;


  public static function boot(){
    parent::boot();
    parent::observe(new UserObserver);
  }
  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $guarded = ['id', 'email_verified_at'];

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
    'is_admin' => 'boolean',
  ];

  public function sent() {
    return $this->hasMany(Share::class, 'author_user_id');
  }

  public function recieved() {
    return $this->hasManyThrough(Share::class, Viewer::class, 'user_id', 'id', 'id', 'share_id');
  }

  public function getFullnameAttribute(){
    return $this->firstname .' '. $this->lastname;
  }

  protected $appends = [
    'fullname'
  ];
}
