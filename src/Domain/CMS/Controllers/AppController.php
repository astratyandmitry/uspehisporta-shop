<?php

namespace Domain\CMS\Controllers;

use Illuminate\Http\RedirectResponse;

/**
 * @version 1.0.1
 * @author Astratyan Dmitry <astratyandmitry@gmail.com>
 * @copyright 2020, ArmenianBros. <i@armenianbros.com>
 */
class AppController extends Controller
{
    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function home(): RedirectResponse
    {
        return $this->redirect('orders.index');
    }
}
