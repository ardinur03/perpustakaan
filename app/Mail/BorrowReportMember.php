<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BorrowReportMember extends Mailable
{
    use Queueable, SerializesModels;

    public $member;
    public $borrowTransactions;
    public $documentFileName;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($member, $borrowTransactions, $documentFileName)
    {
        $this->member = $member;
        $this->borrowTransactions = $borrowTransactions;
        $this->documentFileName = $documentFileName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('components.mail.report-transaction-member');
    }
}
