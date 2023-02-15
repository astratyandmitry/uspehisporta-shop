<?php

namespace Domain\Console\Commands;

use Carbon\Carbon;
use Domain\Shop\Models\Category;
use Domain\Shop\Models\Page;
use Domain\Shop\Models\Product;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemapCommand extends Command
{
    protected $signature = 'sitemap:generate';

    public function handle(): int
    {
        $sitemap = Sitemap::create();

        $sitemap->add(Url::create(route('shop::home'))
            ->setLastModificationDate(Carbon::yesterday())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
            ->setPriority(0.3));

        $sitemap->add(Url::create(route('shop::categories'))
            ->setLastModificationDate(Carbon::yesterday())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
            ->setPriority(0.5));

        $sitemap->add(Url::create(route('shop::search'))
            ->setLastModificationDate(Carbon::yesterday())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
            ->setPriority(0.1));

        $pages = Page::query()->where('system', false)->get();

        foreach ($pages as $page) {
            $sitemap->add(Url::create(route('shop::page', $page))
                ->setLastModificationDate($page->updated_at)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
                ->setPriority(0.2));
        }

        /** @var \Domain\Shop\Models\Product[] $products */
        $products = Product::query()->with('category', 'category.parent')->get();

        foreach ($products as $product) {
            $sitemap->add(Url::create($product->url())
                ->setLastModificationDate($product->updated_at)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                ->setPriority(1.0));
        }

        /** @var \Domain\Shop\Models\Category[] $categories */
        $categories = Category::query()->get();

        foreach($categories AS $category) {
            $sitemap->add(Url::create($category->url())
                ->setLastModificationDate($category->updated_at)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.8));
        }

        $sitemap->writeToFile(public_path('sitemap.xml'));

        return 0;
    }
}
