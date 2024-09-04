<?php

namespace App\Mail;

use App\Models\ReporterModel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReporterPendingApproval extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $isAdmin;
    /**
     * Create a new message instance.
     */
    public function __construct($data, $isAdmin)
    {
        $this->data = $data;
        $this->isAdmin = $isAdmin;
    }


    public function build()
    {
        return $this->view('emails.reporter.approval_pending')
            ->subject('New Contact Us Form Submission')
            ->with('data', $this->data);
        // if ($this->isAdmin) {
        // } else {
        //     return $this->view('emails.reporter.email_verify')
        //         ->subject('Thank you for contacting us')
        //         ->with('data', $this->data);
        // }
    }
}
