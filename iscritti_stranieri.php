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

$query_iscritti="SELECT * FROM iscritti WHERE Cittadinanza<>'italiana'";
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
<title>Iscritti stranieri</title>
<h1>Tabella iscritti stranieri</h1>
<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-info-circle-fill' viewBox='0 0 16 16'>
  <path d='M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z'/>
</svg>
<p>NOTA: gli iscritti stranieri devono avere un permesso di aggiorno valido alla data odierina.</p>
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



$query_numero_iscritti="SELECT COUNT(ID_proposta) AS num, Codice_iscritto FROM proposte INNER JOIN iscritti ON proposte.Codice_iscritto=Iscritti.ID_iscritto WHERE  Cittadinanza<>'italiana' GROUP BY Codice_iscritto";
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