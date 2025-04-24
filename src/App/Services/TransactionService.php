<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;

class TransactionService
{
    public function __construct(private Database $db) {}

    public function create(array $formData)
    {
        $formattedDate = "{$formData['date']} 00:00:00";

        $this->db->query(
            "INSERT INTO transactions(user_id, description, emission, category, date)
        VALUES(:user_id, :description, :emission, :category, :date)",
            [
                'user_id' => $_SESSION['user'],
                'description' => $formData['description'],
                'emission' => $formData['emission'],
                'category' => $formData['category'],
                'date' => $formattedDate
            ]
        );
    }

    public function getUserTransactions(int $length, int $offset)
    {
        #To escape special characters upon search 
        $searchTerm = addcslashes($_GET['s'] ?? '', '%_');
        $params = [
            'user_id' => $_SESSION['user'],
            'category' => "%{$searchTerm}%",
            'description' => "%{$searchTerm}%"
        ];

        $transactions = $this->db->query(
            "SELECT *, 
                DATE_FORMAT(date, '%Y-%m-%d') as formatted_date,
                CASE 
                    WHEN category = 'Electricity' THEN emission * 0.25
                    WHEN category = 'Public Transportation' THEN emission * 0.5
                    WHEN category = 'Fuel' THEN emission * 1.20
                    WHEN category = 'Flights' THEN emission * 5.5
                    ELSE 0
                END as converted_emission
            FROM transactions 
            WHERE user_id = :user_id 
            AND (category LIKE :category OR description LIKE :description)
            LIMIT {$length} OFFSET {$offset}",
            $params

        )->findAll();

        $transactionCount = $this->db->query(
            "SELECT COUNT(*)
            FROM transactions 
            WHERE user_id = :user_id 
            AND (category LIKE :category OR description LIKE :description)",
            $params
        )->count();







        return [$transactions, $transactionCount];
    }
}
