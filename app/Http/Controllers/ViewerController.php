<?php

namespace App\Http\Controllers;

use App\Models\Share;
use App\Models\User;
use App\Models\Viewer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ViewerController extends Controller
{
  public function store(Request $request)
  {
    $share = Share::find($request->share_id);

    if ($share) {
      foreach ($request->viewers as $key => $value) {
        if (User::find($value)) Viewer::create([
          'share_id' => $share->id,
          'user_id' => $value
        ]);
      }
    return redirect()->back()->with('success', 'Viewers Added Successfuly!');
    }
  }

  public function destroy(Request $request)
  {
    $share = Share::find($request->share_id);

    if ($share) {
      Viewer::where('share_id', $share->id)->where('user_id', $request->user_id)->first()->delete();
      return Session::flash('success', 'Viewers Removed Successfuly!');
    }
  }
}
