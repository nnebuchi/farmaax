<?php

namespace App\Mail;

use Session;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FarmSetupIsSucessful extends Mailable
{
    public $lastDetails;
    public $data;
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($lastDetail, $data)
    {
        //
        $this->lastDetails = $lastDetail;
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.farm-setup-successful')->with(['data' => $this->data, 'lastDetails' => $this->lastDetails]);
    }
}
