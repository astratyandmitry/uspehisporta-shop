<?php

namespace Domain\CMS\Controllers;

use Illuminate\View\View;
use Domain\Shop\Models\Review;
use Domain\Shop\Models\Product;

/**
 * @version   1.0.1
 * @author    Astratyan Dmitry <astratyandmitry@gmail.com>
 * @copyright 2018, ArmenianBros. <i@armenianbros.com>
 */
class ReviewsController extends Controller
{
    /**
     * @var string
     */
    protected $section = SECTION_MAIN;

    /**
     * @var string
     */
    protected $model = 'reviews';

    /**
     * @var bool
     */
    protected $addable = false;

    /**
     * @return void
     */
    public function __construct()
    {
        $this->with('products', Product::query()->where('active', true)->pluck('name', 'id')->toArray());
    }

    /**
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show(int $id): View
    {
        $model = Review::query()->findOrFail($id);

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
            'models' => Review::filter()->paginate($this->paginationSize()),
        ]);
    }

    /**
     * @param int $id
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(int $id, \Illuminate\Http\Request $request)
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
