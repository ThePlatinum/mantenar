<?php

namespace App\Models;

use App\Observers\ShareObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Share extends Model
{
  use HasFactory;
  protected $guarded = ['id'];


  public static function boot(){
    parent::boot();
    parent::observe(new ShareObserver);
  }
}
