<?php

class LoopSimulationController{
    
    private $jsonView;
    private $loopSimulator;
    
    //Wir bereiten im Konstruktor die Eigenschaften des Objekts vor
    public function __construct() {
        $this->jsonView = new JsonView();
        $this->loopSimulator = null;
    }

    //Diese Methode entscheidet welche Eingabe Parameter zu welchen Aktionen führen werden
    public function route(){
        
        //Parameter auslesen - dabei verwenden wir eine spezielle php Funktion um
        //die parameter von möglichem Schadcode zu filtern - Stichwort: sql-Injection
        $simulationType = filter_input(INPUT_GET, 'loopType', FILTER_SANITIZE_SPECIAL_CHARS);
        $stopCharacter = filter_input(INPUT_GET, 'until', FILTER_SANITIZE_SPECIAL_CHARS);
        
        //aufgrund dieser parameter erzeugen wir das Gewünshcte Simulator Objekt mit dem wir 
        //dann weiter arbeiten - Es wird in der Property $loopSimulator gespeichert
        //der Rückgabeparameter sagt uns ob das Erzeugen funktioniert hat
        $creationSucessfull = $this->createLoopSimulator($simulationType, $stopCharacter);
        if($creationSucessfull){
            
            //der Simulator wird gestartet und gibt ein ergebnis zurück
            $result = $this->loopSimulator->getSimulationResult();
            
            //Ausgabe nach Schnittstellen-Spezifikation formatiere
            $outputData = array (
                "loopName" => $simulationType,
                "result"=> $result
             );
            
            //Ausgabe starten
            $this->jsonView->streamOutput($outputData);
            
        } else {
            //Im Fehler Fall geben wir eine Fehlermeldung aus
            $errorData = array(
                "ERROR" => "Simulator Type ".$simulationType." not found."
            );
            $this->jsonView->streamOutput($errorData);
        }
    }
    
    
    //diese Methode entscheidet welchen Simulator wir in unser loopSimulator Property laden
    private function createLoopSimulator($type, $stopCharacter){
        
        //je nach Typ erzeugen wir ein Objekt der entsprechenden Klasse.
        //da php untypisiert verwendet werden kann ist dies möglich
        //in java würden Sie einen genereischen datentyp für loopSimulator verwenden
        switch ( strtolower( $type ) ){
            
            case 'reverse':
                $this->loopSimulator = new ForeachSimulatorModel('reverse');
                break;
            
            case 'even':
                $this->loopSimulator = new ForSimulatorModel(2);
                break;
            
            case 'until':
                
                $this->loopSimulator = new WhileSimulatorModel($stopCharacter);
                break;
            
            case false: default: 
                                
                return false;
        }
        
        return true;
    }
    
}