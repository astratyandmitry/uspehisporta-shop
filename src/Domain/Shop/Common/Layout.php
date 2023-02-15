<?php

namespace Domain\Shop\Common;

use Domain\Shop\Models\Model;
use Domain\Shop\Models\Category;
use Domain\Shop\Models\Page;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Session;

class Layout
{
    public string $title;

    public ?string $meta_description = null;

    public ?string $meta_keywords = null;

    protected array $data = [];

    public bool $withBreadcrumbs = true;

    public bool $withTitle = true;

    public array $breadcrumbs = [];

    public function __construct()
    {
        $this->setupData();
    }

    private function setupData(): void
    {
        $this->data['categories'] = Category::query()->whereNull('parent_id')->with('children')->get();
    }

    public function setTitle(?string $title = null): Layout
    {
        $this->title = $title;

        return $this;
    }

    public function setMeta(Model $model): Layout
    {
        foreach (['meta_description', 'meta_keywords'] as $metaAttribute) {
            if (property_exists($model, $metaAttribute)) {
                $this->{$metaAttribute} = $model->getAttribute($metaAttribute);
            }
        }

        return $this;
    }

    public function getCategories(): Collection
    {
        return $this->data['categories'];
    }

    public function hideBreadcrumbs(): Layout
    {
        $this->withBreadcrumbs = false;

        return $this;
    }

    public function hideTitle(): Layout
    {
        $this->withTitle = false;

        return $this;
    }

    public function addBreadcrumb(string $breadcrumb, string $url = '#'): Layout
    {
        $this->breadcrumbs[$url] = $breadcrumb;

        return $this;
    }

    public function addCatalogBreadcrumb(): Layout
    {
        $this->breadcrumbs[route('shop::categories')] = 'Каталог';

        return $this;
    }

    public function setBreadcrumbs(array $breadcrumbs): Layout
    {
        $this->breadcrumbs = $breadcrumbs;

        return $this;
    }

    public function hasBreadcrumbs(): bool
    {
        return count($this->breadcrumbs) > 0;
    }
}
