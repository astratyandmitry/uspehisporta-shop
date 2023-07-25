<?php

namespace Domain\Shop\Controllers;

use Illuminate\View\View;
use Domain\Shop\Repositories\ProductsRepository;

class ProductController extends Controller
{
    public function __invoke(string $hru, ProductsRepository $repository): View
    {
        $product = $repository->findByHru($hru);
        $product->increaseView();

        $this->layout
            ->setTitle($product->name)
            ->setMeta($product)
            ->addCatalogBreadcrumb();

        return $this->view('product.show', [
            'product' => $product,
        ]);
    }
}
