<?php

namespace Domain\CMS\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Domain\Shop\Models\Settings;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Domain\CMS\Requests\SettingsRequest;

class SettingsController extends Controller
{
    protected ?string $section = SECTION_SYSTEM;

    protected ?string $model = 'setting';

    protected bool $addable = false;

    public function show(int $id): View
    {
        $model = Settings::query()->findOrFail($id);

        return $this->view([
            'model' => $model,
        ]);
    }

    public function index(): View
    {
        return $this->view([
            'models' => Settings::filter()->paginate($this->paginationSize()),
        ]);
    }

    public function create(): View
    {
        return $this->view([
            'action' => $this->route('store'),
        ]);
    }

    public function store(SettingsRequest $request): RedirectResponse
    {
        /** @var \Domain\Shop\Models\Settings $model */
        $model = Settings::query()->create($request->validated());

        Cache::forget('settings.options');

        return $this->redirectSuccess('show', ['setting' => $model->id]);
    }

    public function edit(int $id): View
    {
        /** @var \Domain\Shop\Models\Settings $model */
        $model = Settings::query()->findOrFail($id);

        return $this->view([
            'action' => $this->route('update', ['setting' => $model->id]),
            'model' => $model,
        ]);
    }

    public function update(int $id, SettingsRequest $request): RedirectResponse
    {
        /** @var \Domain\Shop\Models\Settings $model */
        $model = Settings::query()->findOrFail($id);
        $model->update($request->validated());

        Cache::forget('settings.options');

        return $this->redirectSuccess('show', ['setting' => $model->id]);
    }

    public function destroy(int $id, Request $request): RedirectResponse|JsonResponse
    {
        /** @var \Domain\Shop\Models\Settings $model */
        $model = Settings::query()->findOrFail($id);
        $model->delete();

        Cache::forget('settings.options');

        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }

        return $this->redirectDanger();
    }
}
