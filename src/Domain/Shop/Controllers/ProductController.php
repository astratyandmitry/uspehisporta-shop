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

        if ($product->category->parent) {
            $this->layout->addBreadcrumb($product->category->parent->name, $product->category->parent->url());
        }

        $this->layout
            ->addBreadcrumb($product->category->name, $product->category->url())
            ->addBreadcrumb($product->name);

        return $this->view('product.show', [
            'product' => $product,
        ]);
    }
}
