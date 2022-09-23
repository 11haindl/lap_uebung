# :page_facing_up: Aufgabenstellung

programmiertes Projekt folgt!!

Die Aufgabenstellung ist eine Erweiterung der Übung1

## :clock1: Zeitmanagement:

Erstellen Sie einen Zeitplan, in dem Sie abschätzen, wann Sie mit welchem Teil der Anwendung fertig sein möchten. Dieser Zeitplan dient nicht als "Deadline", sondern dient als grobe Stütze für Sie und kann sich im Laufe der Entwicklung ändern

Nutzen Sie hierfür das sogenannte Gantt-Chart.

:bulb: Tipp:
Veranschlagen Sie ca. 1,5 Std. für Datenbankdesign und Zeitmanagement.


## :chart_with_upwards_trend: Datenbankdesign:

Erstellen Sie ein Datenbank-Diagramm für einen Webshop, welches zwischen zwei Benutzerrollen unterscheidet, Administratoren und Benutzern. Ein Benutzer (und Administrator) muss persönliche Informationen wie Name, Adresse, Geburtsdatum etc. besitzen. Wenn sich ein Benutzer anmeldet, soll ihm eine Auflistung aller im Onlineshop verfügbaren Produkte gezeigt werden und er soll diese mittels eines Suchfeldes einschränken können.

Jedes Produkt muss einen Namen, einen Preis und einen sogenannten "Verkäufer", welcher das Produkt verkauft, besitzen. Ein "Verkäufer" kann ein Administrator oder Benutzer sein.


## :euro: Webshop:

Erstellen Sie einen Webshop, welcher ein separates Login für Administratoren und „normale“ Benutzer beinhaltet. Ein Benutzer soll alle Produkte sehen und diese mittels eines Suchfeldes einschränken können. Dem Benutzer soll es auch möglich sein, ein Produkt seinem "Warenkorb" hinzuzufügen.

Weiters soll es dem Benutzer möglich sein, seinen Warenkorb einzusehen und Produkte wieder zu löschen. Ob Sie den Warenkorb auf einer Seite mit der Auflistung der Produkte implementieren, oder ihn auf eine andere Weise verwalten, bleibt Ihnen überlassen.


Ein Administrator soll hingegen die Möglichkeit besitzen, die Daten eines Produktes zu ändern, ein Produkt zu löschen und ein Produkt hinzuzufügen.


Um den Kunden und Administratoren einen herzlichen Empfang zu bereiten, ist es Ihre Aufgabe eine "Willkommensseite" zu implementieren, welche den Benutzer persönlich begrüßt und ihm anzeigt, wann er sich das letzte Mal, vor dem aktuellen Login, angemeldet hat.


Bitte beachten sei folgende Punkte:

-	Als Datenbank muss MariaDB verwendet werden.
-	Als Programmiersprache muss PHP verwendet werden.
-	Als Schnittstelle zwischen PHP und MariaDB muss MySQLi verwendet werden.
-	Als Webserver muss Apache2 verwendet werden.
-	Als Editor kann alles verwendet werden. (Auch IDEs)
-	Bitte entwickeln Sie Ihren Webshop auf Ihrem lokalen PC und übertragen Sie die Dateien mittels FTP auf den virtuellen PC. Es wird nur bewertet, was von ihrem Webserver (Apache2) bereitgestellt wird.
-	Als Programmierprinzip muss die objektorientierte Programmierung verwendet werden, auch wenn PHP diese nicht verpflichtend voraussetzt.



## :gift: Bonus:

-	Verhindern Sie sogenannte "SQL-Injections".
-	Verhindern Sie im Falle einer Offenlegung der Datenbank, dass die Passwörter der Benutzer im Klartext ersichtlich sind.
-	Geben Sie einem Administrator die Möglichkeit einen neuen Benutzer anzulegen (Administrator oder Benutzer).
-	Da der Internet Explorer veraltet ist und neue Features nicht unterstützt, führen Sie einen sogenannten "Browsercheck" durch und sollte mit dem Internet Explorer auf den Webshop zugegriffen werden. Geben Sie eine Information aus.
-	Bieten Sie einem Benutzer die Möglichkeit, seinen Warenkorb zu drucken
-	Erweitern Sie die Willkommensseite um den Browser und die IP-Adresse des letzten Logins.
-	Geben Sie den Administratoren einen Überblick über die Anzahl der Produkte auf der Willkommensseite
