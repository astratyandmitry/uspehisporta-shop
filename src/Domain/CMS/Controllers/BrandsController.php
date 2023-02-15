<?php

namespace Domain\CMS\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Domain\Shop\Models\Brand;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Domain\CMS\Requests\BrandRequest;

class BrandsController extends Controller
{
    protected string $section = SECTION_DICTIONARY;

    protected string $model = 'brands';

    protected bool $sortable = true;

    public function show(int $id): View
    {
        $model = Brand::query()->findOrFail($id);

        return $this->view([
            'model' => $model,
        ]);
    }

    public function index(): View
    {
        return $this->view([
            'models' => Brand::filter()->paginate($this->paginationSize()),
        ]);
    }

    public function create(): View
    {
        return $this->view([
            'action' => $this->route('store'),
        ]);
    }

    public function store(BrandRequest $request): RedirectResponse
    {
        /** @var \Domain\Shop\Models\Brand $model */
        $model = Brand::query()->create($request->validated());

        return $this->redirectSuccess('show', ['brand' => $model->id]);
    }

    public function edit(int $id): View
    {
        /** @var \Domain\Shop\Models\Brand $model */
        $model = Brand::query()->findOrFail($id);

        return $this->view([
            'action' => $this->route('update', ['brand' => $model->id]),
            'model' => $model,
        ]);
    }

    public function update(int $id, BrandRequest $request): RedirectResponse
    {
        /** @var \Domain\Shop\Models\Brand $model */
        $model = Brand::query()->findOrFail($id);
        $model->update($request->validated());

        return $this->redirectSuccess('show', ['brand' => $model->id]);
    }

    public function destroy(int $id, Request $request): RedirectResponse|JsonResponse
    {
        /** @var \Domain\Shop\Models\Brand $model */
        $model = Brand::query()->findOrFail($id);
        $model->delete();

        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }

        return $this->redirectDanger();
    }
}
