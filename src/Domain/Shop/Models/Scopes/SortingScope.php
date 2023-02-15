<?php

namespace Domain\Shop\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class SortingScope implements Scope
{
    public function apply(Builder $builder, Model $model): void
    {
        $builder->orderBy('sort');
    }
}
