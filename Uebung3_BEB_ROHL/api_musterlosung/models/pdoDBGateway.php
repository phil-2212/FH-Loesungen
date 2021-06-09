<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of pdoDBGateway
 *
 * @author helmuth
 */
class pdoDBGateway extends Database
{

    public function __construct()
    {
        parent::__construct(DBHost, DBName, DBUsername, DBPassword);
    }
}
