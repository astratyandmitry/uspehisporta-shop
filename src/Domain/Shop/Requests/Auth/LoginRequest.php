<?php

namespace Domain\Shop\Requests\Auth;

use Domain\Shop\Requests\Request;

/**
 * @property string $email
 * @property string $password
 */
class LoginRequest extends Request
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required',
        ];
    }
}
