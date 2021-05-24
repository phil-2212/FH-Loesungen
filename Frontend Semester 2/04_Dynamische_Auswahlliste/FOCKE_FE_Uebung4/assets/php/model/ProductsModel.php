<?php

class ProductsModel
{
  function listProducts($categoryId)
  {
    $connection = new PDO("mysql:host=localhost;dbname=test", "root", ""); //redundant
    $sql = "SELECT t.name AS type, p.name AS product FROM product_types t JOIN products p ON t.id = p.id_product_types WHERE t.id = $categoryId";
    $resultTable = array();

    foreach ($connection->query($sql) as $row) {
      $resultTable[] = $row;
    }

    // should be a View
    echo '<table class="table table-hover align-middle"><thead><tr><th>#</th><th>Product</th><th>Options</th></tr></thead>';
    foreach($resultTable as $item) {
      echo "<tr>";
      echo "<tr><td>$resultTable</td>";
      echo "<td>$item[1]</td>";
      echo "<td>none</td>";
      echo "</tr>";
    }
    echo '</table>';
  }
}
