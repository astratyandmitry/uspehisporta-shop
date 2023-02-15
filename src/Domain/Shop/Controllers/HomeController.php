<?php

namespace Domain\Shop\Controllers;

use Illuminate\View\View;
use Domain\Shop\Repositories\CatalogRepository;
use Domain\Shop\Repositories\CategoriesRepository;

class HomeController extends Controller
{
    public function __invoke(
        CatalogRepository $catalogRepository,
        CategoriesRepository $categoriesRepository,
    ): View {
        $this->setup(PAGE_HOME);

        $this->layout->setTitle()->hideTitle()->hideBreadcrumbs();

        return $this->view('home.index', [
            'latestProducts' => $catalogRepository->latest(),
            'categories' => $categoriesRepository->parents(),
        ]);
    }
}
