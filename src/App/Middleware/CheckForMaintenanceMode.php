<?php

namespace App\Middleware;

use Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode as Middleware;

class CheckForMaintenanceMode extends Middleware
{
    /**
     * @var array
     */
    protected $except = [
        //
    ];
}
