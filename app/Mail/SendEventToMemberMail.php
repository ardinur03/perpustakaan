<?php

namespace App\Mail;

use App\Models\Event;
use App\Models\Member;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEventToMemberMail extends Mailable
{
    use Queueable, SerializesModels;

    public $event;
    public $member;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Event $event, $member)
    {
        $this->event = $event;
        $this->member = $member;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('components.mail.event-info', [
            'event' => $this->event,
            'member' => $this->member,
        ]);
    }
}
