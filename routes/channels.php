<?php

use App\Models\Comment;
use App\Models\Viewer;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('comments.{id}', function ($user, $id) {
  // $viewers = Viewer::where('share_id', $id)->pluck('user_id')->all();
  // dd($viewers);
  // return in_array(auth()->user()->id, $viewers);
  return true;
});
