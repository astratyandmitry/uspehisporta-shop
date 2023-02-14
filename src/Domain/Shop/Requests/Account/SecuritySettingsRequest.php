<?php

namespace Domain\Shop\Requests\Account;

use Domain\Shop\Requests\Request;

/**
 * @property string $current_password
 * @property string $password
 * @property string $password_confirmation
 */
class SecuritySettingsRequest extends Request
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'current_password' => 'required|current_password',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required',
        ];
    }
}
