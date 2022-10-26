<?php

namespace App\Http\Controllers;

use App\Mail\Invite as MailInvite;
use App\Models\Invite;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class InviteController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $invites = Invite::all();
    $users = User::all()->sortByDesc('is_admin');
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
      $url = URL::signedRoute('invite', ['invite_id' => $invite->id]);
      Mail::to($keyemail)->send(new MailInvite($invite, $url));
    }

    return redirect()->back()->with('success', 'File Shared Successfuly!');
  }

  public function accept(Request $request)
  {
    if (!$request->hasValidSignature()) abort(401);

  }

  public function destroy(Request $request)
  {
    //
  }
}

// @if(isset(old('modal'))
//     <script>
//         $(window).load(function(){
//            $(#{{ old('modal') }}).modal(\'show\');
//         });
//     </script>
//   @endif 
