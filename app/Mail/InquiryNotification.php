<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InquiryNotification extends Mailable
{
    use Queueable, SerializesModels;

    private $inquiryData;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $data)
    {
        $this->inquiryData = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //First, email a copy of the contact request to guy-smiley@example.com
        return $this->from(['example@example.com', 'name' => 'Guy Smiley'])
            ->view('emails.inquiry')
            ->with($this->inquiryData)
            ->from($this->inquiryData['email'])
            ->cc('guy-smiley@example.com')
            ->subject('A new inquiry from the website');
    }
}
