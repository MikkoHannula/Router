<?php

namespace App\Controller;

use App\Model\Customer;
class CustomerController {

    private Customer $Customer;


    public function __construct()
    {
        $this->Customer = new Customer();
    }
    public function getCustomers(){

    }
    public function getCustomer(array $params){
        var_dump($this-> Customer ->getCustomer($params['id']));
    }

    public function addCustomer(){

    }
}