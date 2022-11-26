<?php
ini_set('display_errors',0);
session_start();

if(!isset($_SESSION['verifica_iscritto']))
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
  $ID_offerta=$_GET['dettagli'];

}
else
{
  echo "<meta http-equiv='refresh' content='0;URL=http://localhost/maturita/benvenuto.php'>";

}
// Visualizzazione della tabella degli iscritti

$query_offerte="SELECT * FROM offerte WHERE ID_offerta=$ID_offerta";
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
<h1>Tabella offerta</h1>
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
     echo "</table>
     <br>
     <br>
     <br>";




// Tabella azienda

$query_azienda="SELECT * FROM offerte INNER JOIN aziende ON offerte.Codice_azienda=aziende.ID_azienda WHERE ID_offerta=$ID_offerta";
$Result_azienda = mysqli_query($Connessione, $query_azienda);
if(!$Result_azienda)
    {
      print("Query fallita. Controllare L'inserimento!");
      exit();
    }



echo "<h1>Azienda</h1>
<table>";
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
     while ($row_azienda  = mysqli_fetch_assoc($Result_azienda)) 
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



