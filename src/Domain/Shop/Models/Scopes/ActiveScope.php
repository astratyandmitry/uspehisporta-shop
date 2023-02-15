<?php

namespace Domain\Shop\Models\Scopes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;

class ActiveScope implements Scope
{
    public function apply(Builder $builder, Model $model): void
    {
        if (! app()->runningInConsole() && request()->segment(1) != 'cms' && auth('cms')->guest()) {
            $builder->where('active', true);
        }
    }
}

