<?php

class Controller
{
  function work() {
    $userParameters = new GetParametersModel();

    if ($userParameters->checkParametersForCorrectness()) {

      $pdoObject = new PdoModel("localhost", "root", "");
      $pdoObject->testDatabaseConnection();
      $pdoObject->grabDataFromDatabase($userParameters->checkedQuery); /* grabbing the checked query from the user */

      $view = new View();
    } else {

      echo "Request aborted – please use correct parameters!";
    }
  }
}
