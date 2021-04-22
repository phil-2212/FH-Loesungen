<?php

/**
 * Diese Klasse ist eine Kontrollerklasse
 * Kontroller beihalten die Steuerunng über die logik der Anwendung
 * für den Anwender. d.h. diese Logik ist von Außen nachvollziehbar.
 * 
 * Der Kontroller entscheidet in der Gesamtlogik der Anwendung welche s.g.
 * Models verwendet werden sollen um einen bestimmten Zweck zu erfüllen.
 * 
 * In unserem Fall gibt es zunächst nur ein Model, das Abteilungen repräsentiert.
 * Der Kontroller wird die Departments erzeugen, darauf arbeiten und sie verwalten.
 * 
 * Auf dieser Logikebene ist die Repräsentation der Abteilung irrelevant.
 * 
 * Weiters wird sich der Kontroller darum kümmern wie die Ausgabe zu erfolgen hat.
 * Dazu hat er eine Property, die eine Klasse besitzt, die spezifiziert, wie eine
 * bestimmte Ausgabe zu erfolgen hat: Dort ist die Detaillogik gekapselt.
 * 
 * Somit wird für den Kontroller unwichtig wie die Ausgabe funktioniert.
 * 
 * Die logische Trennung der Komponenten ist somit erreicht und die Komponenten
 * können später sehr leicht asugetauscht werden.
 *
 * @author helmuth
 */
class Switchboard {
    
    /**
     * Die liste der Departments die wir verwalten werden
     * @var array
     */
    private $departments;
    /**
     * Ein Objekt dass die Ausgabe für uns erledigen wird
     * @var JsonView 
     */
    private $jsonView;
    
    
    /**
     * Ein Konstruktor wird in php über das wort "__construct" implementiert
     * Grundsätzlich soll ein Konstruktor ein Objekt darauf vorberieten,
     * dass man mit dem Objekt und seinen Eigenschaften arbeiten kann.
     * 
     * Darunter fällt das initialisieren der Properties und sonstiger Daten-
     * Strukturen auf denen gearbeitet wird.
     * 
     * In diesem Fall erstellen wir eine leer Liste für die Abteilungen
     * und initialisiern das JsonView - Ausgabe Objekt um in weiterer Folge
     * die Ausgabe nutzen zu können
     * Zuletzt rufen wir eine Sub-Methode auf, die die Departments erzeugt
     * Wichtig: An dieser Stelle müssen wir nicht wissen wie das geschieht, denn
     * darum kümmert sich die untermehtode createDepartments()
     * 
     */
    public function __construct() {
        
        $this->departments = array(); //von department objekten
        $this->jsonView = new JsonView();
        $this->createDepartments();
        
    }
    
    
    /**
     * Submethoden sind grundsätzlich private, weil es nicht notwendig ist
     * und in gewissen Fällen wahrscheinlich schadhaft, von außen darauf zu 
     * zu greiffen. Denken Sie daran, dass wir hier interne Properties manipulieren.
     * Die Klasse sollte alleine die Macht darüber haben.
     * 
     * Diese Methode enthält zwar viel Logik für eine Konitrollermethode, ist aber
     * der Einfachheithalber hier zusammen gefasst.
     * 
     * Diese Methode lädt daten, die im json Format vorliegen aus einer
     * Datei und erzeugt je Abteilung ein Objekt der Department und fügt die
     * Mitarbeiter hinzu
     */    
    private function createDepartments(){
        //um die Daten zu laden, wird erst die Datei lokalisiert
        $dataFilePath = DATAPATH . "departments.json";
        //und dann der inhalt der Datei in eine variable geschrieben
        $dataFile = file_get_contents($dataFilePath);
        //und zuletzt dieser Ihnalt mit hilfe der Funktion: json_decode() aus dem JSON
        //String in ein php Objekt dekodiert(umgewandelt)
        $jsonObject = json_decode($dataFile);
            
        //das Roh-Daten Objekt befindet sich im ersten Objekt der Struktur
        //Vergleichen Sie mit der JSON Struktur im File departments.json
        $rawDepartmentData = $jsonObject->departments;
        
        //nun iterieren wir über alle Abteilungen und erzeugen und befüllen
        //die Objekte - der besseren Lesbarkeithalber habe ich eine weitere Subroutine eingeführt
        foreach($rawDepartmentData as $department){
            //wir rufen die hilfs-methode auf, die uns ein Department erzeugt
            //und zum property array departments hinzufügen wird
            $this->addDepartmentToList($department);
        }
    }
    
    /**
     * Diese Methode erzeugt ein Department Objekt und fügt es an einer
     * durch die Telefonnummer eindeutig identifizierbaren Id der departments-property
     * hinzu
     * 
     * wir übergeben einen Ausschnitt aus dem gesamt JSON Daten Objekt,
     * welches alle Informationen zu einer Abteilung enthält
     * @param stdClass $department
     */
    private function addDepartmentToList($department){
        //zuerst lesen wir die Variablen aus dem Objekt und legen Sie in Variablen
        //das machen wir, da wir eventuell später mit den Daten weiter arbeiten
        //was üblicherweise vorkommt. Die Originaldaten lassen wir immer unverändert
        $name = $department->name;//enthält einen String
        $number = $department->number;//enthält einen String
        $employees = $department->employees;//enthält ein Objekt (stdClass)

        //dann erzeugen wir ein Objekt der Klasse Department und übergeben
        //dem Konstruktor den Namen und die Telefonnummer
        $currentDepartment = new Department($name, $number);
        //und fügen über die vorgegebene Methode die Mitarbeiter hinzu
        $currentDepartment->addEmployees($employees);

        //wir verwenden die Telefonnummer als Index in unserem Array of Departments
        //dmit können wir dann einfach in der Liste nachsehen, wenn ein Call herein-
        //kommt
        //da wir nicht sicher sein können, dass der Benutzer die Nummer genau so
        //wie wir sie eingetragen haben verwendet (z.b. mit oder ohne Leerzeichen)
        //erzeugen wir einen Index bei dem wir sicher sein können, dass er von
        //uns später richtig identifiziert werden kann
        $hashIndex = $this->createCleanIndex($number);
        //dann fügen wir dem assoziativen departmens array das neue Objet hinzu
        $this->departments[$hashIndex] = $currentDepartment;
    }
    
