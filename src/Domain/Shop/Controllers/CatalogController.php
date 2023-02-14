<?php

namespace Domain\Shop\Controllers;

use Domain\Shop\Repositories\BrandsRepository;
use Domain\Shop\Repositories\CategoriesRepository;
use Domain\Shop\Repositories\ProductsRepository;
use Domain\Shop\Requests\CatalogRequest;
use Illuminate\View\View;

/**
 * @version 1.0.1
 * @author Astratyan Dmitry <astratyandmitry@gmail.com>
 * @copyright 2020, ArmenianBros. <i@armenianbros.com>
 */
class CatalogController extends Controller
{
    /**
     * @param string $parentHru
     * @param string|null $childHru
     * @param \Domain\Shop\Requests\CatalogRequest $request
     * @param \Domain\Shop\Repositories\CategoriesRepository $categoryRepository
     * @return \Illuminate\View\View
     */
    public function __invoke(
        string $parentHru,
        ?string $childHru = null,
        CatalogRequest $request,
        CategoriesRepository $categoryRepository
    ): View {
        $parentCategory = $categoryRepository->findByHru($parentHru);
        $childCategory = null;

        $this->layout
            ->setTitle($parentCategory->title)
            ->setMeta($parentCategory)
            ->addCatalogBreadcrumb()
            ->addBreadcrumb($parentCategory->name, $parentCategory->url());

        if ($childHru !== null) {
            $childCategory = $categoryRepository->findByHru($childHru);

            abort_unless(optional($childCategory->parent)->is($parentCategory), 404);

            $this->layout
                ->setTitle($childCategory->title)
                ->addBreadcrumb($childCategory->name, $childCategory->url());
        }

        return $this->view('product.index', [
            'catalog' => app('catalog')->init($request, $childCategory ?? $parentCategory),
        ]);
    }
}
