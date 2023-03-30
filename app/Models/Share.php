<?php

namespace App\Models;

use App\Http\Controllers\SettingController;
use App\Observers\ShareObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Share extends Model
{
  use HasFactory;
  protected $guarded = ['id'];

  public static function boot(){
    parent::boot();
    parent::observe(new ShareObserver);
  }

  public function owner() {
    return $this->hasOne(User::class, 'id', 'user_id');
  }

  public function viewers() {
    return $this->hasManyThrough(User::class, Viewer::class, 'share_id', 'id', 'id', 'user_id');
  }

  public function getStorageAttribute(){
    return SettingController::size_type($this->size);
  }

  public function getFileUrlAttribute()
  {
    if ($this->file) return Storage::url($this->file);
    else return null;
  }
  protected $appends = [
    'storage', 'file_url'
  ];
}
