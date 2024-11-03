<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $middlewareGroups = [
        'web' => [
            // middlewares para web
        ],

        'api' => [
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            // Outros middlewares específicos da API
        ],
    ];

    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        // Outros middlewares
    ];
}
