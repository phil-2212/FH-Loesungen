<?php

class PdoModel
{
  public $servername;
  public $username;
  public $password;

  public $databaseConnection; /* to be used within the class */

  function __construct($servername, $username, $password) {
    $this->servername = $servername;
    $this->username = $username;
    $this->password = $password;
  }

  function testDatabaseConnection()
  {
    try {
      $newDatabaseConnection = new PDO("mysql:host=$this->servername;dbname=test", $this->username, $this->password);
      $this->databaseConnection = $newDatabaseConnection;

      return true;

    } catch(PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
      return false;
    }
  }

  function grabDataFromDatabase($checkedQuery)
  {

    $resultTable = array();

    try{

      foreach ($this->databaseConnection->query($checkedQuery /* from GET model */) as $row) {
        $resultTable[] = $row;
      }

      // could be given to view i feel
      $jsonOutput = json_encode($resultTable, JSON_PRETTY_PRINT);
      echo $jsonOutput;

    } catch (PDOException $ex){

      error_log("PDO ERROR: querying database: " . $ex->getMessage()."\n".$sql);
    }

  }
}
