<?php

namespace App;

use PDO, PDOException;

class Database{

  private static $instance = null;
  private $connection;

  public function __construct()
  {

    $host = $_ENV['DB_HOST'];
    $dbname = $_ENV['DB_NAME'];
    $username = $_ENV['DB_USER'];
    $password = $_ENV['DB_PASSWORD'];

    try {
      $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";

      $this->connection = new PDO($dsn, $username, $password, [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
      ]);
    } catch(PDOException $e){
      die("Tietokantaan ei saada yhteyttä");
    }
  }

  public static function getInstance(){
    if(self::$instance === null){
      self::$instance = new Database();
    }
    return self::$instance->connection;
  }
}