<?php

namespace Domain\Shop\Models;

use Domain\Shop\Models\Traits\HasActiveState;
use Domain\Shop\Models\Traits\HasSorting;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;

/**
 * @property string $code
 * @property array $categories
 * @property float $discount
 * @property \Carbon\Carbon $date_start
 * @property \Carbon\Carbon $date_end
 */
class Promo extends Model
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
        'categories' => 'array',
        'discount' => 'float',
        'active' => 'boolean',
    ];

    protected ?Collection $_categories = null;

    public static function scopeFilter(Builder $builder, bool $applyOrder = true): Builder
    {
        $builder->when(request('info'), function (Builder $builder): Builder {
            return $builder->where('code', 'LIKE', '%'.request()->get('info').'%');
        });

        return parent::scopeFilter($builder, false);
    }

    public function categories(): Collection
    {
        if ($this->_categories === null) {
            if (is_array($this->categories) && count($this->categories)) {
                $this->_categories = Category::query()
                    ->whereIn('id', $this->categories)
                    ->get();
            } else {
                $this->_categories = collect();
            }
        }

        return $this->_categories;
    }
}
