<?php

namespace Domain\Shop\Controllers;

use Domain\Shop\Models\Page;
use Domain\Shop\Requests\CatalogRequest;
use Domain\Shop\Repositories\ProductsRepository;
use Domain\Shop\Repositories\CategoriesRepository;

/**
 * @version 1.0.1
 * @author Astratyan Dmitry <astratyandmitry@gmail.com>
 * @copyright 2020, ArmenianBros. <i@armenianbros.com>
 */
class SearchController extends Controller
{
    /**
     * @param \Domain\Shop\Requests\CatalogRequest $request
     * @param \Domain\Shop\Repositories\ProductsRepository $productsRepository
     * @param \Domain\Shop\Repositories\CategoriesRepository $categoriesRepository
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function __invoke(
        CatalogRequest $request,
        ProductsRepository $productsRepository,
        CategoriesRepository $categoriesRepository
    ) {
        if ($request->wantsJson()) {
            return response()->json([
                'products' => $productsRepository->catalog($request),
            ]);
        }

        $this->setup(PAGE_SEARCH)
            ->setBreadcrumbs([])
            ->addCatalogBreadcrumb()
            ->addBreadcrumb('Поиск');

        return $this->view('product.index', [
            'catalog' => app('catalog')->init($request),
        ]);
    }
}
