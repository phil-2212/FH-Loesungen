<?php
session_start();
include "api_musterlosung/config/config.php";

$productListController = new ProductsController();
$productListController->route();