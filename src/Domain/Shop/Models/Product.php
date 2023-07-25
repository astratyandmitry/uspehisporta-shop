<?php

namespace Domain\Shop\Models;

use Domain\Shop\Models\Interfaces\HasUrl;
use Domain\Shop\Models\Traits\HasActiveState;
use Domain\Shop\Models\Traits\HasSorting;
use Domain\Shop\Requests\CatalogRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

/**
 * @property integer $category_id
 * @property integer $brand_id
 * @property string $hru
 * @property string $url
 * @property string $name
 * @property string $image
 * @property string|null $about
 * @property string|null $badges
 * @property array $variations
 * @property array $gallery
 * @property double $rating
 * @property integer $price
 * @property integer|null $price_sale
 * @property integer $quantity
 * @property string|null $meta_description
 * @property string|null $meta_keywords
 * @property boolean $active
 * @property boolean $hot_sale
 * @property integer $count_views
 *
 * @property-read array $categories_ids
 *
 * @property \Domain\Shop\Models\Category $category
 * @property \Domain\Shop\Models\Category[]|\Illuminate\Database\Eloquent\Collection $categories
 * @property \Domain\Shop\Models\Brand $brand
 * @property \Domain\Shop\Models\Review[]|\Illuminate\Database\Eloquent\Collection $reviews
 *
 * @method static Builder catalog(?CatalogRequest $request = null)
 * @method static Builder filter(bool $applyFilter = true)
 */
class Product extends Model implements HasUrl
{
    use HasActiveState, HasSorting, HasFactory;

    protected $guarded = [];

    protected $appends = ['url'];

    protected $casts = [
        'category_id' => 'integer',
        'brand_id' => 'integer',
        'active' => 'boolean',
        'count_views' => 'integer',
        'gallery' => 'json',
        'variations' => 'array',
        'quantity' => 'integer',
        'price' => 'integer',
        'price_sale' => 'integer',
        'hot_sale' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_product', 'product_id', 'category_id');
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class)->where('active', true)->latest();
    }

    public function related(): HasMany
    {
        return $this->hasMany(Product::class, 'category_id', 'category_id')->where('id', '!=', $this->id)->inRandomOrder()->limit(5);
    }

    public function getRouteKeyName(): string
    {
        return 'hru';
    }

    public static function scopeCatalog(Builder $builder, ?CatalogRequest $request = null): Builder
    {
        if (is_null($request)) {
            $request = request();
        }

        $builder->unless($request->sort, function (Builder $builder): Builder {
            return $builder->orderBy('sort');
        });

        $builder->when($request->sort, function (Builder $builder) use ($request): Builder {
            if ($request->sort === 'relevance') {
                return $builder->orderBy('sort');
            }

            [$column, $type] = explode('.', $request->sort, 2);

            $realColumns = [
                'date' => 'created_at',
                'views' => 'count_views',
                'price' => 'price',
            ];

            $builder->orderBy($realColumns[$column], $type);

            return $builder;
        });

        $builder->where('quantity', '>', 0);

        $builder->when($request->category, function (Builder $builder) use ($request): Builder {
            return $builder->whereHas('categories', function (Builder $builder) use ($request): Builder {
                return $builder->whereIn('id', explode(',', $request->category));
            });
        });

        $builder->when($request->category_id, function (Builder $builder) use ($request): Builder {
            return $builder->whereHas('categories', function (Builder $builder) use ($request): Builder {
                return $builder->whereIn('id', explode(',', $request->category_id));
            });
        });

        $builder->when($request->brand, function (Builder $builder) use ($request): Builder {
            return $builder->whereIn('brand_id', explode(',', $request->brand));
        });

        $builder->when($request->price_from, function (Builder $builder) use ($request): Builder {
            return $builder->where('price', '>=', (int) $request->price_from);
        });

        $builder->when($request->price_to, function (Builder $builder) use ($request): Builder {
            return $builder->where('price', '<=', (int) $request->price_to);
        });

        $builder->when($request->discount, function (Builder $builder): Builder {
            return $builder->where('price_sale', '>', 0);
        });

        $builder->when(request('featured'), function (Builder $builder): Builder {
            return $builder->where('hot_sale', true);
        });

        $builder->when($request->query('term'), function (Builder $builder): Builder {
            return $builder->where('name', 'LIKE', '%'.request()->get('term').'%');
        });

        return parent::scopeFilter($builder, false);
    }

    public static function scopeFilter(Builder $builder, bool $applyOrder = true): Builder
    {
        $builder->when(request('info'), function (Builder $builder): Builder {
            return $builder
                ->where('name', 'LIKE', '%'.request()->get('info').'%')
                ->orWhere('hru', 'LIKE', '%'.request()->get('info').'%');
        });

        $builder->when(request('category_id'), function (Builder $builder): Builder {
            return $builder->where('category_id', request('category_id'));
        });

        $builder->when(request('brand_id'), function (Builder $builder): Builder {
            return $builder->where('brand_id', request('brand_id'));
        });

        return parent::scopeFilter($builder, false);
    }

    public function getUrlAttribute(): string
    {
        return $this->url();
    }

    public function increaseView(): void
    {
        $this->update(['count_views' => $this->count_views + 1]);
    }

    public function url(): string
    {
        return route('shop::product', $this->hru);
    }

    public function link(): string
    {
        return route('shop::product', $this->hru);
    }

    public function price(): int
    {
        return (int) ($this->price_sale ?: $this->price);
    }

    public function recalculateRating(): void
    {
        $this->update([
            'rating' => number_format((float) $this->reviews->avg('rating'), 1, '.', ''),
        ]);
    }

    public function getCategoriesIdsAttribute(): array
    {
        return $this->categories?->pluck('id')?->toArray() ?? [];
    }
}
