<?php

namespace App\Observers;

use App\Models\Share;
use App\Models\Trail;

class ShareObserver
{
  /**
   * Handle the Share "created" event.
   *
   * @param  \App\Models\Share  $share
   * @return void
   */
  public function created(Share $share)
  {
    //
    Trail::create([
      'action' => "Shared a new file '" . $share->name . "' with " . $share->viewers->count() . " users",
      'author_user_id' => Auth()->user()->id
    ]);
  }

  /**
   * Handle the Share "updated" event.
   *
   * @param  \App\Models\Share  $share
   * @return void
   */
  public function updated(Share $share)
  {
    //
  }

  /**
   * Handle the Share "deleted" event.
   *
   * @param  \App\Models\Share  $share
   * @return void
   */
  public function deleted(Share $share)
  {
    Trail::create([
      'action' => "Deleted file '" . $share->name . "'",
      'author_user_id' => Auth()->user()->id
    ]);
  }

  /**
   * Handle the Share "restored" event.
   *
   * @param  \App\Models\Share  $share
   * @return void
   */
  public function restored(Share $share)
  {
    //
  }

  /**
   * Handle the Share "force deleted" event.
   *
   * @param  \App\Models\Share  $share
   * @return void
   */
  public function forceDeleted(Share $share)
  {
    Trail::create([
      'action' => "Deleted file '" . $share->name . "'",
      'author_user_id' => Auth()->user()->id
    ]);
  }
}
