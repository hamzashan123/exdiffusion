<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class bulkOrderEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $firstname;
    protected $lastname;
    protected $companyname;
    protected $phone;
    public $subject;
    protected $orderid;
    protected $url;
    protected $msg;

    /**
     * Create a new message instance.
     */
    public function __construct($data)
    {
        $this->firstname = $data['firstname'];
        $this->lastname = $data['lastname'];
        $this->companyname = $data['companyname'];
        $this->phone = $data['phone'];
        $this->subject = $data['subject'];
        $this->orderid = $data['orderid'];
        $this->url = $data['url'];
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


    public function build(){

        return $this->view('emails.bulkOrderEmail')
        ->subject('New Order Recieved')
        ->with([
                        
                        'firstname' => $this->firstname,
                        'lastname' => $this->lastname,
                        'companyname' => $this->companyname,
                        'phone' => $this->phone,
                        'orderid' => $this->orderid,
                        'url' => $this->url,
                        'msg' => $this->msg
        ]);
    }
}
