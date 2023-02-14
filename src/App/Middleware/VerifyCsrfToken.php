<?php

namespace App\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * @var array
     */
    protected $except = [
        //
    ];
}
