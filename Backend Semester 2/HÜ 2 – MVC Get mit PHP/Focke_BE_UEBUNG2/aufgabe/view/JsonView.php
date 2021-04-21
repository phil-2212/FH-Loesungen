<?php

class JsonView
{
  public function __construct()
  {
    header('Content-Type: application/json');
  }

  public function streamOutput($data)
  {
    echo json_encode($data, JSON_PRETTY_PRINT);
  }
}

?>
