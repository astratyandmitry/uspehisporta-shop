<?php

namespace Domain\CMS\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Domain\Shop\Models\Review;
use Domain\Shop\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class ReviewsController extends Controller
{
    protected string $section = SECTION_MAIN;

    protected string $model = 'reviews';

    protected bool $addable = false;

    public function __construct()
    {
        $this->with('products', Product::query()->where('active', true)->pluck('name', 'id')->toArray());
    }

    public function show(int $id): View
    {
        $model = Review::query()->findOrFail($id);

        return $this->view([
            'model' => $model,
        ]);
    }

    public function index(): View
    {
        return $this->view([
            'models' => Review::filter()->paginate($this->paginationSize()),
        ]);
    }

    public function destroy(int $id, Request $request): RedirectResponse|JsonResponse
    {
        /** @var \Domain\Shop\Models\Page $model */
        $model = Review::query()->findOrFail($id);
        $model->delete();

        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }

        return $this->redirectDanger();
    }
}
