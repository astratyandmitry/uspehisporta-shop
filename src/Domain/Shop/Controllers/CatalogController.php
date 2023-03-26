<?php

namespace Domain\Shop\Controllers;

use Illuminate\View\View;
use Domain\Shop\Requests\CatalogRequest;
use Domain\Shop\Repositories\CategoriesRepository;

class CatalogController extends Controller
{
    public function __invoke(
        string $parentHru,
        CatalogRequest $request,
        CategoriesRepository $categoryRepository,
        ?string $childHru = null,
    ): View {
        $catalogCategory = null;

        if (! $parentHru) {
            $this->setup(PAGE_CATALOG)
                ->setBreadcrumbs([])
                ->addCatalogBreadcrumb();
        } else {
            $parentCategory = $catalogCategory = $categoryRepository->findByHru($parentHru);
            $childCategory = null;

            $this->layout
                ->setTitle($parentCategory->title)
                ->setMeta($parentCategory)
                ->addCatalogBreadcrumb()
                ->addBreadcrumb($parentCategory->name, $parentCategory->url());

            if ($childHru !== null) {
                $childCategory = $catalogCategory = $categoryRepository->findByHru($childHru);

                abort_unless(optional($childCategory->parent)->is($parentCategory), 404);

                $this->layout
                    ->setTitle($childCategory->title)
                    ->addBreadcrumb($childCategory->name, $childCategory->url());
            }
        }

        return $this->view('product.index', [
            'catalog' => app('catalog')->init($request, $catalogCategory),
            'category' => $catalogCategory,
        ]);
    }
}
