<?php

namespace Domain\Shop\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Domain\Shop\Requests\BasketRequest;
use Domain\Shop\Repositories\OrdersRepository;
use Domain\Shop\Repositories\BasketRepository;
use Domain\Shop\Repositories\ProductsRepository;

class BasketController extends Controller
{
    public function index(OrdersRepository $repository): View
    {
        $this->setup(PAGE_BASKET);

        return $this->view('basket.index', [
            'baskets' => app('basket')->getItems()->toArray(),
            'order_prev' => $repository->last(),
        ]);
    }

    public function decrease(
        BasketRequest $request,
        ProductsRepository $productsRepository,
        BasketRepository $basketRepository
    ): JsonResponse {
        list ($basket) = $this->prepareUpdate($request, $productsRepository, $basketRepository);

        if ($basket->count > 1) {
            $basket->count--;

            $basketRepository->updateCount($basket->id, $basket->count);
        }

        return response()->json([
            'count' => $basket->count,
            'total' => '₽' . number_format(app('basket')->total()),
        ]);
    }

    public function increase(
        BasketRequest $request,
        ProductsRepository $productsRepository,
        BasketRepository $basketRepository
    ): JsonResponse {
        /** @var \Domain\Shop\Models\Product $product */
        list ($basket, $product) = $this->prepareUpdate($request, $productsRepository, $basketRepository);

        if ($basket->count < ($product->variations[$request->variation]['quantity'] ?? $product->quantity)) {
            $basket->count++;

            $basketRepository->updateCount($basket->id, $basket->count);
        }

        return response()->json([
            'count' => $basket->count,
            'total' => '₽' . number_format(app('basket')->total()),
        ]);
    }

    public function store(
        BasketRequest $request,
        ProductsRepository $productsRepository,
        BasketRepository $basketRepository
    ): JsonResponse {
        list ($basket, $product) = $this->prepareUpdate($request, $productsRepository, $basketRepository);

        $count = (int) $request->get('quantity', 1);

        if ($count > $product->quantity) {
            $count = $product->quantity;
        }

        $basket->count = $count;

        $basketRepository->updateCount($basket->id, $basket->count);

        return response()->json([
            'count' => $basket->count,
            'total' => '₽' . number_format(app('basket')->total()),
        ]);
    }

    protected function prepareUpdate(
        BasketRequest $request,
        ProductsRepository $productsRepository,
        BasketRepository $basketRepository
    ): array {
        $product = $productsRepository->findById($request->product_id);

        $basket = $basketRepository->findByProduct($product, $request->variation);

        return [$basket, $product];
    }

    public function destroy(int $id, BasketRepository $repository): Response
    {
        $repository->deleteById($id);

        return response()->noContent();
    }
}
