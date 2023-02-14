<?php

namespace Domain\Shop\Controllers;

use Illuminate\View\View;
use Domain\Shop\Repositories\ProductsRepository;

/**
 * @version 1.0.1
 * @author Astratyan Dmitry <astratyandmitry@gmail.com>
 * @copyright 2020, ArmenianBros. <i@armenianbros.com>
 */
class ProductController extends Controller
{
    /**
     * @param string $hru
     * @param \Domain\Shop\Repositories\ProductsRepository $repository
     * @return \Illuminate\View\View
     */
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
