## Quick-Start Guide

Dieser Guide hilft bei der Erst-Einrichtung von einem Git-Projekt. Das Projekt "FH-Loesungen" wird in einen Ordner am Desktop geladen und kann von dort aus verändert werden. Es wird davon ausgegangen, dass Zugriff auf die Bash (Terminal) besteht und Linux oder macOS verwendet wird. Zuallererst muss Git installiert bzw. der_die Benutzer_in eingerichtet werden.  

#### Git Installation

macOS:
`git` im Terminal eingeben

Linux:
`sudo apt install git` im Terminal eingeben

#### Git User einrichten

Das Einrichten von dem_der Benutzer_in ermöglicht das Hochladen, Editieren usw. von Dateien in Git-Projekten.

Im Terminal eingeben: 
`git config --global user.name "John Doe"` und `git config --global user.email johndoe@example.com`  

hierbei den Namen und die Mail-Adresse entsprechend anpassen.

#### Git-Projekt klonen bzw. einrichten
  
Um die Dateien des Projekts "FH-Loesungen" downzuloaden und neue Abgaben hinzufügen zu können, via Bash einen neuen "Working-Folder" einrichten und danach das Projekt zum derzeitigen Stand (!) klonen. Neuen Terminal öffnen und folgende Befehle eingeben:

`cd /home/USERNAME/Desktop && mkdir hierher-klonen && cd hierher-klonen"`  
`git clone https://github.com/adrianfocke/FH-Loesungen.git`

#### Neue Files uploaden

Dateien in den Ordner kopieren, benennen und danach folgende Befehle im Terminal eingeben. Zuallerst wird in den Ordner navigiert 
   
`cd /home/USERNAME/Desktop/hierher-klonen/` 
   
und dann können Dateien hinzugefügt werden:

`git pull` checkt,ob es Updates gibt (ganz wichtig)  
`git add .` fügt alle Dateien dem Projekt hinzu   
`git commit -m "Projekte von VORNAME NACHNAME hinzugefügt"`speichert Änderungen  
`git push -u origin master` lädt die Änderungen hoch
   
> Dieser Guide ist alles andere als fertig gedacht und bietet lediglich eine Grundlage für ein erstmaliges (!) Einrichten!

Hier kann nachgelesen werden: https://docs.github.com/en/github/getting-started-with-github/set-up-git
