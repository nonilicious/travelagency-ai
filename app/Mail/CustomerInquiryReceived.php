<?php

namespace App\Mail;

use App\Models\CustomerInquiry;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomerInquiryReceived extends Mailable
{
    use Queueable;
    use SerializesModels;

    public function __construct(public CustomerInquiry $inquiry)
    {
    }

    public function build(): self
    {
        return $this
            ->subject('New travel request from '.$this->inquiry->name)
            ->view('emails.customer-inquiries.received');
    }
}
