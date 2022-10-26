<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Invite extends Mailable implements ShouldQueue
{
  use Queueable, SerializesModels;

  public $invite;
  public $url;
  /**
   * Create a new message instance.
   *
   * @return void
   */
  public function __construct($invite, $url)
  {
    $this->invite = $invite;
    $this->url = $url;
  }

  /**
   * Get the message envelope.
   *
   * @return \Illuminate\Mail\Mailables\Envelope
   */
  public function envelope()
  {
    return new Envelope(
      subject: 'Mantenar Invitation',
    );
  }

  /**
   * Get the message content definition.
   *
   * @return \Illuminate\Mail\Mailables\Content
   */
  public function content()
  {
    return new Content(
      markdown: 'mail.invite',
      with: [
          'url' => $this->url,
      ],
    );
  }

  /**
   * Get the attachments for the message.
   *
   * @return array
   */
  public function attachments()
  {
    return [];
  }
}
