<?php

namespace Domain\Shop\Common;

use Domain\Shop\Models\Model;
use Domain\Shop\Models\Category;
use Domain\Shop\Models\Page;
use Domain\Shop\Models\Settings;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Session;

class Layout
{
    public ?string $title = null;

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
        $this->data['categories'] = Category::query()->whereNull('parent_id')->withCount('products')->get();
        $this->data['settings'] = Settings::options();
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

    public function getSettings(string $key): ?string
    {
        return $this->data['settings'][$key] ?? null;
    }

    public function getOptionsPayment(): array
    {
        return  [
            [
                'icon' => 'crypto',
                'title' => 'Криптовалюта',
                'detail' => 'Оплата на любой крипто-кошелек',
            ],
            [
                'icon' => 'sber',
                'title' => 'СБЕРБАНК',
                'detail' => 'Перевод на карту',
            ],
            [
                'icon' => 'vtb',
                'title' => 'ВТБ',
                'detail' => 'Перевод на карту',
            ],
            [
                'icon' => 'tinkoff',
                'title' => 'ТИНЬКОФ',
                'detail' => 'Перевод на карту',
            ],
        ];
    }

    public function getOptionsDelivery(): array
    {
        return  [
            [
                'icon' => 'post',
                'title' => 'Почта России',
                'detail' => '500 ₽, от 2 до 10 дней',
            ],
            [
                'icon' => 'ems',
                'title' => 'EMS',
                'detail' => 'Срочная доставка, от 2 до 4 дней',
            ],
        ];
    }
}
