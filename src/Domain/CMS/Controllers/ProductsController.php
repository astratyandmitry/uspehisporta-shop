<?php

namespace Domain\CMS\Controllers;

use Domain\CMS\Requests\ProductRequest;
use Illuminate\View\View;
use Domain\Shop\Models\Brand;
use Domain\Shop\Models\Product;
use Domain\Shop\Models\Category;
use Illuminate\Http\RedirectResponse;
use Domain\CMS\Requests\ProductRequest as Request;

/**
 * @version   1.0.1
 * @author    Astratyan Dmitry <astratyandmitry@gmail.com>
 * @copyright 2018, ArmenianBros. <i@armenianbros.com>
 */
class ProductsController extends Controller
{
    /**
     * @var string
     */
    protected $section = SECTION_MAIN;

    /**
     * @var string
     */
    protected $model = 'products';

    /**
     * @return void
     */
    public function __construct()
    {
        $this->with('categories', Category::groupedOptions());
        $this->with('brands', Brand::query()->pluck('name', 'id')->toArray());
    }

    /**
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show(int $id): View
    {
        $model = Product::query()->findOrFail($id);

        return $this->view([
            'model' => $model,
        ]);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return $this->view([
            'models' => Product::filter()->paginate($this->paginationSize()),
        ]);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return $this->view([
            'action' => $this->route('store'),
        ]);
    }

    /**
     * @param \Domain\CMS\Requests\ProductRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        /** @var \Domain\Shop\Models\Product $model */
        $model = Product::query()->create(
            $this->getAttributesFromRequest($request)
        );

        return $this->redirectSuccess('show', ['product' => $model->id]);
    }

    /**
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit(int $id): View
    {
        /** @var \Domain\Shop\Models\Product $model */
        $model = Product::query()->findOrFail($id);

        return $this->view([
            'action' => $this->route('update', $model->id),
            'model' => $model,
        ]);
    }

    /**
     * @param int $id
     * @param \Domain\CMS\Requests\ProductRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(int $id, Request $request): RedirectResponse
    {
        /** @var \Domain\Shop\Models\Product $model */
        $model = Product::query()->findOrFail($id);;
        $model->update(
            $this->getAttributesFromRequest($request)
        );

        return $this->redirectSuccess('show', ['product' => $model->id]);
    }

    /**
     * @param int $id
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(int $id, \Illuminate\Http\Request $request)
    {
        /** @var \Domain\Shop\Models\Product $model */
        $model = Product::query()->findOrFail($id);
        $model->delete();

        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }

        return $this->redirectDanger();
    }

    /**
     * @param \Domain\CMS\Requests\ProductRequest $request
     * @return array
     */
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

        return array_merge(
            $request->validated(),
            [
                'quantity' => $quantity,
                'variations' => $variations,
                'gallery' => $gallery,
            ]
        );
    }
}
