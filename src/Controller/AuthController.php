<?php

namespace App\Controller;

use App\TemplateEngine;
use App\Validator;
use App\Model\User;
use App\Session;
use App\CSRF;

class AuthController{
    
    public function register(){
        TemplateEngine::render("register", []);
    }
    public function handleRegister(){

         // Tarkista CSRF-token
    if (!isset($_POST['csrf_token']) || !CSRF::verifyToken($_POST['csrf_token'])) {
        http_response_code(403);
        die("CSRF validation failed");
      }

        $errors = Validator::validate($_POST, [
            'email' => 'required', 
            'password' => 'require|min:8'
        ]);

        if(!empty($errors)){

            TemplateEngine::render('register', [
                'data' =>$_POST, 
                'errors' =>$errors
            ]);
            exit;
        }

        $user = new User();

        if($user->findByEmail($_POST['email'])){
            TemplateEngine::render('register', 
            ['data' =>$_POST, 
            ['errors' =>['Email is already taken']] 
        ]);
        exit;
        }

        $user->create(
            ['email' => $_POST['email'],
         'password' => password_hash($_POST['Password'],
          PASSWORD_BCRYPT)
        ]);

        Session::set('user', $_POST['email']);
        header('Location: /login');
    }


}