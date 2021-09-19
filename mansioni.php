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


// Visualizzazione della tabella delle mansioni

$query_mansioni="SELECT * FROM mansioni";
$Result_mansioni = mysqli_query($Connessione, $query_mansioni);
if(!$Result_mansioni)
    {
      print("Query fallita. Controllare L'inserimento!");
      exit();
    }
echo ("
<!DOCTYPE html>
<html>
<head>
<title>Tabella mansioni</title>
<h1>Tabella mansioni</h1>
<body>");
echo "<table>";
	echo "<tr>";
        echo "<th><b> ID mansione </b></th>";
        echo "<th><b> Nome </b></th>";
        echo "<th><b> Titolo di studio </b></th>";
        echo "<th><b> Stipendio medio </b></th>";
    echo "</tr>";
     while ($row_mansioni = mysqli_fetch_assoc($Result_mansioni)) 
    { 
    echo "<tr>";
       echo "<td>" . $row_mansioni['ID_mansione'] . "</td>";
       echo "<td>" . $row_mansioni['Nome'] . "</td>";
       echo "<td>" . $row_mansioni['Titolo_studio'] . "</td>";
       echo "<td>" . $row_mansioni['Stipendio_medio'] . "</td>";
       
      echo "</tr>";
     }
     echo "</table>";



// Cerca offerte per ID

echo "<br><h3>Cerca mansioni</h3>
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
  $query_ricerca="SELECT * FROM mansioni WHERE ID_mansione=$ID_ricerca";
  $Result_ricerca = mysqli_query($Connessione, $query_ricerca);
if(!$Result_ricerca)
    {
      print("Query fallita. Controllare L'inserimento!");
      exit();
    }
echo "<table>";
  echo "<tr>";
        echo "<th><b> ID mansione </b></th>";
        echo "<th><b> Nome </b></th>";
        echo "<th><b> Titolo di studio </b></th>";
        echo "<th><b> Stipendio medio </b></th>";
    echo "</tr>";
     while ($row_cerca = mysqli_fetch_assoc($Result_ricerca)) 
    { 
       echo "<tr>";
       echo "<td>" . $row_cerca['ID_mansione'] . "</td>";
       echo "<td>" . $row_cerca['Nome'] . "</td>";
       echo "<td>" . $row_cerca['Titolo_studio'] . "</td>";
       echo "<td>" . $row_cerca['Stipendio_medio'] . "</td>";
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