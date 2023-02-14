<?php

namespace Domain\Shop\Controllers;

use Domain\Shop\Models\Page;
use Illuminate\View\View;

/**
 * @version 1.0.1
 * @author Astratyan Dmitry <astratyandmitry@gmail.com>
 * @copyright 2020, ArmenianBros. <i@armenianbros.com>
 */
class PageController extends Controller
{
    /**
     * @param \Domain\Shop\Models\Page $page
     * @return \Illuminate\View\View
     */
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
