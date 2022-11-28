<?php

namespace App\Http\Controllers;

use App\Jobs\forgotPasswordMail;

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
}
