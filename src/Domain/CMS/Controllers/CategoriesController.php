<?php

namespace Domain\CMS\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Domain\Shop\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Domain\CMS\Requests\CategoryRequest;

class CategoriesController extends Controller
{
    protected ?string $section = SECTION_DICTIONARY;

    protected ?string $model = 'categories';

    public function __construct()
    {
        $parentCategories = Category::query()->whereNull('parent_id')->pluck('name', 'id')->toArray();
        $parentCategories['head'] = '— Только родительские';

        $this->with('parents', $parentCategories);
    }

    public function show(int $id): View
    {
        $model = Category::query()->findOrFail($id);

        return $this->view([
            'model' => $model,
        ]);
    }

    public function index(): View
    {
        $this->sortable = ! is_null(request('parent_id'));

        return $this->view([
            'models' => Category::filter()->paginate($this->paginationSize()),
        ]);
    }

    public function create(): View
    {
        return $this->view([
            'action' => $this->route('store'),
        ]);
    }

    public function store(CategoryRequest $request): RedirectResponse
    {
        /** @var \Domain\Shop\Models\Category $model */
        $model = Category::query()->create($request->validated());

        return $this->redirectSuccess('show', ['category' => $model->id]);
    }

    public function edit(int $id): View
    {
        /** @var \Domain\Shop\Models\Category $model */
        $model = Category::query()->findOrFail($id);

        return $this->view([
            'action' => $this->route('update', ['category' => $model->id]),
            'model' => $model,
        ]);
    }

    public function update(int $id, CategoryRequest $request): RedirectResponse
    {
        /** @var \Domain\Shop\Models\Category $model */
        $model = Category::query()->findOrFail($id);
        $model->update($request->validated());

        return $this->redirectSuccess('show', ['category' => $model->id]);
    }

    public function destroy(int $id, Request $request): RedirectResponse|JsonResponse
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
