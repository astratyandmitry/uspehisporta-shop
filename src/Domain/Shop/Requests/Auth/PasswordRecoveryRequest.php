<?php

namespace Domain\Shop\Requests\Auth;

use Domain\Shop\Requests\Request;

/**
 * @property string $email
 */
class PasswordRecoveryRequest extends Request
{
    public function rules(): array
    {
        return [
            'email' => 'required|email',
        ];
    }
}
