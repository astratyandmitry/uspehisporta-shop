<?php

namespace Domain\CMS\Controllers;

use Illuminate\View\View;
use Domain\Shop\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Domain\CMS\Requests\FaqRequest;
use Illuminate\Http\RedirectResponse;

class FaqsController extends Controller
{
    protected string $section = SECTION_MAIN;

    protected string $model = 'faqs';

    protected bool $sortable = true;

    public function show(int $id): View
    {
        $model = Faq::query()->findOrFail($id);

        return $this->view([
            'model' => $model,
        ]);
    }

    public function index(): View
    {
        return $this->view([
            'models' => Faq::filter()->paginate($this->paginationSize()),
        ]);
    }

    public function create(): View
    {
        return $this->view([
            'action' => $this->route('store'),
        ]);
    }

    public function store(FaqRequest $request): RedirectResponse
    {
        /** @var \Domain\Shop\Models\Faq $model */
        $model = Faq::query()->create($request->validated());

        return $this->redirectSuccess('show', ['faq' => $model->id]);
    }

    /**
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit(int $id): View
    {
        /** @var \Domain\Shop\Models\Faq $model */
        $model = Faq::query()->findOrFail($id);

        return $this->view([
            'action' => $this->route('update', ['faq' => $model->id]),
            'model' => $model,
        ]);
    }

    public function update(int $id, FaqRequest $request): RedirectResponse
    {
        /** @var \Domain\Shop\Models\Faq $model */
        $model = Faq::query()->findOrFail($id);
        $model->update($request->validated());

        return $this->redirectSuccess('show', ['faq' => $model->id]);
    }

    public function destroy(int $id, Request $request): RedirectResponse|JsonResponse
    {
        /** @var \Domain\Shop\Models\Faq $model */
        $model = Faq::query()->findOrFail($id);
        $model->delete();

        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }

        return $this->redirectDanger();
    }
}
