<?php

namespace Domain\CMS\Requests;

/**
 * @property string $email
 * @property string $password
 */
class LoginRequest extends Request
{
    protected function buildRules(): void
    {
        $this->rulesBuilder->addRules([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    }
}
