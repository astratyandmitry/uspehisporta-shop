<?php

namespace Domain\Shop;

use Domain\Shop\Models\Category;
use Domain\Shop\Repositories\BrandsRepository;
use Domain\Shop\Repositories\CatalogRepository;
use Domain\Shop\Repositories\CategoriesRepository;
use Domain\Shop\Requests\CatalogRequest;
use Illuminate\Support\Facades\DB;

/**
 * @version 1.0.1
 * @author Astratyan Dmitry <astratyandmitry@gmail.com>
 * @copyright 2020, ArmenianBros. <i@armenianbros.com>
 */
class Catalog
{
    /**
     * @var \Domain\Shop\Requests\CatalogRequest
     */
    protected $request;

    /**
     * @var \Domain\Shop\Models\Category
     */
    protected $category;

    /**
     * @var array|\Domain\Shop\Models\Product[]
     */
    public $products = [];

    /**
     * @var string
     */
    public $sorting = 'views.desc';

    /**
     * @var array
     */
    public $sortingOptions = [
        'views.desc' => 'По популярности',
        'date.desc' => 'Сначала новые',
        'date.asc' => 'Сначала старые',
        'price.asc' => 'Сначала дешевые',
        'price.desc' => 'Сначала дорогие',
    ];

    /**
     * @var array
     */
    public $brands = [];

    /**
     * @var array
     */
    public $categories = [];

    /**
     * @var array
     */
    public $categoriesQuery = [];

    /**
     * @var array
     */
    public $brandsQuery = [];

    /**
     * @var boolean
     */
    public $saleOnly = false;

    /**
     * @var int
     */
    public $total = 0;

    /**
     * @var int
     */
    public $priceFrom = 0;

    /**
     * @var int
     */
    public $priceTo = 0;

    /**
     * @var int
     */
    public $priceMin = 0;

    /**
     * @var int
     */
    public $priceMax = 0;

    /**
     * @param \Domain\Shop\Requests\CatalogRequest $request
     * @param \Domain\Shop\Models\Category|null $category
     * @return \Domain\Shop\Catalog
     */
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

    /**
     * @return void
     */
    protected function setupProducts(): void
    {
        $this->products = (new CatalogRepository)->find($this->request);
        $this->total = $this->products->total();
    }

    /**
     * @return void
     */
    protected function setupSorting(): void
    {
        if ($sorting = request()->query('sort')) {
            if (isset($this->sortingOptions[$sorting])) {
                $this->sorting = $sorting;
            }
        }
    }

    /**
     * @return void
     */
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

    /**
     * @return void
     */
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

    /**
     * @return void
     */
    protected function setupOther(): void
    {
        $this->saleOnly = $this->request->discount;
    }

    /**
     * @return string
     */
    public function sortingLabel(): string
    {
        return $this->sortingOptions[$this->sorting];
    }

    /**
     * @return string
     */
    public function resetUrl(): string
    {
        return trim(explode('?', url()->current())[0], '/');
    }

    /**
     * @return string
     */
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
