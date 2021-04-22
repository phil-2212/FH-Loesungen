<?php
//In einem Config File sammeln wir alle Dateien zusammen in denen Klassen liegen
//um an einer Stelle rasch weitere Files hinzuzufügen. Somit wissen wir immer
//sofort, an welcher Stelle wir agieren müssen

//mit diesem Befehle aktivieren wir Detaillierte Fehlermeldungen des PhP Interpreters
error_reporting(E_ALL);

//durch den include Befehl wird eine Datei in eine Andere Datei eingefügt
//als würde an den inhalt mit copy-past einfügen.
//
//Daher ist die Reihenfolge der includes unter Umständen ausschlaggebend
//in diesem Fall hier fordern wir nur dateien an die Klassen enthalten und keine
//Logik ausführen sobald sie includet sind. Die Klasse wird erst durch die
//Instanzierung ein Objekt erzeugen.
include "controller/Switchboard.php";
include "models/Department.php";
include "views/JsonView.php";

//Eine Konstante wird in PHP durch die define() Funktion erzeugt und
//ist in jedem File der Anwendung verfügbar
#define("DATAPATH", '/var/www/FH-Technikum/vorlesung/Uebung1/data/'); 
define("DATAPATH", 'C:\xampp\htdocs\Uebung1\data\\'); //da der Backslach in PhP ein folgendes
//sonderzeichen escapet müssen wir am Ende 2 Backslashes verwenden um das escaping
//auf zu heben - dies ist ein spezielles Problem unter Windows Betriebssystemen.