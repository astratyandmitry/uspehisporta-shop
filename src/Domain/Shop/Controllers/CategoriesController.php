<?php

namespace Domain\Shop\Controllers;

use Illuminate\View\View;
use Domain\Shop\Models\Page;
use Domain\Shop\Requests\CatalogRequest;
use Domain\Shop\Repositories\CategoriesRepository;

/**
 * @version 1.0.1
 * @author Astratyan Dmitry <astratyandmitry@gmail.com>
 * @copyright 2020, ArmenianBros. <i@armenianbros.com>
 */
class CategoriesController extends Controller
{
    /**
     * @param \Domain\Shop\Requests\CatalogRequest $request
     * @param \Domain\Shop\Repositories\CategoriesRepository $categoryRepository
     * @return \Illuminate\View\View
     */
    public function __invoke(CatalogRequest $request, CategoriesRepository $categoryRepository): View
    {
        $this->setup(PAGE_CATALOG);

        return $this->view('categories.index', [
            'categories' => $categoryRepository->parents(),
        ]);
    }
}
