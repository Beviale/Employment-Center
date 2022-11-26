<?php
ini_set('display_errors',0);
session_start();

if(!isset($_SESSION['verifica_azienda']))
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



if(isset($_GET['dettagli']))
{
  $ID_iscritto=$_GET['dettagli'];

}
else
{
  echo "<meta http-equiv='refresh' content='0;URL=http://localhost/maturita/benvenuto.php'>";

}
// Visualizzazione della tabella degli iscritti

$query_iscritti="SELECT * FROM iscritti WHERE ID_iscritto=$ID_iscritto";
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
<h1>Tabella iscritto</h1>
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




// Tabella mansioni

$query_effettua="SELECT * FROM effettua WHERE Codice_iscritti=$ID_iscritto";
$Result_effettua = mysqli_query($Connessione, $query_effettua);
if(!$Result_effettua)
    {
      print("Query fallita. Controllare L'inserimento!");
      exit();
    }



echo "<h1>Mansioni</h1>
<table>";
  echo "<tr>";
        echo "<th><b> Codice mansione </b></th>";
        echo "<th><b> Anni esperienza </b></th>";
        echo "<th><b> Mesi esperienza </b></th>";


    echo "</tr>";
     while ($row_effettua = mysqli_fetch_assoc($Result_effettua)) 
    { 
    echo "<tr>";
       echo "<td>" . $row_effettua['Codice_mansione'] . "</td>";
       echo "<td>" . $row_effettua['anni_esperienza'] . "</td>";
       echo "<td>" . $row_effettua['mesi_esperienza'] . "</td>";

       
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



