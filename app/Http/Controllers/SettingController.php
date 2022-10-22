<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{

  public function setup_organization()
  {
    if (Setting::org_name()) return redirect()->route('setup_administrator');

    return view('settings.setup_org');
  }

  public function setup_administrator()
  {
    if (! Setting::org_name() ) return redirect()->route('setup_organization');
    if ( User::where('is_admin', true)->get()->count() ) return redirect()->route('dashboard');

    $org_name = Setting::org_name();
    return view('settings.setup_admin', compact('org_name'));
  }

  public function update_organization(Request $request)
  {
    $validate = Validator::make($request->all(), [
      'org_name' => 'required|string'
    ]);

    if ($validate->fails())
    return redirect()->back()->withErrors($validate->errors())->withInput();

    $org_ = Setting::where('key', 'organization_name')->first();
    $org_->value = $request->org_name;
    $org_->save();

    return redirect()->route('setup_administrator')->with('success', 'Organization Created Successfuly!');
  }

  static function size_type($size) {
    $calcSize = $size / 1048576; // 1048576 => 1024 1000000 => 1000
    if ($calcSize < 1) {
      $fileSize = round(($calcSize * 100000)) / 100;
      $type = 'Kb';
    }
    elseif ($calcSize < 500) {
      $fileSize = round(($calcSize * 100)) / 100;
      $type = 'Mb';
    }else {
      $calcSize = $calcSize / 1024; 
      $fileSize = round(($calcSize * 10)) / 10;
      $type = 'Gb';
    }

    return [
      'size' => $fileSize,
      'type' => $type
    ];
  }
}
