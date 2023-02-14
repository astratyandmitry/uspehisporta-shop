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
 * @property boolean $nav
 * @property boolean $system
 * @property boolean $active
 */
class Page extends Model implements HasUrl
{
    use HasActiveState;

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var array
     */
    protected $casts = [
        'nav' => 'boolean',
        'system' => 'boolean',
        'active' => 'boolean',
    ];

    /**
     * @return void
     */
    public static function boot(): void
    {
        parent::boot();

        static::addGlobalScope(new SystemScope);
    }

    /**
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'hru';
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param bool $applyOrder
     * @return \Illuminate\Database\Eloquent\Builder
     */
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

    /**
     * @return string
     */
    public function url(): string
    {
        return route('shop::page', $this->hru);
    }
}
