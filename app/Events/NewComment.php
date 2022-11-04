<?php

namespace App\Events;

use App\Models\Comment;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewComment implements ShouldBroadcast
{
  use Dispatchable, InteractsWithSockets, SerializesModels;

  public $rbtsp;
  public $xpr;

  /**
   * Create a new event instance.
   *
   * @return void
   */
  public function __construct($comment)
  {
    $comment_id = Comment::find($comment)->share->id;
    $this->rbtsp = $comment_id;
    $this->xpr = $comment;
  }

  /**
   * Get the channels the event should broadcast on.
   *
   * @return \Illuminate\Broadcasting\Channel|array
   */
  public function broadcastOn()
  {
    return new PrivateChannel('comments.'.$this->rbtsp);
  }
}
