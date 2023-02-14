<?php

namespace Domain\Shop\Models\Traits;

use Domain\Shop\Models\Model;
use Domain\Shop\Models\Scopes\SortingScope;

/**
 * @property integer $sort
 *
 * @mixin \Domain\Shop\Models\Model
 */
trait HasSorting
{
    /**
     * @return void
     */
    public static function bootHasSorting(): void
    {
        static::addGlobalScope(new SortingScope);

        static::creating(function (Model $model): void {
            $newQuery = (new self)->newQuery()->withoutGlobalScope(SortingScope::class);

            if (! $maxSort = $newQuery->latest('sort')->value('sort')) {
                $maxSort = 0;
            }

            $model->setAttribute('sort', $maxSort + 1);
        });
    }
}

