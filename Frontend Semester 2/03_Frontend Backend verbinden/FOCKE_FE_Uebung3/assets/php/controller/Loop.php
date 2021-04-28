<?php

class Loop
{
  private $charactersFromData;
  private $characters;

  private $view;

  public function __construct()
  {
    $this->view = new JsonView();

    $this->charactersList = $this->createCharactersFromData();

    // Create object instance on which the "real" methods are being called
    $this->characters = new LoopModel($this->charactersFromData);
  }

  private function createCharactersFromData()
  {
    $this->charactersFromData = array();

    // TODO: MOre awesome file path
    $json = file_get_contents("../../data/characters.json");
    $dataObject = json_decode($json);

    foreach ($dataObject->characters as $character) {
      array_push($this->charactersFromData, $character);
    }

    return $this->charactersList;
  }

  public function createLoopFromLoopType()
  {
    $loopType = $_GET['loopType'];
    $untilCharacter = $_GET['until'];

    if ($loopType === 'EVEN') {
      $this->characters->loopEven();
      $this->createJsonObject();
    }
    elseif ($loopType === 'REVERSE') {
      $this->characters->loopReverse();
      $this->createJsonObject();
    }
    elseif ($loopType === 'UNTIL' && $untilCharacter) {
      $this->characters->loopUntil($untilCharacter);
      $this->createJsonObject();
    }
    else {
      echo "You need a correct loop type, bruh.";
    }
  }

  private function createJsonObject()
  {
    $JsonObject = new stdClass();

    $JsonObject->loopName = $_GET['loopType'];
    $JsonObject->result = $this->characters->getCharacters();

    $this->view->streamOutput($JsonObject);
  }
}
