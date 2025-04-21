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

        #to hash passwords using bcrypt function
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

        session_regenerate_id();

        $_SESSION['user'] = $this->db->id();
    }

    public function login(array $formData)
    {

        #validate log-in
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

        #securing session id to change upon log-in
        session_regenerate_id();

        $_SESSION['user'] = $user['id'];
    }

    #Logout method to destroy session and creating new session
    public function logout()
    {
        unset($_SESSION['user']);

        session_regenerate_id();
    }
}
