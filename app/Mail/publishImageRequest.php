<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class publishImageRequest extends Mailable
{
    use Queueable, SerializesModels;

    protected $firstname;
    protected $lastname;
    protected $email;
    protected $image_links;
    protected $msg;

    /**
     * Create a new message instance.
     */
    public function __construct($data)
    {
        $this->firstname = $data['firstname'];
        $this->lastname = $data['lastname'];
        $this->email = $data['email'];
        $this->image_links = $data['image_links'];
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
        $mail =  $this->view('emails.publishImageRequest')
                ->subject("Exdiffusion Image Approval")
                ->with([
                    'firstname' => $this->firstname,
                    'lastname' => $this->lastname,
                    'email' => $this->email,
                    'msg' => $this->msg
                ]);
        if(count($this->image_links) > 0){
            foreach ($this->image_links as $attachment) {
                $mail->attach($attachment);
            }
        }        
        

        return  $mail;
    }
}
