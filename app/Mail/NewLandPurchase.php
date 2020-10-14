<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewLandPurchase extends Mailable
{
    use Queueable, SerializesModels;
    public $updateLandDetails;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($updateLandDetails)
    {
        //
       $this->updateLandDetails =  $updateLandDetails
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.newland-purchase')->with('data', $this->updateLandDetails);
    }
}
