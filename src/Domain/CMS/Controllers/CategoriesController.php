<?php

namespace Domain\CMS\Controllers;

use Illuminate\View\View;
use Domain\Shop\Models\Category;
use Illuminate\Http\RedirectResponse;
use Domain\CMS\Requests\CategoryRequest as Request;

/**
 * @version   1.0.1
 * @author    Astratyan Dmitry <astratyandmitry@gmail.com>
 * @copyright 2018, ArmenianBros. <i@armenianbros.com>
 */
class CategoriesController extends Controller
{
    /**
     * @var string
     */
    protected $section = SECTION_DICTIONARY;

    /**
     * @var string
     */
    protected $model = 'categories';

    /**
     * @return void
     */
    public function __construct()
    {
        $parentCategories = Category::query()->whereNull('parent_id')->pluck('name', 'id')->toArray();
        $parentCategories['head'] = '— Только родительские';

        $this->with('parents', $parentCategories);
    }

    /**
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show(int $id): View
    {
        $model = Category::query()->findOrFail($id);

        return $this->view([
            'model' => $model,
        ]);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $this->sortable = ! is_null(request('parent_id'));

        return $this->view([
            'models' => Category::filter()->paginate($this->paginationSize()),
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
     * @param \Domain\CMS\Requests\CategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        /** @var \Domain\Shop\Models\Category $model */
        $model = Category::query()->create($request->validated());

        return $this->redirectSuccess('show', ['category' => $model->id]);
    }

    /**
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit(int $id): View
    {
        /** @var \Domain\Shop\Models\Category $model */
        $model = Category::query()->findOrFail($id);

        return $this->view([
            'action' => $this->route('update', $model->id),
            'model' => $model,
        ]);
    }

    /**
     * @param int $id
     * @param \Domain\CMS\Requests\CategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(int $id, Request $request): RedirectResponse
    {
        /** @var \Domain\Shop\Models\Category $model */
        $model = Category::query()->findOrFail($id);
        $model->update($request->validated());

        return $this->redirectSuccess('show', ['category' => $model->id]);
    }

    /**
     * @param int $id
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(int $id, \Illuminate\Http\Request $request)
    {
        /** @var \Domain\Shop\Models\Category $model */
        $model = Category::query()->findOrFail($id);
        $model->delete();

        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }

        return $this->redirectDanger();
    }
}
