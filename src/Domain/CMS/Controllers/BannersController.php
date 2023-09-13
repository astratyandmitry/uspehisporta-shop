<?php

namespace Domain\CMS\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Domain\Shop\Models\Banner;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Domain\CMS\Requests\BannerRequest;

class BannersController extends Controller
{
    protected ?string $section = SECTION_MAIN;

    protected ?string $model = 'banners';

    protected bool $sortable = true;

    public function show(int $id): View
    {
        $model = Banner::query()->findOrFail($id);

        return $this->view([
            'model' => $model,
        ]);
    }

    public function index(): View
    {
        return $this->view([
            'models' => Banner::filter()->paginate($this->paginationSize()),
        ]);
    }

    public function create(): View
    {
        return $this->view([
            'action' => $this->route('store'),
        ]);
    }

    public function store(BannerRequest $request): RedirectResponse
    {
        /** @var \Domain\Shop\Models\Banner $model */
        $model = Banner::query()->create($request->validated());

        return $this->redirectSuccess('show', ['banner' => $model->id]);
    }

    public function edit(int $id): View
    {
        /** @var \Domain\Shop\Models\Banner $model */
        $model = Banner::query()->findOrFail($id);

        return $this->view([
            'action' => $this->route('update', ['banner' => $model->id]),
            'model' => $model,
        ]);
    }

    public function update(int $id, BannerRequest $request): RedirectResponse
    {
        /** @var \Domain\Shop\Models\Banner $model */
        $model = Banner::query()->findOrFail($id);
        $model->update($request->validated());

        return $this->redirectSuccess('show', ['banner' => $model->id]);
    }

    public function destroy(int $id, Request $request): RedirectResponse|JsonResponse
    {
        /** @var \Domain\Shop\Models\Banner $model */
        $model = Banner::query()->findOrFail($id);
        $model->delete();

        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }

        return $this->redirectDanger();
    }
}
