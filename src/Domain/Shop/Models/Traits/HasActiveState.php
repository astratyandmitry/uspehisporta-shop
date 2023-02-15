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
    public static function bootHasActiveState(): void
    {
        static::addGlobalScope(new ActiveScope);
    }

    public function isActive(): bool
    {
        return $this->active || auth('manager')->check();
    }
}
