<?php

namespace Domain\Shop\Controllers;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Domain\Shop\Requests\ReviewRequest;
use Domain\Shop\Repositories\ReviewsRepository;
use Domain\Shop\Repositories\ProductsRepository;

/**
 * @version 1.0.1
 * @author Astratyan Dmitry <astratyandmitry@gmail.com>
 * @copyright 2020, ArmenianBros. <i@armenianbros.com>
 */
class ProductReviewController extends Controller
{
    /**
     * @param string $hru
     * @param \Domain\Shop\Repositories\ProductsRepository $repository
     * @return \Illuminate\View\View
     */
    public function form(string $hru, ProductsRepository $repository): View
    {
        $product = $repository->findByHru($hru);

        $this->setup(PAGE_PRODUCT_REVIEW);

        return $this->view('product.review-form', [
            'product' => $product,
        ]);
    }

    /**
     * @param string $hru
     * @param \Domain\Shop\Requests\ReviewRequest $request
     * @param \Domain\Shop\Repositories\ProductsRepository $productsRepository
     * @param \Domain\Shop\Repositories\ReviewsRepository $reviewsRepository
     * @return \Illuminate\Http\RedirectResponse
     */
    public function process(
        string $hru,
        ReviewRequest $request,
        ProductsRepository $productsRepository,
        ReviewsRepository $reviewsRepository
    ): RedirectResponse {
        /** @var \Domain\Shop\Models\User $user */
        $user = auth('shop')->user();

        $product = $productsRepository->findByHru($hru);

        $reviewsRepository->write($user, $product, $request);

        return redirect()->to($product->url().'#reviews')
            ->with('message', 'Ваш отзыв был успешно отправлен и появится на сайте после проверки модератором');
    }
}
