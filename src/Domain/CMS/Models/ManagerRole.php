<?php

namespace Domain\CMS\Models;

/**
 * @property string $key
 * @property string $name
 */
class ManagerRole extends Model
{
    public function admin(): bool
    {
        return $this->key === MANAGER_ROLE_ADMIN;
    }

    public function manager(): bool
    {
        return $this->key === MANAGER_ROLE_MANAGER;
    }
}
