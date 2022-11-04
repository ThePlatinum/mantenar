<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
  use HasFactory;

  protected $guarded = ['id'];

  public function share() {
    return $this->belongsTo(Share::class, 'share_id', 'id');
  }

  public function getSenderNameAttribute()
  {
    return User::find($this->author_user_id)->fullname;
  }

  public function getDateAttribute()
  {
    return date_format($this->created_at, 'd/m/Y');
  }

  public function getTimeAttribute()
  {
    return date_format($this->created_at, 'H:i');
  }

  public $appends = ['time', 'date', 'sender_name'];
}
