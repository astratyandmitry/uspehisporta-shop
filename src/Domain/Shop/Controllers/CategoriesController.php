<?php

namespace Domain\Shop\Controllers;

use Illuminate\View\View;
use Domain\Shop\Requests\CatalogRequest;
use Domain\Shop\Repositories\CategoriesRepository;

class CategoriesController extends Controller
{
    public function __invoke(CatalogRequest $request, CategoriesRepository $categoryRepository): View
    {
        $this->setup(PAGE_CATALOG);

        return $this->view('categories.index', [
            'categories' => $categoryRepository->parents(),
        ]);
    }
}
