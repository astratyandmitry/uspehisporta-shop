<?php

namespace Domain\CMS\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Domain\CMS\Models\Manager;
use Illuminate\Http\JsonResponse;
use Domain\CMS\Models\ManagerRole;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use Domain\CMS\Requests\ManagerRequest;
use Domain\CMS\Mails\ManagerPasswordGeneratedMail;

class ManagersController extends Controller
{
    protected ?string $section = SECTION_SYSTEM;

    protected ?string $model = 'managers';

    public function __construct()
    {
        $this->with('roles', ManagerRole::query()->pluck('name', 'key')->toArray());
    }

    public function show(int $id): View
    {
        /** @var \Domain\CMS\Models\Manager $model */
        $model = Manager::query()->findOrFail($id);

        return $this->view([
            'model' => $model,
        ]);
    }

    public function index(): View
    {
        return $this->view([
            'models' => Manager::filter()->paginate($this->paginationSize()),
        ]);
    }

    public function create(): View
    {
        return $this->view([
            'action' => $this->route('store'),
        ]);
    }

    public function store(ManagerRequest $request): RedirectResponse
    {
        $attributes = $request->validated();
        $attributes['password'] = bcrypt($password = Str::random(10));

        /** @var \Domain\CMS\Models\Manager $model */
        $model = Manager::query()->create($attributes);

        Mail::to($model->email)->send(new ManagerPasswordGeneratedMail($model, $password));

        return $this->redirectSuccess();
    }

    public function edit(int $id): View
    {
        /** @var \Domain\CMS\Models\Manager $model */
        $model = Manager::query()->findOrFail($id);

        return $this->view([
            'action' => $this->route('update', ['manager' => $model->id]),
            'model' => $model,
        ]);
    }

    public function update(int $id, ManagerRequest $request): RedirectResponse
    {
        $attributes = $request->validated();
        unset($attributes['new_password']);

        if ($password = $request->get('new_password')) {
            $attributes['password'] = bcrypt($password);
        }

        /** @var \Domain\CMS\Models\Manager $model */
        $model = Manager::query()->findOrFail($id);
        $model->update($attributes);

        return $this->redirectSuccess();
    }

    public function destroy(int $id, Request $request): RedirectResponse|JsonResponse
    {
        /** @var \Domain\CMS\Models\Manager $model */
        $model = Manager::query()->findOrFail($id);
        $model->delete();

        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }

        return $this->redirectDanger();
    }
}
