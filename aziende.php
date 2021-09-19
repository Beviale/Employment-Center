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

$query_azienda="SELECT * FROM aziende";
$Result_azienda = mysqli_query($Connessione, $query_azienda);
if(!$Result_azienda)
    {
      print("Query fallita. Controllare L'inserimento!");
      exit();
    }
echo ("
<!DOCTYPE html>
<html>
<head>
<title>Tabella aziende</title>
<h1>Tabella aziende</h1>
<body>");
echo "<table>";
	echo "<tr>";
        echo "<th><b> ID Azienda</b></th>";
        echo "<th><b> Nome </b></th>";
        echo "<th><b> Partita IVA </b></th>";
        echo "<th><b> Nazione sede </b></th>";
        echo "<th><b> Regione sede</b></th>";
        echo "<th><b> Comune sede</b></th>";
        echo "<th><b> CAP sede</b></th>";
        echo "<th><b> Indirizzo mail</b></th>";

        
    echo "</tr>";
     while ($row_azienda = mysqli_fetch_assoc($Result_azienda)) 
    { 
    echo "<tr>";
       echo "<td>" . $row_azienda['ID_azienda'] . "</td>";
       echo "<td>" . $row_azienda['Nome_azienda'] . "</td>";
       echo "<td>" . $row_azienda['Partita_iva'] . "</td>";
       echo "<td>" . $row_azienda['Nazione_azienda'] . "</td>";
       echo "<td>" . $row_azienda['Regione_azienda'] . "</td>";
       echo "<td>" . $row_azienda['Comune_azienda'] . "</td>";
       echo "<td>" . $row_azienda['Cap_azienda'] . "</td>";
       echo "<td>" . $row_azienda['Mail_aziende'] . "</td>";

       
      echo "</tr>";
     }
     echo "</table>";



// Cerca azienda per ID

echo "<br><h3>Cerca azienda</h3>
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
  $query_ricerca="SELECT * FROM aziende WHERE ID_azienda=$ID_ricerca";
  $Result_ricerca = mysqli_query($Connessione, $query_ricerca);
if(!$Result_ricerca)
    {
      print("Query fallita. Controllare L'inserimento!");
      exit();
    }
echo "<table>";
  echo "<tr>";
        echo "<th><b> ID Azienda</b></th>";
        echo "<th><b> Nome </b></th>";
        echo "<th><b> Partita IVA </b></th>";
        echo "<th><b> Nazione sede </b></th>";
        echo "<th><b> Regione sede</b></th>";
        echo "<th><b> Comune sede</b></th>";
        echo "<th><b> CAP sede</b></th>";
        echo "<th><b> Indirizzo mail</b></th>";


    echo "</tr>";
     while ($row_cerca = mysqli_fetch_assoc($Result_ricerca)) 
    { 
       echo "<tr>";
       echo "<td>" . $row_cerca['ID_azienda'] . "</td>";
       echo "<td>" . $row_cerca['Nome_azienda'] . "</td>";
       echo "<td>" . $row_cerca['Partita_iva'] . "</td>";
       echo "<td>" . $row_cerca['Nazione_azienda'] . "</td>";
       echo "<td>" . $row_cerca['Regione_azienda'] . "</td>";
       echo "<td>" . $row_cerca['Comune_azienda'] . "</td>";
       echo "<td>" . $row_cerca['Cap_azienda'] . "</td>";
       echo "<td>" . $row_cerca['Mail_aziende'] . "</td>";


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