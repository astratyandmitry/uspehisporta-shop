<?php

namespace Domain\Shop\Mails;

use Illuminate\Mail\Mailable;
use Domain\Shop\Models\Verification;

class VerificationMail extends Mailable
{
    public Verification $verification;

    public function __construct(Verification $verification)
    {
        $this->verification = $verification;
    }

    public function build(): VerificationMail
    {
        return $this
            ->subject(env('APP_NAME').': '.$this->verification->type->name)
            ->markdown('shop::mails.verification');
    }
}
