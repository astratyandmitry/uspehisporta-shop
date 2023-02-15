<?php

namespace Domain\Shop\Controllers;

use Domain\Shop\Models\Page;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\RedirectResponse;
use Domain\Shop\Common\Layout;
use Illuminate\View\View;

class Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected Layout $layout;

    public function __construct(Layout $layout)
    {
        $this->layout = $layout;
    }

    protected function redirect(string $route, array $params = []): RedirectResponse
    {
        return redirect()->route("shop::{$route}", $params);
    }

    protected function view(string $view, array $data = []): View
    {
        $data['layout'] = $this->layout;

        return view("shop::{$view}", $data);
    }

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
