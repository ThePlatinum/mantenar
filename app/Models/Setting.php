<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
  use HasFactory;
  protected $guarded = ['id'];

  static function org_name(){
    return Setting::where('key', 'organization_name')->first()->value;
  }
}
