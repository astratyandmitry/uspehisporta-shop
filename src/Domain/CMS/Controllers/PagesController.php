<?php

namespace Domain\CMS\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Domain\Shop\Models\Page;
use Illuminate\Http\JsonResponse;
use Domain\CMS\Requests\PageRequest;
use Illuminate\Http\RedirectResponse;


class PagesController extends Controller
{
    protected string $section = SECTION_MAIN;

    protected string $model = 'pages';

    public function show(int $id): View
    {
        $model = Page::query()->findOrFail($id);

        return $this->view([
            'model' => $model,
        ]);
    }

    public function index(): View
    {
        return $this->view([
            'models' => Page::filter()->paginate($this->paginationSize()),
        ]);
    }

    public function create(): View
    {
        return $this->view([
            'action' => $this->route('store'),
        ]);
    }

    public function store(PageRequest $request): RedirectResponse
    {
        /** @var \Domain\Shop\Models\Page $model */
        $model = Page::query()->create($request->validated());

        return $this->redirectSuccess('show', ['page' => $model->id]);
    }

    public function edit(int $id): View
    {
        /** @var \Domain\Shop\Models\Page $model */
        $model = Page::query()->findOrFail($id);

        return $this->view([
            'action' => $this->route('update', ['page' => $model->id]),
            'model' => $model,
        ]);
    }

    public function update(int $id, PageRequest $request): RedirectResponse
    {
        /** @var \Domain\Shop\Models\Page $model */
        $model = Page::query()->findOrFail($id);
        $model->update($request->validated());

        return $this->redirectSuccess('show', ['page' => $model->id]);
    }

    public function destroy(int $id, Request $request): RedirectResponse|JsonResponse
    {
        /** @var \Domain\Shop\Models\Page $model */
        $model = Page::query()->findOrFail($id);
        $model->delete();

        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }

        return $this->redirectDanger();
    }
}
