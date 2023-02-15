<?php

namespace Domain\CMS\Requests;

use Domain\CMS\Models\Manager;

/**
 * @property string $email
 * @property string $role_key
 * @property string|null $telegram_id
 * @property string|null $new_password
 */
class ManagerRequest extends Request
{
    /**
     * @return void
     */
    protected function buildRules(): void
    {
        $this->rulesBuilder
            ->addUniqueRule('email', Manager::getTableName())
            ->addRules([
                'email' => 'required|email',
                'telegram_id' => 'nullable',
                'role_key' => 'required|exists:manager_roles,key',
            ])
            ->addRulesWhen($this->isMethod('PATCH'), [
                'new_password' => 'sometimes',
            ]);
    }
}
