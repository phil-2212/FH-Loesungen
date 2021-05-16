<?php

class GetParametersModel
{
  public $checkedQuery;

  function checkParametersForCorrectness()
  {
    if (!isset($_GET['action'])) { /* sloppy – no more time */
      $loopType = "none";
    }

    $typeId = $_GET['typeId'];

    switch ($loopType) {

      case $loopType === 'listTypes':
      $this->checkedQuery = "SELECT id, name FROM product_types ORDER BY id";
      return true;

      case $loopType === 'listProductsByTypeId' && is_numeric($typeId):
      $productTypeId = $typeId;
      $this->checkedQuery = "SELECT t.name AS productTypeName, p.name AS prodcutName FROM product_types t JOIN products p ON t.id = p.id_product_types WHERE t.id = {$productTypeId}";
      return true;

      default:
      return false;
    }

  }
}
