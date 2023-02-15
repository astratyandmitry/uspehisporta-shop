<?php

namespace Domain\CMS\Mails;

use Illuminate\Mail\Mailable;
use Domain\CMS\Models\Manager;

class ManagerPasswordGeneratedMail extends Mailable
{
    public Manager $manager;

    public string $password;

    public function __construct(Manager $manager, string $password)
    {
        $this->manager = $manager;
        $this->password = $password;
    }

    public function build(): ManagerPasswordGeneratedMail
    {
        return $this
            ->subject(env('APP_NAME').': CMS Access')
            ->markdown('cms::mails.manager-password-generated');
    }
}
