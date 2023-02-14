<?php

namespace Domain\CMS\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Lang;

/**
 * @version   1.0.1
 * @author    Astratyan Dmitry <astratyandmitry@gmail.com>
 * @copyright 2018, ArmenianBros. <i@armenianbros.com>
 */
class Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @var string
     */
    protected $model;

    /**
     * @var
     */
    protected $section;

    /**
     * @var int
     */
    protected $paginationSize = 50;

    /**
     * @var array
     */
    protected $data = [];

    /**
     * @var array
     */
    protected $counts = [];

    /**
     * @var array
     */
    protected $filters = [];

    /**
     * @var bool
     */
    protected $addable = true;

    /**
     * @var bool
     */
    protected $sortable = false;

    /**
     * @var bool
     */
    protected $exportable = false;

    /**
     * @var bool
     */
    protected $form_page = false;

    /**
     * @return int
     */
    protected function paginationSize(): int
    {
        return $this->sortable ? 99999 : $this->paginationSize;
    }

    /**
     * @param string $key
     * @param mixed $data
     */
    protected function with(string $key, $data): void
    {
        $this->data[$key] = $data;
    }

    /**
     * @param array $data
     *
     * @return array
     */
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

    /**
     * @return null|string
     */
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

    /**
     * @return null|string
     */
    protected function getMessage(): ?string
    {
        $action = request()->route()->getActionMethod();

        return (Lang::has("cms.message.{$action}")) ? __("cms.message.{$action}") : __("cms.message.custom.{$action}");
    }

    /**
     * @param array $data
     * @param string|null $view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected function view(array $data = [], ?string $view = null)
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

    /**
     * @param string $route
     * @param mixed $params
     *
     * @return string
     */
    protected function route(string $route, $params = []): string
    {
        if (! $this->model) {
            return route("cms::{$route}", $params);
        }

        return route("cms::{$this->model}.{$route}", $params);
    }

    /**
     * @param string $route
     * @param mixed $params
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function redirect(string $route, $params = []): RedirectResponse
    {
        return redirect()->to($this->route($route, $params));
    }

    /**
     * @param string $route
     * @param array $params
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function redirectSuccess(string $route = 'index', array $params = []): RedirectResponse
    {
        return redirect()->to($this->route($route, $params))
            ->with('success', $this->getMessage());
    }

    /**
     * @param string $route
     * @param array $params
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function redirectWarning(string $route = 'index', array $params = []): RedirectResponse
    {
        return redirect()->to($this->route($route, $params))
            ->with('warning', $this->getMessage());
    }

    /**
     * @param string $route
     * @param array $params
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function redirectDanger(string $route = 'index', array $params = []): RedirectResponse
    {
        return redirect()->to($this->route($route, $params))
            ->with('danger', $this->getMessage());
    }
}
