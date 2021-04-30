<?php
/**
  * @author helmuth
 */
class WhileSimulatorModel implements LoopSimulatorInterface {
    
    private $stopCharacter;
    private $workArray;
    private $resultArray;
    
    public function __construct($stopCharacter) {
        $this->stopCharacter = strtoupper($stopCharacter);
        $this->workArray = range('A', 'Z');
        $this->resultArray = array();
    }
    
    public function setWorkArray($workingArray) {
        $this->workArray = $workingArray;
    }
    
    public function getSimulationResult() {
        $this->startSimulation();
        return $this->resultArray;
    }
    
    private function startSimulation(){
        $index = 0;
        //solange elemente im array sind und solange unser Stop-Zeichen nicht gefunden wurde
        while ($index<count($this->workArray) 
            && $this->workArray[$index] != $this->stopCharacter){
            
            //befüllen wir den Ergebnisarray mit den Einträgen
            $this->resultArray[] = $this->workArray[$index];
            $index++;
        }
        
        //wenn das Ende erreicht wurde und der letzte Eintrag nicht das gesuchte
        //Zeichen ist schreiben wir einen Fehler in den array dazu
        if($index == count($this->workArray) 
            &&  $this->workArray[$index-1] != $this->stopCharacter ){
            
            $this->resultArray["ERROR"]= "Letter >".$this->stopCharacter."< not found. " ;
        }
    }
    
}
