<?php

namespace Domain\CMS\Mails;

use Illuminate\Mail\Mailable;
use Domain\CMS\Models\Manager;

class ManagerPasswordGeneratedMail extends Mailable
{
    /**
     * @var \Domain\CMS\Models\Manager
     */
    public $manager;

    /**
     * @var string
     */
    public $password;

    /**
     * @param \Domain\CMS\Models\Manager $manager
     * @param string $password
     *
     * @return void
     */
    public function __construct(Manager $manager, string $password)
    {
        $this->manager = $manager;
        $this->password = $password;
    }

    /**
     * @return \Domain\CMS\Mails\ManagerPasswordGeneratedMail
     */
    public function build(): ManagerPasswordGeneratedMail
    {
        return $this
            ->subject(env('APP_NAME').': CMS Access')
            ->markdown('cms::mails.manager-password-generated');
    }
}
