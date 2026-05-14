<?php

namespace App\Mail;

use App\Models\CustomerInquiry;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomerInquiryConfirmation extends Mailable
{
    use Queueable;
    use SerializesModels;

    public function __construct(public CustomerInquiry $inquiry)
    {
    }

    public function build(): self
    {
        return $this
            ->subject(__('We received your travel request'))
            ->view('emails.customer-inquiries.confirmation');
    }
}
