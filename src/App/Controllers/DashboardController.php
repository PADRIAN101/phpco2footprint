<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Services\TransactionService;

class DashboardController
{
    private TransactionService $transactionService;

    public function __construct(
        private TemplateEngine $view,
        TransactionService $transactionService
    ) {
        $this->transactionService = $transactionService;
    }

    public function dashboard()
    {
        $startDate = $_GET['start_date'] ?? null;
        $endDate = $_GET['end_date'] ?? null;

        // Fetch user transactions with optional date filters
        list($transactions, $transactionCount) = $this->transactionService->getUserTransactions(100, 0, $startDate, $endDate);

        // Calculate total emissions within the range
        $totalEmission = 0;
        foreach ($transactions as $transaction) {
            $totalEmission += $transaction['converted_emission'];
        }

        echo $this->view->render("/dashboard.php", [
            'title' => 'Dashboard',
            'totalEmission' => number_format($totalEmission, 2),
            'transactions' => $transactions,
            'transactionCount' => $transactionCount,
            'startDate' => $startDate,
            'endDate' => $endDate
        ]);
    }
}
