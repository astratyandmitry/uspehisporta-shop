<?php

namespace Domain\CMS\Controllers;

use Illuminate\View\View;
use Domain\Shop\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Domain\CMS\Requests\TestimonialRequest;
use Illuminate\Http\RedirectResponse;

class TestimonialsController extends Controller
    protected ?string $section = SECTION_MAIN;

    protected ?string $model = 'testimonials';

    protected bool $sortable = true;

    public function show(int $id): View
    {
        $model = Testimonial::query()->findOrFail($id);

        return $this->view([
            'model' => $model,
        ]);
    }

    public function index(): View
    {
        return $this->view([
            'models' => Testimonial::filter()->paginate($this->paginationSize()),
        ]);
    }

    public function create(): View
    {
        return $this->view([
            'action' => $this->route('store'),
        ]);
    }

    public function store(TestimonialRequest $request): RedirectResponse
    {
        /** @var \Domain\Shop\Models\Testimonial $model */
        $model = Testimonial::query()->create($request->validated());

        return $this->redirectSuccess('show', ['testimonial' => $model->id]);
    }

    /**
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit(int $id): View
    {
        /** @var \Domain\Shop\Models\Testimonial $model */
        $model = Testimonial::query()->findOrFail($id);

        return $this->view([
            'action' => $this->route('update', ['testimonial' => $model->id]),
            'model' => $model,
        ]);
    }

    public function update(int $id, TestimonialRequest $request): RedirectResponse
    {
        /** @var \Domain\Shop\Models\Testimonial $model */
        $model = Testimonial::query()->findOrFail($id);
        $model->update($request->validated());

        return $this->redirectSuccess('show', ['testimonial' => $model->id]);
    }

    public function destroy(int $id, Request $request): RedirectResponse|JsonResponse
    {
        /** @var \Domain\Shop\Models\Testimonial $model */
        $model = Testimonial::query()->findOrFail($id);
        $model->delete();

        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }

        return $this->redirectDanger();
    }
}
