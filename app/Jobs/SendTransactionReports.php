<?php

namespace App\Jobs;

use App\Mail\BorrowReportMember;
use App\Models\BorrowTransaction;
use App\Models\Member;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendTransactionReports implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // generate report borrowTransaction and send to member email
        $member = Member::with('user')->find($this->id);

        // get borrow transaction borrow by member status borrowed
        $borrowTransactions = BorrowTransaction::with('book')
            ->where('user_id', $this->id)
            ->orWhere('status', 'borrowed')
            ->first();



        // send email to member
        $email = new BorrowReportMember($member, $borrowTransactions);
        $email->subject = "Laporan Peminjaman {$member->member_name} Bulan Ini";
        Mail::to($member->user->email)->send($email);
    }
}
