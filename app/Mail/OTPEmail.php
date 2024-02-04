<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OTPEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $otp; // Add a property to hold the OTP.

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($otp)
    {
        $this->otp = $otp; // Assign the OTP to the property.
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.otp')
        ->subject('Your OTP Verification'); // Specify th // Specify the email view to be used.
    }
}
