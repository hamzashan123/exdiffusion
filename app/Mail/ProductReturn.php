<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ProductReturn extends Mailable
{
    use Queueable, SerializesModels;

    protected $shop_name;
    protected $shop_email;
    protected $shop_account_number;
    protected $product_code;
    protected $quantity;
    protected $reason;
    protected $invoice_number;
    protected $return_type;
    protected $msg;

    /**
     * Create a new message instance.
     */
    public function __construct($data)
    {
        $this->shop_name = $data['shop_name'];
        $this->shop_email = $data['shop_email'];
        $this->shop_account_number = $data['shop_account_number'];
        $this->product_code = $data['product_code'];
        $this->quantity = $data['quantity'];
        $this->reason = $data['reason'];
        $this->invoice_number = $data['invoice_number'];
        $this->return_type = $data['return_type'];
        $this->msg = $data['msg'];
    }

    public function build(){

        return $this->view('emails.goodsReturn')
        ->subject('Products Return Reqeuest')
        ->with([
                        
                        'shop_name' => $this->shop_name,
                        'shop_email' => $this->shop_email,
                        'shop_account_number' => $this->shop_account_number,
                        'product_code' => $this->product_code,
                        'quantity' => $this->quantity,
                        'reason' => $this->reason,
                        'invoice_number' => $this->invoice_number,
                        'return_type' => $this->return_type,
                        'msg' => $this->msg
        ]);
    }
}
