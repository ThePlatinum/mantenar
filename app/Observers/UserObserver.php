<?php

namespace App\Observers;

use App\Models\Trail;
use App\Models\User;

class UserObserver
{
  /**
   * Handle the User "created" event.
   *
   * @param  \App\Models\User  $user
   * @return void
   */
  public function created(User $user)
  {
    //
  }

  /**
   * Handle the User "updated" event.
   *
   * @param  \App\Models\User  $user
   * @return void
   */
  public function updated(User $user)
  {
    //
  }

  /**
   * Handle the User "deleted" event.
   *
   * @param  \App\Models\User  $user
   * @return void
   */
  public function deleted(User $user)
  {
    Trail::create([
      'action' => "Revoked (Disabled) user ". $user->fullname ."'s Account access",
      'user_id' => Auth()->user()->id
    ]);

    // TODO: Send notification
  }

  /**
   * Handle the User "restored" event.
   *
   * @param  \App\Models\User  $user
   * @return void
   */
  public function restored(User $user)
  {
    Trail::create([
      'action' => "Restored (Enabled) user ". $user->fullname ."'s Account access",
      'user_id' => Auth()->user()->id
    ]);

    // TODO: Send notification
  }

  /**
   * Handle the User "force deleted" event.
   *
   * @param  \App\Models\User  $user
   * @return void
   */
  public function forceDeleted(User $user)
  {
    //
    Trail::create([
      'action' => "Deleted user ". $user->fullname ."'s Account",
      'user_id' => Auth()->user()->id
    ]);

    // TODO: Send notification
  }
}
