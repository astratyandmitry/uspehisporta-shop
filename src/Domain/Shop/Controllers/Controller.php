<?php

namespace Domain\Shop\Controllers;

use Domain\Shop\Models\Page;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\RedirectResponse;
use Domain\Shop\Common\Layout;
use Illuminate\View\View;

/**
 * @version 1.0.1
 * @author Astratyan Dmitry <astratyandmitry@gmail.com>
 * @copyright 2020, ArmenianBros. <i@armenianbros.com>
 */
class Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @var \Domain\Shop\Common\Layout
     */
    protected $layout;

    /**
     * @param \Domain\Shop\Common\Layout $layout
     * @return void
     */
    public function __construct(Layout $layout)
    {
        $this->layout = $layout;
    }

    /**
     * @param string $route
     * @param mixed $params
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function redirect(string $route, $params = []): RedirectResponse
    {
        return redirect()->route("shop::{$route}", $params);
    }

    /**
     * @param string $view
     * @param array $data
     * @return \Illuminate\View\View
     */
    protected function view(string $view, array $data = []): View
    {
        $data['layout'] = $this->layout;

        return view("shop::{$view}", $data);
    }

    /**
     * @param string $hru
     * @return \Domain\Shop\Common\Layout
     */
    protected function setup(string $hru): Layout
    {
        /** @var \Domain\Shop\Models\Page $page */
        if ($page = Page::query()->where('hru', $hru)->where('system', true)->first()) {
            $this->layout
                ->setTitle($page->title)
                ->setMeta($page)
                ->addBreadcrumb($page->name, $page->url());
        }

        return $this->layout;
    }
}
