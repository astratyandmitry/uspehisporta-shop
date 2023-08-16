<?php

namespace Domain\CMS\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Domain\Shop\Models\Brand;
use Domain\Shop\Models\Promo;
use Domain\Shop\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Domain\CMS\Requests\PromoRequest;

class PromosController extends Controller
{
    protected ?string $section = SECTION_MAIN;

    protected ?string $model = 'promos';

    public function __construct()
    {
        $this->with('categories', Category::groupedOptions());
        $this->with('brands', Brand::query()->pluck('name', 'id')->toArray());
    }

    public function show(int $id): View
    {
        $model = Promo::query()->findOrFail($id);

        return $this->view([
            'model' => $model,
        ]);
    }

    public function index(): View
    {
        return $this->view([
            'models' => Promo::filter()->paginate($this->paginationSize()),
        ]);
    }

    public function create(): View
    {
         return $this->view([
            'action' => $this->route('store'),
            'model' => $model ?? null,
        ]);
    }

    public function store(PromoRequest $request): RedirectResponse
    {
        /** @var \Domain\Shop\Models\Promo $model */
        $model = Promo::query()->create($request->validated());

        return $this->redirectSuccess('show', ['promo' => $model->id]);
    }

    public function edit(int $id): View
    {
        /** @var \Domain\Shop\Models\Promo $model */
        $model = Promo::query()->findOrFail($id);

        return $this->view([
            'action' => $this->route('update', ['promo' => $model->id]),
            'model' => $model,
        ]);
    }

    public function update(int $id, PromoRequest $request): RedirectResponse
    {
        /** @var \Domain\Shop\Models\Promo $model */
        $model = Promo::query()->findOrFail($id);;
        $model->update($request->validated());

        return $this->redirectSuccess('show', ['promo' => $model->id]);
    }

    public function destroy(int $id, Request $request): RedirectResponse|JsonResponse
    {
        /** @var \Domain\Shop\Models\Promo $model */
        $model = Promo::query()->findOrFail($id);
        $model->delete();

        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }

        return $this->redirectDanger();
    }
}
