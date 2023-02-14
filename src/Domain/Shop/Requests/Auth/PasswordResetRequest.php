<?php

namespace Domain\Shop\Requests\Auth;

use Domain\Shop\Requests\Request;

/**
 * @property string $email
 * @property string $password
 * @property string $password_confirmation
 */
class PasswordResetRequest extends Request
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required',
        ];
    }
}
