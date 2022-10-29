<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
  public function restore(Request $request) {
    User::withTrashed()->find($request->user_id)->restore();
    Session::flash('success', 'User Account Restored!');
    return ;
  }

  public function pause(Request $request) {
    User::find($request->user_id)->delete();
    Session::flash('success', 'Account Disabled!');
    return ;
  }

  public function destroy(Request $request) {
    User::withTrashed()->find($request->user_id)->forceDelete();
    Session::flash('error', 'User Account Deleted!');
    return ;
  }
}