    /**
     * Diese Methode entfernt jegliche Leerzeichen von einer Nummer
     * und erzeugt einen 32 Zeichen langen eindeutigen HEX Wert,
     * damit die Repräsentation der Nummer auf jeden Fall in PhP verwendet werden kann,
     * egal wie viele Zeichen und Leerzeichen die Eingabe hat
     * 
     * @param string $anyString
     * @return string (32 Zeichen langer Hashwert)
     */
    private function createCleanIndex($anyString){
        //entferne alle Leerzeichen und insbesondere am anfang und am Ende (trim)
        $trimmedString = trim( str_replace(" ", "", $anyString) );
        //str_replace erwartet als 1. Paremter den String den Sie ersetzen wollen
        //als 2. den String der eingesetzt wernden soll - Leerstring = Löschen des anderen
        //und als 3. Paraeter den String auf dem operiert werden soll.
        
        //wir hashen den string, damit z.b. Ziffenrfolgen
        //nicht als integer interpretiert werden können - beachten Sie, dass
        //php nicht typesafe programmiert werden muss.
        //Außerdem garantieren wir, dass der Wert für einen Key in einem assoziativen
        //Array verwendet werden kann. Weiters kann ein key maximal 256 Zeichen lang sein
        //Dies ist eine best-practice beim Umgang mit Indizes die man eigentlich über 
        //einen String identifizierne möchte.
        return md5($trimmedString);
    }
    
    
    /**
     * Diese Methode ist nach außen die Schnittstelle
     * nach innen entscheidet diese Methode was die Anwendung für den 
     * Service Konsumenten, je nach Anfrage erledigen wird
     * 
     * Dabei gilt es zu verstehen, dass Sie hier nur einen Ansatz kennen lernen
     * wie man im MVC in einem Controller routing betreibt.
     */
    public function route(){
        //anhand der parameter des http request entscheiden wir was zu tun ist
        if( isset($_GET['phoneNumber']) ){
            //Da der Parameter offenbar vorhanden ist werden wir uns entscheiden
            //weiter zu arbeiten
            //wir lesen die Variable aus
            $phoneNumber = $_GET['phoneNumber'];
            
            //und versuchen ein Department z uerreichen, alles weitere erledigt
            //die private Methode
            $this->callDepartment($phoneNumber);
        }
    }
    
    /**
     * diese Methode repräsentiert einen echten BusinessLogik Fall.
     * Hier wird anhand der Telefonnummer ein Department herausgesucht
     * Dem Department gesagt was zu tun ist und eine Ausgabe über die
     * View des Objektes an den Client asugegeben
     * 
     * @param string $phoneNumber
     */
    private function callDepartment($phoneNumber){
        //zunächst erzeugen wir einen für uns intern eindeutigen Index
        //der von allen sonstigen Zeichen die evtl. eingegeben wurden
        //befreit wird - außerdem erzeugen wir einen Index, der für uns
        //intern eindeutig und fehlerfrei verarbeitet werden kann.
        $departmentIndex = $this->createCleanIndex($phoneNumber);
        //somit können wir das Department direkt aus dem Array abrufen
        $department = $this->departments[$departmentIndex];
        
        //Falls die Telefonnummer falsch eingegeben wurde
        if(!isset($department)){
            //geben wir einen Fehler aus.
            //Dazu erzeugen wir ein Array dass wir dann an die View weitergeben
            $error = array(
                "ERROR" => "Department not found under " . $phoneNumber  . "."
            );
            //um an den Client diesen Daten-Array zu übergeben
            //die View kümmert sich dabei um die Repräsentation
            $this->jsonView->streamOutput($error);
            //damit die Ausführung des Skripts hier endet, 
            //geben wir false zurück. das ist eine gängige praxis
            //wenn man kein error handling mit try-catch implementiert
            return false;
        }
        
        //falls die telefonnummer gefunden wurde bitten wir die Abteilung
        //uns einen zufälligen Mitarbeiter zu geben
        $employee = $department->getRandomEmployee();
        //um die Ausgabe vor zu bereiten lesen wir auch den Namen
        //des departments in eine Variable ein
        $departmentName = $department->getName();
        
        //wir erstellen ein Ausgabe Objekt nach der vorgegebenen Spezifikation
       //{department: <string>, employee: <string>, line: <int>}
        $data = new \stdClass();
        $data->department = $departmentName;
        $data->employee = $employee->name;
        $data->line = $employee->line;
        
        //und bitten die View unser Datenobjekt an den Client zu streamen
        $this->jsonView->streamOutput($data);
    }
}
