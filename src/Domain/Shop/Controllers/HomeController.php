<?php

namespace Domain\Shop\Controllers;

use Domain\Shop\Repositories\CatalogRepository;
use Illuminate\View\View;
use Domain\Shop\Repositories\BannersRepository;
use Domain\Shop\Repositories\ProductsRepository;
use Domain\Shop\Repositories\CategoriesRepository;

/**
 * @version 1.0.1
 * @author Astratyan Dmitry <astratyandmitry@gmail.com>
 * @copyright 2020, ArmenianBros. <i@armenianbros.com>
 */
class HomeController extends Controller
{
    /**
     * @param \Domain\Shop\Repositories\CatalogRepository $catalogRepository
     * @param \Domain\Shop\Repositories\CategoriesRepository $categoriesRepository
     * @param \Domain\Shop\Repositories\BannersRepository $bannersRepository
     *
     * @return \Illuminate\View\View
     */
    public function __invoke(
        CatalogRepository $catalogRepository,
        CategoriesRepository $categoriesRepository,
        BannersRepository $bannersRepository
    ): View {
        $this->setup(PAGE_HOME);

        $this->layout->setTitle()->hideTitle()->hideBreadcrumbs();

        return $this->view('home.index', [
            'featuredProducts' => $catalogRepository->featured(),
            'popularProducts' => $catalogRepository->popular(),
            'latestProducts' => $catalogRepository->latest(),
            'mainBanners' => $bannersRepository->main(),
            'splitBanners' => $bannersRepository->productsSplit(),
            'categories' => $categoriesRepository->parents(),
        ]);
    }
}
