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

    public function getUserTransactions(int $length, int $offset, ?string $startDate = null, ?string $endDate = null)
    {
        $searchTerm = addcslashes($_GET['s'] ?? '', '%_');
        $params = [
            'user_id' => $_SESSION['user'],
            'category' => "%{$searchTerm}%",
            'description' => "%{$searchTerm}%"
        ];

        $sql = "
            SELECT *, 
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
        ";

        if ($startDate) {
            $sql .= " AND date >= :start_date";
            $params['start_date'] = "{$startDate} 00:00:00";
        }

        if ($endDate) {
            $sql .= " AND date <= :end_date";
            $params['end_date'] = "{$endDate} 23:59:59";
        }

        $sql .= " LIMIT {$length} OFFSET {$offset}";

        $transactions = $this->db->query($sql, $params)->findAll();

        // Count query with same filters
        $countSql = "
            SELECT COUNT(*) FROM transactions 
            WHERE user_id = :user_id 
            AND (category LIKE :category OR description LIKE :description)
        ";

        if ($startDate) {
            $countSql .= " AND date >= :start_date";
        }

        if ($endDate) {
            $countSql .= " AND date <= :end_date";
        }

        $transactionCount = $this->db->query($countSql, $params)->count();

        return [$transactions, $transactionCount];
    }

    public function getUserTransaction(string $id)
    {
        return $this->db->query(
            "SELECT *, DATE_FORMAT(date, '%Y-%m-%d') as formatted_date
             FROM transactions 
             WHERE id = :id AND user_id = :user_id",
            [
                'id' => $id,
                'user_id' => $_SESSION['user']
            ]
        )->find();
    }

    public function update(array $formData, int $id)
    {
        $formattedDate = "{$formData['date']} 00:00:00";

        $this->db->query(
            "UPDATE transactions
             SET description = :description, emission = :emission, date = :date, category = :category 
             WHERE id = :id AND user_id = :user_id",
            [
                'description' => $formData['description'],
                'emission' => $formData['emission'],
                'date' => $formattedDate,
                'category' => $formData['category'],
                'id' => $id,
                'user_id' => $_SESSION['user']
            ]
        );
    }

    public function delete(int $id)
    {
        $this->db->query(
            "DELETE FROM transactions WHERE id = :id AND user_id = :user_id",
            [
                'id' => $id,
                'user_id' => $_SESSION['user']
            ]
        );
    }
}
