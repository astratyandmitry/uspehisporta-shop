<?php

namespace Domain\Shop\Models\Traits;

use Domain\Shop\Models\Scopes\ActiveScope;

/**
 * @property boolean $active
 *
 * @mixin \Domain\Shop\Models\Model
 */
trait HasActiveState
{
    /**
     * @return void
     */
    public static function bootHasActiveState(): void
    {
        static::addGlobalScope(new ActiveScope);
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active || auth('manager')->check();
    }
}
