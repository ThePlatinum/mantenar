<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trail extends Model
{
  use HasFactory;
  protected $guarded = ['id'];

  protected $casts = [ 'email_verified_at' => 'datetime' ];
  
  public function user() {
    return $this->hasOne(User::class, 'id', 'author_user_id');
  }
}
