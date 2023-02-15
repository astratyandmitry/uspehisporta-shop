<?php

namespace Domain\Shop\Controllers;

use Domain\Shop\Models\Page;
use Illuminate\View\View;

class PageController extends Controller
{
    public function __invoke(Page $page): View
    {
        abort_if($page->system, 404);

        $this->layout
            ->setTitle($page->title)
            ->setMeta($page)
            ->addBreadcrumb($page->name);

        return $this->view('page.show', [
            'page' => $page,
        ]);
    }
}
