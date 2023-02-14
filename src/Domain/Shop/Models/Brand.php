<?php

namespace Domain\Shop\Models;

use Domain\Shop\Models\Traits\HasActiveState;
use Domain\Shop\Models\Traits\HasSorting;
use Illuminate\Database\Eloquent\Builder;

/**
 * @property string $hru
 * @property string $name
 * @property string|null $logotype
 * @property string|null $meta_description
 * @property string|null $meta_keywords
 */
class Brand extends Model
{
    use HasSorting, HasActiveState;

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var array
     */
    protected $hidden = [
        'logotype',
        'meta_description',
        'meta_keywords',
        'sort',
        'active',
        'created_at',
        'updated_at',
    ];

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
                ->orWhere('hru', 'LIKE', '%'.request()->get('info').'%');
        });

        return parent::scopeFilter($builder, false);
    }
}
