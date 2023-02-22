<?php

namespace Domain\Shop\Models;

use Domain\Shop\Models\Interfaces\HasUrl;
use Domain\Shop\Models\Traits\HasActiveState;
use Domain\Shop\Models\Traits\HasSorting;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property integer $parent_id
 * @property string $hru
 * @property string $name
 * @property string $title
 * @property string $about
 * @property string $image
 * @property string|null $meta_description
 * @property string|null $meta_keywords
 *
 * @property \Domain\Shop\Models\Category $parent
 * @property \Domain\Shop\Models\Category[]|\Illuminate\Database\Eloquent\Collection $children
 * @property \Domain\Shop\Models\Product[]|\Illuminate\Database\Eloquent\Collection $products
 */
class Category extends Model implements HasUrl
{
    use HasSorting, HasActiveState;

    protected $guarded = [];

    protected $hidden = [
        'parent_id',
        'title',
        'image',
        'meta_description',
        'meta_keywords',
        'sort',
        'active',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'parent_id' => 'integer',
        'active' => 'boolean',
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function getRouteKeyName(): string
    {
        return 'hru';
    }

    public static function options(): array
    {
        return Category::query()->whereNull('parent_id')->pluck('name', 'id')->toArray();
    }

    public static function groupedOptions(): array
    {
        /** @var \Domain\Shop\Models\Category[] $parentCategories */
        $parentCategories = Category::query()->whereNull('parent_id')->with(['children'])->get();

        $options = [];

        foreach ($parentCategories as $parentCategory) {
            if ($parentCategory->children->isEmpty()) {
                $options[$parentCategory->id] = $parentCategory->name;
            } else {
                foreach ($parentCategory->children as $child) {
                    $options[$parentCategory->name][$child->id] = $child->name;
                }
            }
        }

        return $options;
    }

    public static function scopeFilter(Builder $builder, bool $applyOrder = true): Builder
    {
        $builder->when(request('info'), function (Builder $builder): Builder {
            return $builder
                ->where('name', 'LIKE', '%'.request()->get('info').'%')
                ->orWhere('title', 'LIKE', '%'.request()->get('info').'%')
                ->orWhere('hru', 'LIKE', '%'.request()->get('info').'%');
        });

        $builder->when(request('parent_id'), function (Builder $builder): Builder {
            if (request('parent_id') === 'head') {
                return $builder->whereNull('parent_id');
            }

            return $builder->where('parent_id', request('parent_id'));
        });

        return parent::scopeFilter($builder, false);
    }

    public function url(): string
    {
        if ($this->parent) {
            return route('shop::catalog', [$this->parent->hru, $this->hru]);
        }

        return route('shop::catalog', $this->hru);
    }
}
