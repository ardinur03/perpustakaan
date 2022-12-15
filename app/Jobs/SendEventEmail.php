<?php

namespace App\Jobs;

use App\Mail\SendEventToMemberMail;
use App\Models\{Event, Member};
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEventEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $event;
    protected $member;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $members = Member::with('user')->get();

        foreach ($members as $member) {
            $email = new SendEventToMemberMail($this->event, $member);
            $date = date('d F Y h:i', strtotime($this->event->event_start_date)) . ' WIB';
            $email->subject = "Hallo {$member->member_name} Event {$this->event->event_name} pada {$date} akan segera hadir !";

            Mail::to($member->user->email)->send($email);
        }
    }
}
