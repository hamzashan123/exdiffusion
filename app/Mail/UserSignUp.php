<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserSignUp extends Mailable
{
    use Queueable, SerializesModels;

    protected $admin;
    protected $firstname;
    protected $lastname;
    protected $username;
    protected $email;
    public $subject;
    protected $msg;
    

    /**
     * Create a new message instance.
     */
    public function __construct($data)
    {
        $this->admin = $data['admin'];
        $this->firstname = $data['firstname'];
        $this->lastname = $data['lastname'];
        $this->username = $data['username'];
        $this->email = $data['email'];
        $this->subject = $data['subject'];
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
        return $this->view('emails.usersignup')
        ->subject($this->subject)
                    ->with([
                        'admin' => $this->admin,
                        'firstname' => $this->firstname,
                        'lastname' => $this->lastname,
                        'username' => $this->username,
                        'email' => $this->email,
                        'msg' => $this->msg
                    ]);
    }

}
