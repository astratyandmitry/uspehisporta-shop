<?php

namespace Domain\Shop;

use Domain\Shop\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Domain\Shop\Requests\CatalogRequest;
use Domain\Shop\Repositories\BrandsRepository;
use Domain\Shop\Repositories\CatalogRepository;
use Domain\Shop\Repositories\CategoriesRepository;

/**
 * @version 1.0.1
 * @author Astratyan Dmitry <astratyandmitry@gmail.com>
 * @copyright 2020, ArmenianBros. <i@armenianbros.com>
 */
class Catalog
{
    protected CatalogRequest $request;

    protected ?Category $category = null;

    /**
     * @var \Illuminate\Database\Eloquent\Collection|\Domain\Shop\Models\Product[]
     */
    public $products = [];

    public string $sorting = 'views.desc';

    public array $sortingOptions = [
        'views.desc' => 'По популярности',
        'date.desc' => 'Сначала новые',
        'date.asc' => 'Сначала старые',
        'price.asc' => 'Сначала дешевые',
        'price.desc' => 'Сначала дорогие',
    ];

    public Collection $brands;

    public Collection $categories;

    public array $categoriesQuery = [];

    public array $brandsQuery = [];

    public bool $saleOnly = false;

    public int $total = 0;

    public int $priceFrom = 0;

    public int $priceTo = 0;

    public int $priceMin = 0;

    public int $priceMax = 0;

    public function init(CatalogRequest $request, Category $category = null): Catalog
    {
        $this->request = $request;
        $this->category = $category;

        $this->setupSorting();
        $this->setupFilters();
        $this->setupPrice();
        $this->setupProducts();
        $this->setupOther();

        return $this;
    }

    protected function setupProducts(): void
    {
        $this->products = (new CatalogRepository)->find($this->request);
        $this->total = $this->products->total();
    }

    protected function setupSorting(): void
    {
        if ($sorting = request()->query('sort')) {
            if (isset($this->sortingOptions[$sorting])) {
                $this->sorting = $sorting;
            }
        }
    }

    protected function setupFilters(): void
    {
        $this->brands = (new BrandsRepository())->all();

        if ($this->request->brand) {
            $this->brandsQuery = explode(',', $this->request->brand);
        }

        if ($this->category) {
            $this->request->merge([
                'category_id' => $this->category->children->isNotEmpty()
                    ? implode(',', $this->category->children->pluck('id')->toArray() )
                    : $this->category->id,
            ]);
        }

        if ($this->category) {
            $this->categories = optional($this->category->parent)->children ?? $this->category->children;
        } else {
            $this->categories = (new CategoriesRepository())->children();
        }

        if ($this->request->category) {
            $this->categoriesQuery = explode(',', $this->request->category);
        }

        $resetCategoriesQuery = false;

        if (! count($this->categoriesQuery)) {
            if (optional($this->category)->parent) {
                $this->categoriesQuery[] = $this->category->id;
            } else {
                $this->categoriesQuery = $this->categories->pluck('id')->toArray();

                $resetCategoriesQuery = true;
            }
        }

        $this->request->merge(['category' => implode(',', $this->categoriesQuery)]);

        if ($resetCategoriesQuery === true) {
            $this->categoriesQuery = [];
        }
    }

    protected function setupPrice(): void
    {
        $stats = DB::table('products')->selectRaw('min(price) as min, max(price) as max')->first();

        $this->priceMin = $stats->min;
        $this->priceMax = $stats->max;

        $this->priceFrom = (int) $this->request->query('price_from', $this->priceMin);
        $this->priceTo = (int) $this->request->query('price_to', $this->priceMax);

        if ($this->priceFrom > $this->priceTo) {
            $priceTmp = $this->priceFrom;
            $this->priceTo = $this->priceFrom;
            $this->priceFrom = $priceTmp;
        }
    }

    protected function setupOther(): void
    {
        $this->saleOnly = $this->request->discount;
    }

    public function sortingLabel(): string
    {
        return $this->sortingOptions[$this->sorting];
    }

    public function resetUrl(): string
    {
        return trim(explode('?', url()->current())[0], '/');
    }

    public function sortingUrl(): string
    {
        $params = request()->all();
        unset($params['page'], $params['sort']);

        if (! count($params)) {
            return $this->resetUrl();
        }

        return $this->resetUrl().'?'.urldecode(http_build_query($params));
    }
}
