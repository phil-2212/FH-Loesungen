<?php

/**
 * @author helmuth
 */
class ForSimulatorModel implements LoopSimulatorInterface{
    
    //der Simulator kann verschiedene schrittgrößen unterstützen
    //d.h. nicht nur "odd" wäre möglich
    private $stepSize;
    //die beiden paramter erklären sich von selbst, oder?
    private $workArray;
    private $resultArray;
    
    public function __construct($stepSize) {
        $this->stepSize = $stepSize;
        //so erzeugt man ein Array von A bis Z mit hilfe einer fancy funktion
        $this->workArray = range('A', 'Z');
        
        $this->resultArray = array();
    }
    
    //setter
    public function setWorkArray($workingArray) {
        $this->workArray = $workingArray;
    }
    
    public function getSimulationResult() {
        $this->startSimulation();
        return $this->resultArray;
    }
    
    //iteration über alle elemente und je nach schrittweite
    //nur jene elemente in den ergebnis array geben.
    private function startSimulation(){
        
        for($i=0; $i<count($this->workArray); $i++){
            if($i % $this->stepSize != 0){
                $this->resultArray[] = $this->workArray[$i];
            }
        }
    }
    
}
