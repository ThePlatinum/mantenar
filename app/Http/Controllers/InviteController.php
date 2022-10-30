<?php

namespace App\Http\Controllers;

use App\Mail\Invite as MailInvite;
use App\Models\Invite;
use App\Models\Setting;
use App\Models\User;
use App\Rules\AllEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class InviteController extends Controller
{
  public function index()
  {
    $invites = Invite::withTrashed()->get();
    $users = User::withTrashed()->get()->sortByDesc('is_admin');
    return view('staffs', compact('users', 'invites'));
  }

  public function store(Request $request)
  {
    $validate = Validator::make($request->all(), [
      'invite_email' => ['required', new AllEmail],
    ]);

    if ($validate->fails()) return redirect()->back()->with('invite_error', $validate->errors()->first());

    $emails = explode(',', $request->invite_email);
    foreach($emails as $keyemail) {
      $invite = Invite::create([
        'invite_email' => str_replace(' ', '', $keyemail),
        'deleted_at' => now()->addDays(2)
      ]);
      $url = URL::temporarySignedRoute('invite', now()->addDays(2), ['invite_id' => $invite->id]);
      try {
        Mail::to($keyemail)->send(new MailInvite($invite, $url));
        return redirect()->back()->with('success', 'Invitation Sent Successfuly!');
      } catch (\Throwable $th) {
        return redirect()->back()->with('error', 'Error Occured while Sending Invite Link!');
      }
    }
  }

  public function accept($invite_id)
  {
    if (Auth::check()) return redirect()->route('dashboard');

    $org_name = Setting::org_name();
    $invite = Invite::withTrashed()->find($invite_id);
    if (!$invite || $invite->deleted_at <= now()) return view('invite.expired');
    return view('invite.accept', ['email' => $invite->invite_email, 'org_name' => $org_name, 'invite_id' => $invite_id]);
  }

  public function destroy(Request $request)
  {
    Invite::withTrashed()->find($request->invite_id)->forceDelete();
    
    Session::flash('success', 'Invitation deleted!');
    return ;
  }
}
