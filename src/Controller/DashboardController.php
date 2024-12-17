<?php
 
namespace App\Controller;
 
use App\Session;
use App\TemplateEngine;
 
class DashboardController
{
    public function index()
    {
        $userName = Session::get('user');
 
        if (!$userName) {
            header("Location: /login");
            exit;
        }
 
        echo TemplateEngine::render('dashboard', [
            'user_name' => $userName
        ]);
    }
}