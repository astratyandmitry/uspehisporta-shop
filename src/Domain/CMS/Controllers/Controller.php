<?php

namespace Domain\CMS\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Lang;
use Illuminate\View\View;

class Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected string $model;

    protected string $section;

    protected int $paginationSize = 50;

    protected array $data = [];

    protected array $counts = [];

    protected array $filters = [];

    protected bool $addable = true;

    protected bool $sortable = false;

    protected bool $exportable = false;

    protected bool $form_page = false;

    protected function paginationSize(): int
    {
        return $this->sortable ? 99999 : $this->paginationSize;
    }

    protected function with(string $key, mixed $data): void
    {
        $this->data[$key] = $data;
    }

    protected function getData(array $data = []): array
    {
        if ($this->filters) {
            foreach ($this->filters as $key => $value) {
                $this->filters[$key] = __("cms.filter.{$value}");
            }
        }

        $_data = [
            'sortable' => $this->sortable,
            'data' => array_merge($this->data, [
                'filters' => $this->filters,
                'counts' => $this->counts,
            ]),
            'globals' => [
                'title' => $this->getTitle(),
                'model' => $this->model,
                'section' => $this->section,
                'form_page' => $this->form_page,
            ],
        ];

        if ($this->model && $this->addable) {
            $_data['globals']['create_url'] = route("cms::{$this->model}.create");
        }

        if ($this->model && $this->exportable) {
            $_data['globals']['export_url'] = route("cms::{$this->model}.export");
        }

        return array_merge($data, $_data);
    }

    protected function getTitle(): ?string
    {
        $action = request()->route()->getActionMethod();

        if (Lang::has("cms.title.{$action}")) {
            $title = __("cms.model.{$this->model}").' · '.__("cms.title.{$action}");

            $parameters = request()->route()->parameters();

            if (count($parameters)) {
                $id = $parameters[array_key_first($parameters)];
                $id = str_pad($id, 7, '0', STR_PAD_LEFT);

                $title .= " · ID {$id}";
            }

            return $title;
        }

        return __("cms.title.custom.{$action}");
    }

    protected function getMessage(): ?string
    {
        $action = request()->route()->getActionMethod();

        return (Lang::has("cms.message.{$action}")) ? __("cms.message.{$action}") : __("cms.message.custom.{$action}");
    }

    protected function view(array $data = [], ?string $view = null): View
    {
        if (is_null($view)) {
            $action = request()->route()->getActionMethod();

            if (in_array($action, ['edit', 'create'])) {
                $this->form_page = true;

                $action = 'form';
            }

            $view = "{$this->model}.{$action}";
        }

        return view("cms::crud.{$view}", $this->getData($data));
    }

    protected function route(string $route, array $params = []): string
    {
        if (! $this->model) {
            return route("cms::{$route}", $params);
        }

        return route("cms::{$this->model}.{$route}", $params);
    }

    protected function redirect(string $route, array $params = []): RedirectResponse
    {
        return redirect()->to($this->route($route, $params));
    }

    protected function redirectSuccess(string $route = 'index', array $params = []): RedirectResponse
    {
        return redirect()->to($this->route($route, $params))
            ->with('success', $this->getMessage());
    }

    protected function redirectWarning(string $route = 'index', array $params = []): RedirectResponse
    {
        return redirect()->to($this->route($route, $params))
            ->with('warning', $this->getMessage());
    }

    protected function redirectDanger(string $route = 'index', array $params = []): RedirectResponse
    {
        return redirect()->to($this->route($route, $params))
            ->with('danger', $this->getMessage());
    }
}
