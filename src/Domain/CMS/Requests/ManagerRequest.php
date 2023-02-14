<?php

namespace Domain\CMS\Requests;

use Domain\CMS\Models\Manager;

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
