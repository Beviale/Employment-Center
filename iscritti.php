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

$query_iscritti="SELECT * FROM iscritti";
$Result_iscritti = mysqli_query($Connessione, $query_iscritti);
if(!$Result_iscritti)
    {
      print("Query fallita. Controllare L'inserimento!");
      exit();
    }
echo ("
<!DOCTYPE html>
<html>
<head>
<title>Tabella iscritti</title>
<h1>Tabella iscritti</h1>
<body>");
echo "<table>";
	echo "<tr>";
        echo "<th><b> ID Iscritto </b></th>";
        echo "<th><b> Nome </b></th>";
        echo "<th><b> Cognome </b></th>";
        echo "<th><b> Cittadinanza </b></th>";
        echo "<th><b> Stato di occupazione</b></th>";
        echo "<th><b> Anno di nascita</b></th>";
        echo "<th><b> Nazione residdenza</b></th>";
        echo "<th><b> Regione residenza</b></th>";
        echo "<th><b> Comune residenza</b></th>";
        echo "<th><b> Sesso</b></th>";
        echo "<th><b> Indirizzo mail</b></th>";


    echo "</tr>";
     while ($row_iscritti = mysqli_fetch_assoc($Result_iscritti)) 
    { 
    echo "<tr>";
       echo "<td>" . $row_iscritti['ID_iscritto'] . "</td>";
       echo "<td>" . $row_iscritti['Nome'] . "</td>";
       echo "<td>" . $row_iscritti['Cognome'] . "</td>";
       echo "<td>" . $row_iscritti['Cittadinanza'] . "</td>";
       echo "<td>" . $row_iscritti['Stato_attuale'] . "</td>";
       echo "<td>" . $row_iscritti['Anno_nascita'] . "</td>";
       echo "<td>" . $row_iscritti['Nazione_residenza'] . "</td>";
       echo "<td>" . $row_iscritti['Regione_residenza'] . "</td>";
       echo "<td>" . $row_iscritti['Comune_residenza'] . "</td>";
       echo "<td>" . $row_iscritti['Sesso'] . "</td>";

       echo "<td>" . $row_iscritti['Mail_iscritti'] . "</td>";

       
      echo "</tr>";
     }
     echo "</table>
     <br>
     <br>
     <br>";

// Visualizzazione numero di proposte

$query_numero_iscritti="SELECT COUNT(ID_proposta) AS num, Codice_iscritto FROM proposte GROUP BY Codice_iscritto
";
$Result_numero_iscritti = mysqli_query($Connessione, $query_numero_iscritti);
if(!$Result_numero_iscritti)
    {
      print("Query fallita. Controllare L'inserimento!");
      exit();
    }
echo "<table>";
echo "<tr>";
echo "<th><b> ID Iscritto </b></th>";
echo "<th><b> Numero di proposte compatibili</b></th>";
        
echo "</tr>";
while ($row_numero_iscritti = mysqli_fetch_assoc($Result_numero_iscritti)) 
    { 
      echo "<tr>";
      echo "<td>" . $row_numero_iscritti['Codice_iscritto'] . "</td>";
      echo "<td>" . $row_numero_iscritti['num'] . "</td>";
      echo "</tr>";
     }
     echo "</table>";







// Cerca iscritto per ID

echo "<br><h3>Cerca iscritto</h3>
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
  $query_ricerca="SELECT * FROM iscritti WHERE ID_iscritto=$ID_ricerca";
  $Result_ricerca = mysqli_query($Connessione, $query_ricerca);
if(!$Result_ricerca)
    {
      print("Query fallita. Controllare L'inserimento!");
      exit();
    }
echo "<table>";
  echo "<tr>";
        echo "<th><b> ID Iscritto </b></th>";
        echo "<th><b> Nome </b></th>";
        echo "<th><b> Cognome </b></th>";
        echo "<th><b> Cittadinanza </b></th>";
        echo "<th><b> Stato di occupazione</b></th>";
        echo "<th><b> Anno di nascita</b></th>";
        echo "<th><b> Nazione residdenza</b></th>";
        echo "<th><b> Regione residenza</b></th>";
        echo "<th><b> Comune residenza</b></th>";
        echo "<th><b> Sesso</b></th>";
        echo "<th><b> Indirizzo mail</b></th>";


        
    echo "</tr>";
     while ($row_cerca = mysqli_fetch_assoc($Result_ricerca)) 
    { 
       echo "<tr>";
       echo "<td>" . $row_cerca['ID_iscritto'] . "</td>";
       echo "<td>" . $row_cerca['Nome'] . "</td>";
       echo "<td>" . $row_cerca['Cognome'] . "</td>";
       echo "<td>" . $row_cerca['Cittadinanza'] . "</td>";
       echo "<td>" . $row_cerca['Stato_attuale'] . "</td>";
       echo "<td>" . $row_cerca['Anno_nascita'] . "</td>";
       echo "<td>" . $row_cerca['Nazione_residenza'] . "</td>";
       echo "<td>" . $row_cerca['Regione_residenza'] . "</td>";
       echo "<td>" . $row_cerca['Comune_residenza'] . "</td>";
       echo "<td>" . $row_cerca['Sesso'] . "</td>";
       echo "<td>" . $row_cerca['Mail_iscritti'] . "</td>";

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


