<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContectUsEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $f_name;
    public $l_name;
    public $company_name;
    public $designation;
    public $email;

    public function __construct($userdetail)
    {
        $this->f_name = $userdetail['f_name'];
        $this->l_name = $userdetail['l_name'];
        $this->company_name = $userdetail['company'];
        $this->designation = $userdetail['designation'];
        $this->email = $userdetail['email'];
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Contect Us Email',
        );
    }

    /**
     * Get the message content definition.
     */
    // public function content(): Content
    // {
    //     return new Content(
    //         view: 'view.name',
    //     );
    // }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function build()
    {
        return $this->subject('Contect Us Email')
                    ->view('emails.contect-us-email');
    }
}
