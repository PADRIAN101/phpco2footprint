<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Config\Paths;

class DashboardController
{

    public function __construct(private TemplateEngine $view) {}

    public function dashboard()
    {
        echo $this->view->render("/dashboard.php", [
            'title' => 'Dashboard',
            'dangerousData' => '<script>alert(123)</script>'
        ]);
    }
}
