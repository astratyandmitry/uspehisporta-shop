<?php

namespace Domain\CMS\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Domain\Shop\Models\Brand;
use Domain\Shop\Models\Product;
use Domain\Shop\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Domain\CMS\Requests\ProductRequest;

class ProductsController extends Controller
{
    protected string $section = SECTION_MAIN;

    protected string $model = 'products';

    public function __construct()
    {
        $this->with('categories', Category::groupedOptions());
        $this->with('brands', Brand::query()->pluck('name', 'id')->toArray());
    }

    public function show(int $id): View
    {
        $model = Product::query()->findOrFail($id);

        return $this->view([
            'model' => $model,
        ]);
    }

    public function index(): View
    {
        return $this->view([
            'models' => Product::filter()->paginate($this->paginationSize()),
        ]);
    }

    public function create(): View
    {
        return $this->view([
            'action' => $this->route('store'),
        ]);
    }

    public function store(ProductRequest $request): RedirectResponse
    {
        /** @var \Domain\Shop\Models\Product $model */
        $model = Product::query()->create(
            $this->getAttributesFromRequest($request)
        );

        return $this->redirectSuccess('show', ['product' => $model->id]);
    }

    public function edit(int $id): View
    {
        /** @var \Domain\Shop\Models\Product $model */
        $model = Product::query()->findOrFail($id);

        return $this->view([
            'action' => $this->route('update', ['product' => $model->id]),
            'model' => $model,
        ]);
    }

    public function update(int $id, ProductRequest $request): RedirectResponse
    {
        /** @var \Domain\Shop\Models\Product $model */
        $model = Product::query()->findOrFail($id);;
        $model->update(
            $this->getAttributesFromRequest($request)
        );

        return $this->redirectSuccess('show', ['product' => $model->id]);
    }

    public function destroy(int $id, Request $request): RedirectResponse|JsonResponse
    {
        /** @var \Domain\Shop\Models\Product $model */
        $model = Product::query()->findOrFail($id);
        $model->delete();

        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }

        return $this->redirectDanger();
    }

    protected function getAttributesFromRequest(ProductRequest $request): array
    {
        $gallery = $request->get('gallery') ? json_decode($request->get('gallery'), true) : [];
        $variations = $request->get('variations') ? json_decode($request->get('variations'), true) : [];

        if (count($variations)) {
            $variations = array_filter($variations, function ($item) {
                return (int) $item['quantity'] > 0 && ! empty($item['name']);
            });
        }

        $quantity = count($variations) ? array_sum(array_column($variations, 'quantity')) : $request->get('quantity');

        return array_merge($request->validated(), [
            'quantity' => $quantity,
            'variations' => $variations,
            'gallery' => $gallery,
        ]);
    }
}
