<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Services\TransactionService;

class GreenOptionsController
{
    private TransactionService $transactionService;

    public function __construct(
        private TemplateEngine $view,
        TransactionService $transactionService
    ) {
        $this->transactionService = $transactionService;
    }

    public function greenoption(): void
    {
        echo $this->view->render("/greenoption.php", [
            'title' => 'Green Options'
        ]);
    }
}
