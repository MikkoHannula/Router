<?php

namespace App\Controller;

use App\Session;
use App\Database;
use App\TemplateEngine;
use App\CSRF;

class LoginController
{
    public function showLoginForm()
    {
        TemplateEngine::render('login', []);
    }

    public function login()
    {

        // Tarkista CSRF-token
        if (!isset($_POST['csrf_token']) || !CSRF::verifyToken($_POST['csrf_token'])) {
            http_response_code(403);
            die("CSRF validation failed");
        }

        $email = $_POST['email'] ?? null;
        $password = $_POST['password'] ?? null;

        if (!$email || !$password) {
            echo TemplateEngine::render('login', ['error' => 'Email and password are required.']);
            return;
        }

        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            Session::set('user', $user['email']);
            header("Location: /dashboard");
            exit;
        }

        echo TemplateEngine::render('login', ['error' => 'Invalid email or password.']);
    }

    public function logout()
    {
        Session::destroy();
        header("Location: /login");
        exit;
    }
}