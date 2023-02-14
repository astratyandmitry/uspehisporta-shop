<?php

namespace Domain\CMS\Requests;

/**
 * @version 1.0.1
 * @author Astratyan Dmitry <astratyandmitry@gmail.com>
 * @copyright 2020, ArmenianBros. <i@armenianbros.com>
 */
class LoginRequest extends Request
{
    /**
     * @return void
     */
    protected function buildRules(): void
    {
        $this->rulesBuilder->addRules([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    }
}
