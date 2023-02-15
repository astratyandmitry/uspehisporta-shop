<?php

namespace Domain\Shop\Models;

use Domain\Shop\Models\Interfaces\HasUrl;
use Domain\Shop\Models\Scopes\ActiveScope;
use Domain\Shop\Models\Scopes\SystemScope;
use Domain\Shop\Models\Traits\HasActiveState;
use Illuminate\Database\Eloquent\Builder;

/**
 * @property string $hru
 * @property string $name
 * @property string $title
 * @property string $content
 * @property string|null $meta_description
 * @property string|null $meta_keywords
 * @property boolean $system
 * @property boolean $active
 */
class Page extends Model implements HasUrl
{
    use HasActiveState;

    protected $guarded = [];

    protected $casts = [
        'system' => 'boolean',
        'active' => 'boolean',
    ];

    public static function boot(): void
    {
        parent::boot();

        static::addGlobalScope(new SystemScope);
    }

    public function getRouteKeyName(): string
    {
        return 'hru';
    }

    public static function scopeFilter(Builder $builder, bool $applyOrder = true): Builder
    {
        $builder->when(request('info'), function (Builder $builder): Builder {
            return $builder
                ->where('name', 'LIKE', '%'.request()->get('info').'%')
                ->orWhere('title', 'LIKE', '%'.request()->get('info').'%')
                ->orWhere('hru', 'LIKE', '%'.request()->get('info').'%');
        });

        return parent::scopeFilter($builder);
    }

    public function url(): string
    {
        return route('shop::page', $this->hru);
    }
}
