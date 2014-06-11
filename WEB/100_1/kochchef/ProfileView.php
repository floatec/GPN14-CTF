Disapbled For Security Reasons
<!-- <form method="get"> <input name="user"><input type="submit" value="Search"></form>
<?php
$dbhost="127.0.0.1";
$dbuser="root";
$dbpass="";
$dbname1="kochchef";
$db1 = mysql_connect($dbhost, $dbuser, $dbpass);
$rv = mysql_select_db($dbname1, $db1);
/**
 * Created by PhpStorm.
 * User: floatec
 * Date: 11.06.14
 * Time: 12:46
 */
$query = sprintf("SELECT * from rezepte where (sichtbar = 1 and user like '%s') ",($_GET['user']));
// Führe Abfrage aus
$result = mysql_query($query);

// Prüfe Ergebnis
// Dies zeigt die tatsächliche Abfrage, die an MySQL gesandt wurde und den
// Fehler. Nützlich bei der Fehlersuche
if (!$result) {
    $message  = 'Ungültige Abfrage: ' . mysql_error() . "\n";
    $message .= 'Gesamte Abfrage: ' . $query;
    die($message);
}

// Nutze Ergebnis
// Der Versuch $result auszugeben, erlaubt keine Zugriff auf die Informationen
// der Ressource.
// Eine der MySQ result Funktionen muss genutzt werden
// Siehe auch: mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
echo "<h1>Profil von: ".$_GET['user']."<h2>";
while ($row = mysql_fetch_array($result)) {
    echo "<h2>".$row['name']."(".mysql_num_rows($result)." Rezepte)</h2>";

    echo $row['beschreibung'];
    echo "<h2>Zutaten</h2>";
    echo $row['zutaten'];
}

// Gebe Ressourcen, die mit der Ergebnismenge assoziiert sind, frei
// Dies geshieht am Ende eines Skriptes automatisch
mysql_free_result($result);
?>
-->