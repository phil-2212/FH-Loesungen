<?php

/**
 * @author helmuth
 */
class ForeachSimulatorModel implements LoopSimulatorInterface {
    
    private $workArray;
    private $resultArray;
    private $mode;
    
    public function __construct($mode) {
        $this->mode = $mode;
        $this->workArray = range('A', 'Z');
        $this->resultArray = array();
    }
    
    public function setWorkArray($workingArray) {
        $this->workArray = $workingArray;
    }
    
    public function getSimulationResult() {
        switch($this->mode){
            case 'reverse':
                $this->reverseSimulation();
                break;
            case 'realFlip':
                $this->flipSimulation();
                break;
        }
        
        return $this->resultArray;
    }
    
    //diese funtkion dreht den array um
    private function reverseSimulation(){
        foreach($this->workArray as $item){
            array_unshift($this->resultArray, $item);
        }
    }
    
    //diese funktion tauscht die Indizes mit den Werten
    //probieren sie die Funktion einfach aus und sehen Sie im Browser das Ergebnis an
    //dann ist klar worum es geht.
    private function flipSimulation(){
        foreach($this->workArray as $key => $value){
            $this->resultArray[$value] = $key;
        }
    }
}
