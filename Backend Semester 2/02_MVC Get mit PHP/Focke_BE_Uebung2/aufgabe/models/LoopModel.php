<?php

class LoopModel
{
  private $characters;

  public function __construct($characters)
  {
    $this->characters = $characters;
  }

  // Remember: Java frist semester same procedure
  public function getCharacters()
  {
    return $this->characters;
  }
  private function setCharacters($characters)
  {
    $this->characters = $characters;
  }

  // Methods that BELONG to this model (!) --> to be used ON this very object
  public function LoopEven()
  {
    $tempCharacters = array();

    for ($i = 1, $size = count($this->characters); $i < $size; $i++) {
      array_push($tempCharacters, $this->characters[$i]);
      $i++;
    }

    $this->setCharacters($tempCharacters);
  }

  public function loopReverse()
  {
    $count = count($this->characters) - 1;

    foreach ($this->characters as $characters) {
      array_splice($this->characters, $count, 1, $characters);
      $count--;
    }
  }

  public function loopUntil($until)
  {
    $newList = [];
    $count = 0;

    while ($this->characters[$count] !== $until) {
      array_push($newList, $this->characters[$count]);
      $count++;
    }

    array_push($newList, $this->characters[$count]);

    $this->setCharacters($newList);
  }
}

?>
