<?php

namespace Domain\Shop\Mails;

use Illuminate\Mail\Mailable;
use Domain\Shop\Models\Verification;

class VerificationMail extends Mailable
{
    /**
     * @var \Domain\Shop\Models\Verification
     */
    public $verification;

    /**
     * @param \Domain\Shop\Models\Verification $verification
     */
    public function __construct(Verification $verification)
    {
        $this->verification = $verification;
    }

    /**
     * @return \Domain\Shop\Mails\VerificationMail
     */
    public function build(): VerificationMail
    {
        return $this
            ->subject(env('APP_NAME').': '.$this->verification->type->name)
            ->markdown('shop::mails.verification');
    }
}
