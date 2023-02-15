<?php

namespace Domain\Shop\Controllers;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Domain\Shop\Requests\ReviewRequest;
use Domain\Shop\Repositories\ReviewsRepository;
use Domain\Shop\Repositories\ProductsRepository;

class ProductReviewController extends Controller
{
    public function form(string $hru, ProductsRepository $repository): View
    {
        $product = $repository->findByHru($hru);

        $this->setup(PAGE_PRODUCT_REVIEW);

        return $this->view('product.review-form', [
            'product' => $product,
        ]);
    }

    public function process(
        string $hru,
        ReviewRequest $request,
        ProductsRepository $productsRepository,
        ReviewsRepository $reviewsRepository
    ): RedirectResponse {
        /** @var \Domain\Shop\Models\User $user */
        $user = auth(SHOP_GUARD)->user();

        $product = $productsRepository->findByHru($hru);

        $reviewsRepository->write($user, $product, $request);

        return redirect()->to($product->url().'#reviews')
            ->with('message', 'Ваш отзыв был успешно отправлен и появится на сайте после проверки модератором');
    }
}
