<?php

class CheckoutController
{

  function route()
  {
    $chosenView = $_GET['action'];
    if ($this->testDatabaseConnection()) {

      switch ($chosenView) {
        case 'listTypes':
        $newModel = new CategoriesModel();
        $newModel->listCategories();
        break;

        case 'listProductsByTypeId':
        $newModel = new ProductsModel();
        $newModel->listProducts(1);
        break;

        default:
        echo "This is not possible, sorry.";
        break;
      }
    }
  }

  function testDatabaseConnection()
  {
    try {
      $connection = new PDO("mysql:host=localhost;dbname=test", "root", "");
      return true;
    } catch(PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
      return false;
    }
  }
}
