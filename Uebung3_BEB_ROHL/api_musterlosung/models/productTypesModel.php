<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of productTypesModel
 *
 * @author helmuth
 */
class productTypesModel{
    private $dbGateway;
    
    public function __construct(){
        $this->dbGateway = new pdoDBGateway();
    }
    
    public function getProductTypes(){
        $query = "SELECT id, name FROM product_types ORDER BY name;";
        
        $productTypes = $this->dbGateway->query($query);
        return $productTypes;   
    }
    
}
