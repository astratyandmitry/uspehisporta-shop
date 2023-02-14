<?php

namespace Domain\CMS\Controllers;

use Illuminate\View\View;
use Illuminate\Support\Str;
use Domain\CMS\Models\Manager;
use Domain\CMS\Models\ManagerRole;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use Domain\CMS\Mails\ManagerPasswordGeneratedMail;
use Domain\CMS\Requests\ManagerRequest as Request;

/**
 * @version   1.0.1
 * @author    Astratyan Dmitry <astratyandmitry@gmail.com>
 * @copyright 2018, ArmenianBros. <i@armenianbros.com>
 */
class ManagersController extends Controller
{
    /**
     * @var string
     */
    protected $section = SECTION_SYSTEM;

    /**
     * @var string
     */
    protected $model = 'managers';

    /**
     * @return void
     */
    public function __construct()
    {
        $this->with('roles', ManagerRole::query()->pluck('name', 'key')->toArray());
    }

    /**
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show(int $id): View
    {
        /** @var \Domain\CMS\Models\Manager $model */
        $model = Manager::query()->findOrFail($id);

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
            'models' => Manager::filter()->paginate($this->paginationSize()),
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
     * @param \Domain\CMS\Requests\ManagerRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $attributes = $request->validated();
        $attributes['password'] = bcrypt($password = Str::random(10));

        /** @var \Domain\CMS\Models\Manager $model */
        $model = Manager::query()->create($attributes);

        Mail::to($model->email)->send(new ManagerPasswordGeneratedMail($model, $password));

        return $this->redirectSuccess();
    }

    /**
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit(int $id): View
    {
        /** @var \Domain\CMS\Models\Manager $model */
        $model = Manager::query()->findOrFail($id);

        return $this->view([
            'action' => $this->route('update', $model->id),
            'model' => $model,
        ]);
    }

    /**
     * @param int $id
     * @param \Domain\CMS\Requests\ManagerRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(int $id, Request $request): RedirectResponse
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

    /**
     * @param int $id
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(int $id, \Illuminate\Http\Request $request)
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
