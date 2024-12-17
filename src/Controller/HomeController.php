<?php

namespace App\Controller;

use App\TemplateEngine;

class HomeController{

  public function home(){
    TemplateEngine::render('index', []);
  }

  public function about(){
    TemplateEngine::render('about', []);
  }

  public function posts(){
    TemplateEngine::render('posts', []);
  }
  
}