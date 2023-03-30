<?php

namespace App\Http\Controllers;

use App\Mail\NewShare;
use App\Models\Comment;
use App\Models\Share;
use App\Models\Trail;
use App\Models\User;
use App\Models\Viewer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class ShareController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $users = User::where('id', '!=', Auth()->user()->id)->get();
    return view('newshare', compact('users'));
  }

  public function store(Request $request)
  {
    $validate = Validator::make($request->all(), [
      'name' => 'required|string',
      'file' => 'required',
      'viewers' => 'required',
      'note' => 'nullable',
    ]);

    if ($validate->fails())
      return redirect()->back()->withErrors($validate->errors())->withInput();

    $slug = now()->getTimestamp();
    $the_file = $request->file("file");
    $_file = $the_file->storeAs('shared_files', $slug . '.' . $the_file->getClientOriginalExtension());
    $share = Share::create([
      'file' => $_file,
      'name' => $request->name,
      'type' => $the_file->getClientOriginalExtension(),
      'size' => $the_file->getSize(),
      'slug' => $slug,
      'note' => $request->note,
      'user_id' => Auth()->user()->id
    ]);

    if ($share) {
      foreach ($request->viewers as $key => $value) {
        if (User::find($value)) Viewer::create([
          'share_id' => $share->id,
          'user_id' => $value
        ]);
      }
    }

    Trail::create([
      'action' => "Shared a new file '" . $share->name . "' with " . $share->viewers->count() . " users",
      'user_id' => Auth()->user()->id
    ]);

    $url = URL::route('viewshare', $slug);
    foreach ($share->viewers as $viewer) {
      try {
        Mail::to($viewer->email)->send(new NewShare($share, $url));
      } catch (\Throwable $th) {
        throw $th;
      }
    }

    return redirect()->route('viewshare', $slug)->with('success', 'File Shared Successfuly!');
  }

  public function show($slug)
  {
    $share = Share::where('slug', $slug)->first();
    if (!$share) return redirect()->back()->with('error', 'Invalid Request!');

    $comments = Comment::where('share_id', $share->id)->get();

    $already_ = $share->viewers->pluck('id');

    if (in_array(auth()->user()->id, $already_->all()) || auth()->user()->is_admin || auth()->user()->id == $share->user_id) {
      $users = User::where('id', '!=', Auth()->user()->id)->whereNotIn('id', $already_->all())->get();
      return view('viewshare', compact('share', 'comments', 'users'));
    }
    
    return redirect()->route('dashboard')->with('error', "You don't have permission to view this file");
  }

  public function all()
  {
    return view('all_share', ['all' => Share::all()]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Share  $share
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Share $share)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Share  $share
   * @return \Illuminate\Http\Response
   */
  public function destroy(Share $share)
  {
    //
  }
}
