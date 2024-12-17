<?php
 
namespace App\Model;
 
use App\Database;
 
class User
{
    protected $pdo;
 
    public function __construct()
    {
        $this->pdo = Database::getInstance();
    }
 
    public function create(array $data)
    {
        $stmt = $this->pdo->prepare("INSERT INTO users (email, password) VALUES (:email, :password)");
        
        return $stmt->execute([
            ':email' => $data['email'],
            ':password' => $data['password']
        ]);
    }
 
    public function findByEmail($email)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
}