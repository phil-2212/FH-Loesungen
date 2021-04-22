<?php
//Wir includen das Config File in dem wir alles an Kontextdaten für die Anwendung
//organisieren.
include "config/config.php";

//wir verwenden die so genannte MVC Architektur
//Sie ermöglicht, dass wir die Agierenden Komponenten kapseln. D.h. sie werden
//logisch von einander getrennt und man erlangt bessere Lesbarkeit, Flexibilität
//und vorallem Erweiterbarkeit der Software

//Hier instanzieren und erzeugen wir unser Controller Objekt, welches
//Das Feature der Telefonzentrale bildet. 
$SwitchboardController = new Switchboard();
//nachdem der Controller erzeugt ist, wollen wir eine Funktion aufrufen
//die dem Objekt sagt, dass es arbeiten beginnen soll
$SwitchboardController->route();