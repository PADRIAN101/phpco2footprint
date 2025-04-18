<?php

declare(strict_types=1);

namespace App\Config;


use Framework\App;
use App\Controllers\{HomeController, AboutController, DashboardController};

function registerRoutes(App $app)
{
    $app->get('/', [HomeController::class, 'home']);
    $app->get('/about', [AboutController::class, 'about']);
    $app->get('/dashboard', [DashboardController::class, 'dashboard']);
}
