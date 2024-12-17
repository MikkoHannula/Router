<?php

namespace App\Model;

use PDO;
use App\Database;

class customer {

    private PDO $db;

    public function __construct()
    {
      $this->db = ( new Database() )->getConnection();
    }

    public function getCustomer( int $id ){
      
      $sql = "SELECT *
              FROM customers
              WHERE customerID = :customerID";

      $stmt = $this->db->prepare( $sql );
      $stmt->bindParam( ':customerID', $id );
      $stmt->execute();

      if($stmt->rowCount() === 1){
        return $stmt->fetch();
      } else {
        return false;
      }
      
    }
}