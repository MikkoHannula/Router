<?php
 
namespace App;
 
class AuthMiddleware
{
    public static function handle($next)
    {
        if (!Session::isLoggedIn()) {
            header("Location: /login");
            exit;
        }
 
        $next();
    }
}