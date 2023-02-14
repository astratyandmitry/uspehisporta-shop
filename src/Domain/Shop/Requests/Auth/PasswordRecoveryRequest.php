<?php

namespace Domain\Shop\Requests\Auth;

use Domain\Shop\Requests\Request;

/**
 * @property string $email
 */
class PasswordRecoveryRequest extends Request
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email',
        ];
    }
}
