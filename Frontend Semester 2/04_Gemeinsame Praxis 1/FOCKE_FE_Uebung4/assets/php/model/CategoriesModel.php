<?php

class CategoriesModel
{
  function listCategories()
  {
    $connection = new PDO("mysql:host=localhost;dbname=test", "root", ""); //redundant
    $sql = 'SELECT id, name FROM product_types ORDER BY id';
    $resultTable = array();

    foreach ($connection->query($sql) as $row) {

      $url = '&typeId=' . $row['id'];

      $pairOfIdAndName = array($row['id'], $row['name'], 'url', $url);
      $resultTable[] = $pairOfIdAndName;
    }

    // should be a View
    echo '<table class="table table-hover align-middle"><thead><tr><th>#</th><th>Product Category</th><th>Options</th></tr></thead>';

    foreach($resultTable as $item) {
      echo "<tr>";
      echo "<td>$item[0]</td>";
      echo "<td>$item[1]</td>";
      echo "<td><button class='btn btn-link' category='$item[0]'>Choose</button></td>";
      echo "</tr>";
    }

    echo '</table>';
  }
}
