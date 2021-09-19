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


// Visualizzazione della tabella degli iscritti

$query_offerte="SELECT * FROM offerte";
$Result_offerte = mysqli_query($Connessione, $query_offerte);
if(!$Result_offerte)
    {
      print("Query fallita. Controllare L'inserimento!");
      exit();
    }
echo ("
<!DOCTYPE html>
<html>
<head>
<title>Tabella offerte</title>
<h1>Tabella offerte</h1>
<body>");
echo "<table>";
	echo "<tr>";
        echo "<th><b> ID offerta </b></th>";
        echo "<th><b> Codice azienda </b></th>";
        echo "<th><b> Contratto </b></th>";
        echo "<th><b> Nazione lavoro </b></th>";
        echo "<th><b> Regione lavoro</b></th>";
        echo "<th><b> Comune lavoro</b></th>";
        echo "<th><b> Scadenza</b></th>";
        echo "<th><b> Codice mansione</b></th>";
        echo "<th><b> Età minima</b></th>";
        echo "<th><b> Età massima</b></th>";
        echo "<th><b> Anni esperienza</b></th>";
    echo "</tr>";
     while ($row_offerte = mysqli_fetch_assoc($Result_offerte)) 
    { 
    echo "<tr>";
       echo "<td>" . $row_offerte['ID_offerta'] . "</td>";
       echo "<td>" . $row_offerte['Codice_azienda'] . "</td>";
       echo "<td>" . $row_offerte['Contratto'] . "</td>";
       echo "<td>" . $row_offerte['Nazione_lavoro'] . "</td>";
       echo "<td>" . $row_offerte['Regione_lavoro'] . "</td>";
       echo "<td>" . $row_offerte['Comune_lavoro'] . "</td>";
       echo "<td>" . $row_offerte['Scadenza'] . "</td>";
       echo "<td>" . $row_offerte['Codice_mansione'] . "</td>";
       echo "<td>" . $row_offerte['eta_minima'] . "</td>";
       echo "<td>" . $row_offerte['eta_massima'] . "</td>";
       echo "<td>" . $row_offerte['esperienza_minima'] . "</td>";

       

      echo "</tr>";
     }
     echo "</table>";



// Cerca offerte per ID

echo "<br><h3>Cerca offerte</h3>
<form method='POST' action='#'>
<td><input type='number' placeholder='Inserisci ID' name='ID_ricerca' required></td>
<input type='submit' name='submit' value='Invia'>
</form>
<br>
<br>
<br>";

if(isset($_POST['ID_ricerca']))
{
  $ID_ricerca=$_POST['ID_ricerca'];
  $query_ricerca="SELECT * FROM offerte WHERE ID_offerta=$ID_ricerca";
  $Result_ricerca = mysqli_query($Connessione, $query_ricerca);
if(!$Result_ricerca)
    {
      print("Query fallita. Controllare L'inserimento!");
      exit();
    }
echo "<table>";
  echo "<tr>";
       echo "<th><b> ID offerta </b></th>";
        echo "<th><b> Codice azienda </b></th>";
        echo "<th><b> Contratto </b></th>";
        echo "<th><b> Nazione lavoro </b></th>";
        echo "<th><b> Regione lavoro</b></th>";
        echo "<th><b> Comune lavoro</b></th>";
        echo "<th><b> Scadenza</b></th>";
        echo "<th><b> Codice mansione</b></th>";
        echo "<th><b> Età minima</b></th>";
        echo "<th><b> Età massima</b></th>";
        echo "<th><b> Anni esperienza</b></th>";
    echo "</tr>";
     while ($row_cerca = mysqli_fetch_assoc($Result_ricerca)) 
    { 
       echo "<tr>";
       echo "<td>" . $row_cerca['ID_offerta'] . "</td>";
       echo "<td>" . $row_cerca['Codice_azienda'] . "</td>";
       echo "<td>" . $row_cerca['Contratto'] . "</td>";
       echo "<td>" . $row_cerca['Nazione_lavoro'] . "</td>";
       echo "<td>" . $row_cerca['Regione_lavoro'] . "</td>";
       echo "<td>" . $row_cerca['Comune_lavoro'] . "</td>";
       echo "<td>" . $row_cerca['Scadenza'] . "</td>";
       echo "<td>" . $row_cerca['Codice_mansione'] . "</td>";
       echo "<td>" . $row_cerca['eta_minima'] . "</td>";
       echo "<td>" . $row_cerca['eta_massima'] . "</td>";
       echo "<td>" . $row_cerca['esperienza_minima'] . "</td>";
      echo "</tr>";
    }
echo "</table>";
}



echo ('<style>
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
</style>');


echo "</body> </html>";

mysqli_close($Connessione);


?>