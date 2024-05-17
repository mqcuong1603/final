<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Salesman;

class SalesActivationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $salesman;
    public $token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Salesman $salesman, $token)
    {
        $this->salesman = $salesman;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.sales_activation')
                    ->with([
                        'salesman' => $this->salesman,
                        'token' => $this->token,
                    ])
                    ->subject('Sales Activation Email');
    }
}