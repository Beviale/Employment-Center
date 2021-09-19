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

if(isset($_POST['trova_codice_azienda']))
{
	$Codice_azienda=$_POST['trova_codice_azienda'];
  echo "<h4>Cerco risultati con codice azienda: ". $Codice_azienda . ".</h4>";
	$query="SELECT * FROM offerte WHERE Codice_azienda=$Codice_azienda";
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
     while ($row_offerte = mysqli_fetch_assoc($Result)) 
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









if(isset($_POST['trova_contratto']))
{
	$contratto=$_POST['trova_contratto'];
  echo "<h4>Cerco risultati per: ". $contratto . ".</h4>";
	$query="SELECT * FROM offerte WHERE Contratto='$contratto'";
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
     while ($row_offerte = mysqli_fetch_assoc($Result)) 
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








if(isset($_POST['trova_nazione_lavoro']))
{
  $Nazione_lavoro=$_POST['trova_nazione_lavoro'];
  echo "<h4>Cerco risultati per: ". $Nazione_lavoro . ".</h4>";
  $query="SELECT * FROM offerte WHERE Nazione_lavoro='$Nazione_lavoro'";
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
     while ($row_offerte = mysqli_fetch_assoc($Result)) 
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







if(isset($_POST['trova_regione_lavoro']))
{
  $Regione_lavoro=$_POST['trova_regione_lavoro'];
  echo "<h4>Cerco risultati per: ". $Regione_lavoro . ".</h4>";
  $query="SELECT * FROM offerte WHERE Regione_lavoro='$Regione_lavoro'";
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
     while ($row_offerte = mysqli_fetch_assoc($Result)) 
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







if(isset($_POST['trova_codice_mansione']))
{
  $Codice_mansione=$_POST['trova_codice_mansione'];
  echo "<h4>Cerco risultati con codice mansione: ". $Codice_mansione . ".</h4>";
  $query="SELECT * FROM offerte WHERE Codice_mansione=$Codice_mansione AND Scadenza>curdate()";
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
     while ($row_offerte = mysqli_fetch_assoc($Result)) 
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







if(isset($_POST['trova_anni_esperienza']))
{
  $Esperienza=$_POST['trova_anni_esperienza'];
  echo "<h4>Cerco risultati con ". $Esperienza . " anni di esperienza.</h4>";
  $query="SELECT * FROM offerte WHERE esperienza_minima=$Esperienza";
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
     while ($row_offerte = mysqli_fetch_assoc($Result)) 
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



if(isset($_POST['trova_comune_lavoro']))
{
  $Comune_lavoro=$_POST['trova_comune_lavoro'];
  echo "<h4>Cerco risultati per: ". $Comune_lavoro . ".</h4>";
  $query="SELECT * FROM offerte WHERE Comune_lavoro='$Comune_lavoro'";
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
     while ($row_offerte = mysqli_fetch_assoc($Result)) 
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






if(isset($_POST['trova_minima']))
{
  $Minima=$_POST['trova_minima'];
  $Massima=$_POST['trova_massima'];
  $query="SELECT * FROM offerte WHERE $Minima>=eta_minima AND $Massima<=eta_massima";
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
     while ($row_offerte = mysqli_fetch_assoc($Result)) 
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