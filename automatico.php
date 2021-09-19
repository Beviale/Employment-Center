<?php
ini_set('display_errors',0);
session_start();

if(!isset($_SESSION['verifica']))
{
	echo "<h1>Non sei autorizzato ad accedere a questa pagina</h1>";
	exit();
}

$Connessione= mysqli_connect("localhost","root");
if(!$Connessione)
 {
    echo ("<H1>Connessione al server MySQL fallita</H1>"); 
	exit;
}
$DB = mysqli_select_db($Connessione, "impiego");

if(!$DB)
{
    echo ("<H1>Connessione al database fallita</H1>");
	exit;
}


$anno_attuale=date("Y");
echo "<br><h3>Inserisci ID iscritto</h3>
<form method='POST' action='#'>
<td><td><input type='number' placeholder='Inserisci ID' name='inserisci' required></td>
<input type='submit' name='submit' value='Invia'>
</form>
<br>
<br>";

if(isset($_POST['inserisci']))
{
  $ID_iscritto=$_POST['inserisci'];
  $query="SELECT ID_offerta, Codice_azienda, nazione_lavoro, regione_lavoro, comune_lavoro, contratto FROM offerte INNER JOIN mansioni ON mansioni.ID_mansione=offerte.Codice_mansione INNER JOIN effettua ON mansioni.ID_mansione=effettua.Codice_mansione INNER JOIN iscritti ON effettua.Codice_iscritti=iscritti.ID_iscritto
 WHERE effettua.anni_esperienza>=offerte.esperienza_minima AND $anno_attuale-iscritti.anno_nascita>=offerte.eta_minima AND $anno_attuale-iscritti.anno_nascita<=offerte.eta_massima AND iscritti.ID_iscritto=$ID_iscritto";
$Result = mysqli_query($Connessione, $query);
if(!$Result)
    {
      print("Query fallita. Controllare L'inserimento!");
      exit();
    }

echo ("
<!DOCTYPE html>
<html>
<head>
<title>Trova offerte</title>
<h1>Tabella offerte</h1>
<body>");
echo "<table>";
  echo "<tr>";
        echo "<th><b> ID offerta</b></th>";
        echo "<th><b> ID azienda </b></th>";
        echo "<th><b> Nazione lavoro </b></th>";
        echo "<th><b> Regione lavoro </b></th>";
        echo "<th><b>Comune lavoro </b></th>";
        echo "<th><b>Contratto </b></th>";


    echo "</tr>";
     while ($row_automatico = mysqli_fetch_assoc($Result)) 
    { 
    echo "<tr>";
       echo "<td>" . $row_automatico['ID_offerta'] . "</td>";
       echo "<td>" . $row_automatico['Codice_azienda'] . "</td>";
       echo "<td>" . $row_automatico['nazione_lavoro'] . "</td>";
       echo "<td>" . $row_automatico['regione_lavoro'] . "</td>";
       echo "<td>" . $row_automatico['comune_lavoro'] . "</td>";
       echo "<td>" . $row_automatico['contratto'] . "</td>";


      echo "</tr>";
    }
     echo "</table> <style>
table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  text-align: left;
  padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}

th {
  background-color: green;
  color: white;
}
</style> </body> </html>";



}



mysqli_close($Connessione);
?>


