<?php

declare(strict_types=1);

namespace App\Services;

use Dotenv\Exception\ValidationException as ExceptionValidationException;
use Framework\Database;
use Framework\Exceptions\ValidationException;

class UserService
{

    public function __construct(private Database $db) {}

    public function isEmailTaken(string $email)
    {
        $emailCount = $this->db->query(
            "SELECT COUNT(*) FROM users WHERE email = :email",
            [
                'email' => $email
            ]
        )->count();

        if ($emailCount > 0) {
            throw new ValidationException(['email' => 'Email taken']);
        }
    }

    public function create(array $formData)
    {

        $password = password_hash($formData['password'], PASSWORD_BCRYPT, ['cost' => 12]);

        $this->db->query(
            "INSERT INTO users(email,password,country,age)
            VALUES(:email, :password, :country, :age)",
            [
                'email' => $formData['email'],
                'password' => $password,
                'country' => $formData['country'],
                'age' => $formData['age']
            ]
        );
    }

    public function login(array $formData)
    {

        $user = $this->db->query("SELECT * FROM users WHERE email = :email", [
            'email' => $formData['email']

        ])->find();

        $passwordsMatch = password_verify(
            $formData['password'],
            $user['password'] ?? ''
        );

        if (!$user || !$passwordsMatch) {
            throw new ValidationException(['password' => ['Invalid email or password']]);
        }

        $_SESSION['user'] = $user['id'];
    }
}
