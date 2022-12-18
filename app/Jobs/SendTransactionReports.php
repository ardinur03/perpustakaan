<?php

namespace App\Jobs;

use App\Mail\BorrowReportMember;
use App\Models\BorrowTransaction;
use App\Models\Member;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use \Mpdf\Mpdf as PDF;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendTransactionReports implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $id_user;
    public $id_borrow_transaction;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id_user, $id_borrow_transaction)
    {
        $this->id_user = $id_user;
        $this->id_borrow_transaction = $id_borrow_transaction;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // generate report borrowTransaction and send to member email
        $member = Member::with('user')->find($this->id_user);

        // get borrow transaction borrow by member status borrowed
        $borrowTransaction = BorrowTransaction::with(['book', 'user'])
            ->where('id', $this->id_borrow_transaction)
            ->first();

        // check if borrow transaction is null
        if (is_null($borrowTransaction)) {
            return;
        }

        // generate report borrow transaction and send to member email 
        $member_name = str_replace(' ', '-', $borrowTransaction->user->member->member_name);
        $date_now = date('Y-m-d');
        // random number for document file name
        $random_number = rand(1000, 9999);
        $documentFileName = "{$member_name}_{$date_now}_Laporan-Peminjaman_{$random_number}.pdf";

        $document = new PDF([
            'mode' => 'utf-8',
            'format' => 'A4',
            'margin_header' => '3',
            'margin_top' => '20',
            'margin_bottom' => '20',
            'margin_footer' => '2',
        ]);

        $header = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $documentFileName . '"'
        ];

        $document->SetTitle("Laporan Peminjaman Buku {$borrowTransaction->user->member->member_name}");

        $document->WriteHTML(view('member-transaction.printed-transaction', [
            'borrowTransaction' => $borrowTransaction,
            'isPrint' => true,
        ]));

        // save document to storage and update url report
        $document->Output(storage_path('app/public/' . $documentFileName), 'F');
        $borrowTransaction->url_report = Storage::url($documentFileName);
        $borrowTransaction->save();


        // send email to member
        $email = new BorrowReportMember($member, $borrowTransaction, $documentFileName);
        $email->subject = "Laporan Peminjaman buku {$member->member_name}";
        Mail::to($member->user->email)->send($email);
    }
}
