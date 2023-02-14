<?php

namespace Domain\CMS\Models;

/**
 * @property string $key
 * @property string $name
 */
class ManagerRole extends Model
{
    /**
     * @return bool
     */
    public function admin(): bool
    {
        return $this->id === MANAGER_ROLE_ADMIN;
    }

    /**
     * @return bool
     */
    public function manager(): bool
    {
        return $this->id === MANAGER_ROLE_MANAGER;
    }
}
