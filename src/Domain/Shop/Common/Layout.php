<?php

namespace Domain\Shop\Common;

use Domain\Shop\Models\Model;
use Domain\Shop\Models\Category;
use Domain\Shop\Models\Page;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Session;

/**
 * @version 1.0.1
 * @author Astratyan Dmitry <astratyandmitry@gmail.com>
 * @copyright 2020, ArmenianBros. <i@armenianbros.com>
 */
class Layout
{
    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $meta_description;

    /**
     * @var string
     */
    public $meta_keywords;

    /**
     * @var array
     */
    protected $data = [];

    /**
     * @var boolean
     */
    public $withBreadcrumbs = true;

    /**
     * @var boolean
     */
    public $withTitle = true;

    /**
     * @var array
     */
    public $breadcrumbs = [];

    /**
     * @return void
     */
    public function __construct()
    {
        $this->setupData();
    }

    /**
     * @return void
     */
    private function setupData(): void
    {
        $this->data['categories'] = Category::query()->whereNull('parent_id')->with('children')->get();
        $this->data['pages'] = Page::query()->where('nav', true)->get();
    }

    /**
     * @param string|null $title
     *
     * @return \Domain\Shop\Common\Layout
     */
    public function setTitle(?string $title = null): Layout
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @param \Domain\Shop\Models\Model $model
     *
     * @return \Domain\Shop\Common\Layout
     */
    public function setMeta(Model $model): Layout
    {
        foreach (['meta_description', 'meta_keywords'] as $metaAttribute) {
            if (property_exists($model, $metaAttribute)) {
                $this->{$metaAttribute} = $model->getAttribute($metaAttribute);
            }
        }

        return $this;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Domain\Shop\Models\Category[]
     */
    public function getCategories(): Collection
    {
        return $this->data['categories'];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Domain\Shop\Models\Category[]
     */
    public function getPages(): Collection
    {
        return $this->data['pages'];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Domain\Shop\Models\Category[]
     */
    public function getCities(): Collection
    {
        return $this->data['cities'];
    }


    /**
     * @return \Domain\Shop\Common\Layout
     */
    public function hideBreadcrumbs(): Layout
    {
        $this->withBreadcrumbs = false;

        return $this;
    }

    /**
     * @return \Domain\Shop\Common\Layout
     */
    public function hideTitle(): Layout
    {
        $this->withTitle = false;

        return $this;
    }

    /**
     * @param string $breadcrumb
     * @param string $url
     *
     * @return \Domain\Shop\Common\Layout
     */
    public function addBreadcrumb(string $breadcrumb, string $url = '#'): Layout
    {
        $this->breadcrumbs[$url] = $breadcrumb;

        return $this;
    }

    /**
     * @return \Domain\Shop\Common\Layout
     */
    public function addCatalogBreadcrumb(): Layout
    {
        $this->breadcrumbs[route('shop::categories')] = 'Каталог';

        return $this;
    }

    /**
     * @param array $breadcrumbs
     *
     * @return \Domain\Shop\Common\Layout
     */
    public function setBreadcrumbs(array $breadcrumbs): Layout
    {
        $this->breadcrumbs = $breadcrumbs;

        return $this;
    }

    /**
     * @return bool
     */
    public function hasBreadcrumbs(): bool
    {
        return count($this->breadcrumbs) > 0;
    }

}
