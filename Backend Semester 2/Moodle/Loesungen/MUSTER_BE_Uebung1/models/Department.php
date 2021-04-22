<?php
/**
 * Diese Model Klasse repräsentiert eine Abteilung
 * in unserer Fiktiven Organisation
 * 
 * Sie verwaltet die Abteilung nach Innen und bietet nach Außen Zugriffspunkte
 *
 * @author helmuth
 */
class Department {
    
    /**
     * der Name der Abteilung
     * @var string 
     */
    private $name;
    /**
     * die Telefonnummer
     * @var string
     */
    private $phoneNumber;
    /**
     * eine Liste von Mitarbeiterobjekten
     * @var array
     */
    private $employees;
    
    /**
     * der Konstruktor bereitet das Objekt darauf vor, dass man mit den
     * Eigenschaften arbeiten kann
     * 
     * In diesem speziellen Fall werden Name und Telefonnummer der Abteilung
     * bereits beim Erzeugen mit übergeben
     * 
     * @param string $name
     * @param string $phoneNumber
     */
    public function __construct($name, $phoneNumber) {
        //um mit den Inputs in jeder Methode arbeiten zu können
        //übergeben wir sie unseren properties
        $this->name = $name;
        $this->phoneNumber = $phoneNumber;
        
        //damit später Mitarbeiter eingefügt werden können erstellen wir
        //ein leeres Array als Vorberietung
        $this->employees = array();
    }
    
    /**
     * Mit dieser Methode kann man von Außen der Abteilung
     * Mitarbeiter hinzufügen
     * 
     * @param array $employeesList
     */
    public function addEmployees($employeesList){
        
        //wir iterieren über alle übergebenen mitarbeiter
        foreach($employeesList as $employee){
            //und fügen sie der Liste hinten an
            $this->employees[] = $employee;
        }        
        //somit wäre es möglich auch später noch weitere Mitarbeiter hinzuzufügen
    }
    
    /**
     * Diese Methode wählt einen zufälligen Mitarbeiter aus und übergibt
     * ihn an die Aufrufende Instanz - Der Mitarbeiter bleibt in der List des
     * Objektes bestehen.
     */
    public function getRandomEmployee(){
        //in php kann man mit rand(min,max) einen pseudo-Randomwert zwischen zwei Grenzen
        //erzeugen. Da wir mit dem Index über den ganzen Array der Mitarbeiter
        //schauen wollen, wählen wir 1 bis Anzahl der Mitarbeiter.
        //wir ziehen 1 ab, weil ein Array bekanntlich von 0 bis n-1 indiziert ist
        $randomIndex = rand(1, count($this->employees)) -1;
 
        //wir weisen den Mitarbeiter einer Variable zu
        $randomEmployee = $this->employees[$randomIndex];
        //wir übergeben den Mitarbeiter an den Aufrufer
        return $randomEmployee;
    }
    
    //getter Methode
    public function getName(){
        return $this->name;
    }
    
    //getter Methode
    public function getNumber(){
        return $this->phoneNumber;
    }
}
