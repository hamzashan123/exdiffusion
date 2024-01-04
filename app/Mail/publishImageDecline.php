<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class publishImageDecline extends Mailable
{
    use Queueable, SerializesModels;

    protected $firstname;
    protected $lastname;
    protected $email;
    protected $msg;

    /**
     * Create a new message instance.
     */
    public function __construct($data)
    {
        $this->firstname = $data['firstname'];
        $this->lastname = $data['lastname'];
        $this->email = $data['email'];
        $this->msg = $data['msg'];
    }

   /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
    

    public function build()
    {
        return $this->view('emails.publishImageDecline')
        ->subject("Exdiffusion Image Declined")
                    ->with([
                        'firstname' => $this->firstname,
                        'lastname' => $this->lastname,
                        'email' => $this->email,
                        'msg' => $this->msg
                    ]);
    }
}
