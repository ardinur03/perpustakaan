<?php

namespace App\Http\Controllers;

use App\Jobs\forgotPasswordMail;
use App\Jobs\printTransactionJob;

class TestQueueEmails extends Controller
{
    /**
     * test email queues
     **/
    public function sendTestEmails()
    {
        $emailJobs = new forgotPasswordMail();
        $this->dispatch($emailJobs);
        return redirect()->back()->with('success', 'Email has been sent');
    }

    public function downlaodPdf()
    {
        $borrowTransaction = new printTransactionJob();
        return redirect()->back()->with('success', 'PDF has been downloaded');
    }
}
