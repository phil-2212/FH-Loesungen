### Quick-Start Guide

Dieser Guide hilft all jenen, die via Terminal einrichten. Ich verwende Ubuntu.
Zuallererst muss Git installiert bzw. der_die Benutzer_in eingerichtet werden.  

  `sudo apt install git`  
  `git config --global user.name "John Doe"`  
  `git config --global user.email johndoe@example.com`
  
danach via Bash in den gewünschten Ort (z.B.: Desktop) navigieren und den schon vorhandenen Code klonen:

   `cd /home/user/Desktop/ && mkdir hierher-klonen && cd hierher-klonen"`  
   `git clone https://github.com/adrianfocke/FH-Loesungen.git`

dann kann das happy coding auch schon starten ;-) Dateien hinzufügen und danach im Ordner "FH-Lessungen" folgendes im Terminal 
   
   `git pull`  
   `git add .`  
   `git commit -m "Projekte von VORNAME NACHNAME hinzugefügt"`  
   `git push -u origin master`
   
weitere Infos folgen!

Hier kann nachgelesen werden: https://docs.github.com/en/github/getting-started-with-github/set-up-git
