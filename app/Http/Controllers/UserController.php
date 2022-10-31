<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

  public function edit(Request $request) {

    $validate = Validator::make($request->all(), [
      'user_id' => 'required|exists:users,id',
      'firstname' => 'required|string',
      'lastname' => 'required|string',
      'job_title' => 'required|string',
      'role' => 'required',
    ]);

    if ($validate->fails())
      return redirect()->back()->withErrors($validate->errors())->withInput()->with('editError', $request->user_id);

    $user = User::withTrashed()->find($request->user_id);
    if($user) {
      $user->firstname = $request->firstname;
      $user->lastname = $request->lastname;
      $user->job_title = $request->job_title;
      if($request->role == 'admin') $user->is_admin = true;
      if($request->role == 'staff') $user->is_admin = false;
      $user->save();

      return redirect()->back()->with('success', 'User Edited Successfully');
    }
  }

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
