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

$query_proposte="SELECT * FROM proposte";
$Result_proposte = mysqli_query($Connessione, $query_proposte);
if(!$Result_proposte)
    {
      print("Query fallita. Controllare L'inserimento!");
      exit();
    }
echo ("
<!DOCTYPE html>
<html>
<head>
<title>Tabella compatibili</title>
<h1>Tabella compatibili</h1>
<body>");
echo "<table>";
	echo "<tr>";
        echo "<th><b> ID proposta </b></th>";
        echo "<th><b> Codice offerta </b></th>";
        echo "<th><b> Codice iscritto </b></th>";
    echo "</tr>";
     while ($row_proposte = mysqli_fetch_assoc($Result_proposte)) 
    { 
    echo "<tr>";
       echo "<td>" . $row_proposte['ID_proposta'] . "</td>";
       echo "<td>" . $row_proposte['Codice_offerta'] . "</td>";
       echo "<td>" . $row_proposte['Codice_iscritto'] . "</td>";

      echo "</tr>";
     }
     echo "</table>";

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