<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class YourLandPurchaseIsSuccessfulOnFarmaax extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $updateLandDetails;
    public function __construct($updateLandDetails)
    {
        //
        $this->updateLandDetails = $updateLandDetails;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.land-bought')->with('data', $this->updateLandDetails);
    }
}
