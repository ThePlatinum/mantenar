<?php

namespace App\Http\Controllers;

use App\Mail\Invite as MailInvite;
use App\Models\Invite;
use App\Models\Setting;
use App\Models\User;
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
    $invites = Invite::all();
    $users = User::withTrashed()->get()->sortByDesc('is_admin');
    return view('staffs', compact('users', 'invites'));
  }

  public function store(Request $request)
  {
    $validate = Validator::make(explode(',', $request->invite_email), [
      'invite_email' => 'required',
    ]);

    // if ($validate->fails()) return ;
    // return redirect()->back()->withErrors($validate->errors())->withInput();

    $emails = explode(',', $request->invite_email);
    // TODO: validate
    foreach($emails as $keyemail) {
      $invite = Invite::create([
        'invite_email' => str_replace(' ', '', $keyemail)
      ]);
      $url = URL::temporarySignedRoute('invite', now()->addDays(2), ['invite_id' => $invite->id]);
      Mail::to($keyemail)->send(new MailInvite($invite, $url));
    }

    return redirect()->back()->with('success', 'Invitation Sent Successfuly!');
  }

  public function accept($invite_id)
  {
    if (Auth::check()) return redirect()->route('dashboard');

    $org_name = Setting::org_name();
    $invite = Invite::find($invite_id);
    if (!$invite) return view('invite.expired');
    return view('invite.accept', ['email' => $invite->invite_email, 'org_name' => $org_name, 'invite_id' => $invite_id]);
  }

  public function destroy(Request $request)
  {
    Invite::find($request->invite_id)->delete();
    
    Session::flash('success', 'Invitation deleted!');
    return ;
  }
}

// @if(isset(old('modal'))
//     <script>
//         $(window).load(function(){
//            $(#{{ old('modal') }}).modal(\'show\');
//         });
//     </script>
//   @endif 
